<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\VideoTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VideoFeedbackController extends Controller
{
    public function index()
    {
        return view('backend.video_feedback.index');
    }

    public function adminData(Request $request)
    {
        $query = VideoTestimonial::with('user')->latest();

        $status = $request->get('status');
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $search = $request->get('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('message', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        }

        $videos = $query->limit(200)->get();

        $data = $videos->map(function (VideoTestimonial $v) {
            return [
                'id' => $v->id,
                'user_name' => optional($v->user)->name,
                'user_email' => optional($v->user)->email,
                'title' => $v->title ?: 'Untitled',
                'message' => $v->message ? Str::limit($v->message, 80) : null,
                'status' => $v->status,
                'consent' => $v->consent_given ? 'yes' : 'no',
                'created_at' => $v->created_at?->format('d M Y, H:i'),
                'show_url' => route('backend.video-feedback.show', $v->id),
                'approve_url' => route('backend.video-feedback.approve', $v->id),
                'reject_url' => route('backend.video-feedback.reject', $v->id)
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        $consentText = 'I agree that Training4Employment (T4E) may use this video testimonial for marketing and promotional purposes, including on websites, social media, and all other distribution channels.';
        return view('backend.video_feedback.create', compact('consentText'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:150'],
            'message' => ['nullable', 'string'],
            'consent_given' => ['required', 'accepted'],
            'consent_text' => ['required', 'string'],
            'video_file' => ['required', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime', 'max:51200'],
            'video_duration' => ['nullable', 'integer', 'min:0']
        ]);

        $disk = 'public';
        $path = $request->file('video_file')->store('video-testimonials', $disk);

        $durationRaw = $request->video_duration;
        $videoDuration = null;
        if (is_numeric($durationRaw)) {
            $d = (int) $durationRaw;
            if ($d >= 0) $videoDuration = $d;
        }

        $v = new VideoTestimonial();
        $v->user_id = Auth::id();
        $v->title = $validated['title'] ?? null;
        $v->message = $validated['message'] ?? null;
        $v->video_disk = $disk;
        $v->video_path = $path;
        $v->video_format = $request->file('video_file')->getClientOriginalExtension();
        $v->video_size = $request->file('video_file')->getSize();
        $v->video_duration = $videoDuration;
        $v->consent_given = true;
        $v->consent_text = $validated['consent_text'];
        $v->consent_version = 'v1';
        $v->consent_at = now();
        $v->ip_address = $request->ip();
        $v->status = 'pending';
        $v->save();

        if ($request->ajax()) {
            return response()->json(['status' => 'success']);
        }

        return redirect()->route('backend.video-feedback.create')->with('success', 'Thank you.');
    }

    public function show($id)
    {
        $video = VideoTestimonial::with('user')->findOrFail($id);
        return view('backend.video_feedback.show', compact('video'));
    }

    public function approve($id)
    {
        $v = VideoTestimonial::findOrFail($id);
        $v->status = 'approved';
        $v->reviewed_by = Auth::id();
        $v->reviewed_at = now();
        $v->save();
        return back()->with('success', 'Approved');
    }

    public function reject(Request $request, $id)
    {
        $v = VideoTestimonial::findOrFail($id);
        $v->status = 'rejected';
        $v->reviewed_by = Auth::id();
        $v->reviewed_at = now();
        $v->review_notes = $request->review_notes ?? null;
        $v->save();
        return back()->with('success', 'Rejected');
    }

    public function my()
    {
        return view('backend.video_feedback.my');
    }

    public function myData()
    {
        $videos = VideoTestimonial::where('user_id', Auth::id())->latest()->get();

        $data = $videos->map(function (VideoTestimonial $v) {
            return [
                'id' => $v->id,
                'title' => $v->title ?: 'Untitled',
                'message' => $v->message ? Str::limit($v->message, 80) : null,
                'status' => $v->status,
                'created_at' => $v->created_at?->format('d M Y, H:i'),
                'video_url' => Storage::disk($v->video_disk)->url($v->video_path)
            ];
        });

        return response()->json(['data' => $data]);
    }
}
