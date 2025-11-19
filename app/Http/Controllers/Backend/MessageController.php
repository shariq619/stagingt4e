<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\MessageSent;
use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageSentNotification;
use App\Notifications\ProfilePhotoUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{
    public function index()
    {
        // Show all received messages for the logged-in user
        //$messages = auth()->user()->receivedMessages()->latest()->paginate(10);
        $messages = auth()->user()->receivedMessages()->with('attachments')->latest()->paginate(10);
        // Count unread messages
        $unreadCount = auth()->user()->receivedMessages()->where('is_read', 0)->count();
        return view('backend.messages.index', compact('messages', 'unreadCount'));
    }

    public function create()
    {
        if(auth()->user()->hasRole('Learner')){

            $trainerIds = auth()->user()->cohorts()->pluck('trainer_id')->unique();
            $trainers = User::with('roles')
                ->whereIn('id', $trainerIds)
                ->where('id', '!=', auth()->id()) // Exclude the currently logged-in user
                ->whereDoesntHave('roles', function ($query) {
                    $query->whereIn('name', ['Learner']); // Exclude users with the 'learner' role
                })
                ->get();

            // Merge all admins into one virtual user (All Admins)
            $allAdmins = new \stdClass();
            $allAdmins->id = 'all_admins'; // unique non-integer ID
            $allAdmins->name = 'All Admins';
            $allAdmins->roles = collect([(object)['name' => 'Admin / Super Admin']]); // Just for display


            // Merge trainers and add the virtual "All Admins" option
            $users = $trainers->values();
            $users->push($allAdmins); // Add virtual All Admins option



        } else if( auth()->user()->hasRole('Trainer') ){

            // Fetch all cohort IDs assigned to the logged-in trainer
            $cohortIds = auth()->user()->trainerCohorts()->pluck('id');

            $userIds = DB::table('cohort_user')
                ->whereIn('cohort_id', $cohortIds)
                ->pluck('user_id')
                ->unique();

            $users = User::with('roles')
                ->whereIn('id', $userIds)
                ->where('id', '!=', auth()->id()) // Exclude the currently logged-in user
                ->whereDoesntHave('roles', function ($query) {
                    $query->whereIn('name', ['Trainer','Admin','Super Admin']); // Exclude users with the 'learner' role
                })
                ->get();


        } else {
            $users = User::with('roles')->where('id', '!=', auth()->id())->get();
        }

        return view('backend.messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'recipient_id' => 'required|array',
                // Skip validating 'all_admins' as an actual user ID
                'recipient_id.*' => ['string', function ($attribute, $value, $fail) {
                    if ($value !== 'all_admins' && !User::where('id', $value)->exists()) {
                        $fail('Invalid recipient selected.');
                    }
                }],
                'subject' => 'required|string|max:255',
                'body' => 'required|string',
            ]);

            // Custom validation for combined size
            $this->validateCombinedAttachmentSize($request->file('attachments'));

            // Expand "all_admins" to actual admin IDs
            $finalRecipients = collect();

            foreach ($request->recipient_id as $recipientId) {
                if ($recipientId === 'all_admins') {
                    //$admins = User::role(['Admin', 'Super Admin'])->pluck('id');
                    //$finalRecipients = $finalRecipients->merge($admins);


                    $admins = User::role(['Admin', 'Super Admin'])
                        ->whereNotIn('id', [4, 5]) // Exclude specific admin IDs
                        ->pluck('id');

                    $finalRecipients = $finalRecipients->merge($admins);


                } else {
                    $finalRecipients->push($recipientId);
                }
            }

            $finalRecipients = $finalRecipients->unique();

            // Prepare attachments once
            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $filename = $file->store('attachments', 'public');
                    $attachments[] = [
                        'stored' => $filename,
                        'full_path' => storage_path('app/public/' . $filename)
                    ];
                }
            }

            foreach ($finalRecipients as $recipientId) {
                $messageModel = Message::create([
                    'sender_id' => auth()->id(),
                    'recipient_id' => $recipientId,
                    'subject' => $request->subject,
                    'body' => $request->body,
                ]);

                // Attach previously saved files to this message
                foreach ($attachments as $file) {
                    $messageModel->attachments()->create(['filename' => $file['stored']]);
                }

                $recipient_user = User::find($recipientId);
                $sender_user = auth()->user();

                // Send in-app notification
                $recipient_user->notify(new MessageSentNotification(
                    "You have a new message",
                    route('backend.messages.index')
                ));

                // Send email with attachments
                try {
                    Mail::to($recipient_user->email)->send(new MessageSent([
                        'subject' => $request->subject,
                        'body' => $request->body,
                        'attachments' => collect($attachments)->pluck('full_path')->toArray(),
                    ]));
                } catch (\Swift_TransportException $e) {
                    if (strpos($e->getMessage(), '503') === false) {
                        throw $e;
                    }
                }
            }

            return redirect()->route('backend.messages.index')->with('success', 'Message sent successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('Message sending failed: ' . $e->getMessage());
        }
    }


//    public function store(Request $request)
//    {
//        try {
//
//            $request->validate([
//                'recipient_id' => 'required|array', // Allow an array of recipients
//                'recipient_id.*' => 'exists:users,id', // Validate each recipient ID
//                'subject' => 'required|string|max:255',
//                'body' => 'required|string'
//            ]);
//
//            // Custom validation for combined size
//            $this->validateCombinedAttachmentSize($request->file('attachments'));
//
//
//            foreach ($request->recipient_id as $recipientId) {
//
//                $messageModel = Message::create([ // Rename the message variable
//                    'sender_id' => auth()->id(),
//                    'recipient_id' => $recipientId, // Send message to each recipient
//                    'subject' => $request->subject,
//                    'body' => $request->body,
//                ]);
//
//                // Store file attachments
//                // Store file attachments
//                $attachments = [];
//                if ($request->hasFile('attachments')) {
//                    foreach ($request->file('attachments') as $file) {
//                        $filename = $file->store('attachments', 'public');
//                        $messageModel->attachments()->create(['filename' => $filename]);
//                        $attachments[] = storage_path('app/public/' . $filename); // Store full path for email
//                    }
//                }
//
//
//                $recipient_user = User::find($recipientId);
//                $sender_user = User::find(auth()->id());
//
//                // Send notification to the user
//                $admins = User::role('Super Admin')->get();
//                //$notificationMessage = $request->subject . ' by ' . $sender_user->name; // Rename the notification message
//                $notificationMessage = "You have a new message";
//                $recipient_user->notify(new MessageSentNotification($notificationMessage, route('backend.messages.index')));
//
//                //dd($attachments);
//
//                // Send email with attachments
//                Mail::to($recipient_user->email)->send(new MessageSent([
//                    'subject' => $request->subject,
//                    'body' => $request->body,
//                    'attachments' => $attachments, // Array of attachments
//                ]));
//
//            }
//
//        } catch (\Swift_TransportException $e) {
//            // Check if the error message contains the specific 503 code and ignore it
//            if (strpos($e->getMessage(), '503') !== false) {
//              //  \Log::warning('Email sending issue: ' . $e->getMessage());
//                // Optionally, you can return a custom error message for this specific case if needed
//                //  return redirect()->back()->withErrors('Email sending failed due to a server issue: ' . $recipient_user->email);
//            } else {
//                // Log and throw other email errors
//               // \Log::error('Email sending error: ' . $e->getMessage());
//                throw $e; // Let other exceptions bubble up
//            }
//        }
//
//        return redirect()->route('backend.messages.index')->with('success', 'Message sent successfully.');
//    }

    // Custom function to validate combined attachment size
    protected function validateCombinedAttachmentSize($attachments)
    {
        if ($attachments) {
            $totalSize = 0;

            foreach ($attachments as $attachment) {
                $totalSize += $attachment->getSize();
            }

            // Check if total size exceeds 5MB
            if ($totalSize > 5 * 1024 * 1024) { // 5MB in bytes
                throw ValidationException::withMessages([
                    'attachments' => ['The total size of all attachments must not be greater than 5MB.'],
                ]);
            }
        }

    }


    public function show(Message $message)
    {
        // Mark as read
        if ($message->recipient_id == auth()->id()) {
            $message->update(['is_read' => true]);
        }

        return view('backend.messages.show', compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sent()
    {
        $messages = auth()->user()->sentMessages()->latest()->paginate(10);
        return view('backend.messages.index', compact('messages'));
    }

    public function reply(Request $request, $messageId)
    {


        // Custom validation for combined size
        try {
            $this->validateCombinedAttachmentSize($request->file('attachments'));
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

        // Find the original message
        $originalMessage = Message::findOrFail($messageId);

        // Create a new message as a reply
        $reply = new Message();
        $reply->subject = $originalMessage->subject;
        $reply->body = $request->body;
        $reply->sender_id = auth()->user()->id;
        $reply->recipient_id = $originalMessage->sender_id; // The recipient of the reply is the sender of the original message
        $reply->save();


        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = $file->store('attachments', 'public');
                $reply->attachments()->create(['filename' => $filename]);
                $attachments[] = storage_path('app/public/' . $filename); // Store full path for email
            }
        }

        $user = User::find($originalMessage->sender_id);

        $recipient_user = User::find($originalMessage->sender_id);
        $sender_user = User::find(auth()->user()->id);

        // Send notification to the user
        $message_url = route('backend.messages.index');
        //$message = $originalMessage->subject. ' by ' . $sender_user->name;
        $message = "You have a new message";
        $recipient_user->notify(new MessageSentNotification($message, $message_url));

        // Send email
        Mail::to($user->email)->send(new MessageSent([
            'subject' => $originalMessage->subject,
            'body' => $request->body,
            'attachments' => $attachments, // Array of attachments
        ]));

        return redirect()->back()->with('success', 'Reply sent successfully');
    }

    public function viewMessage($id)
    {
        // Find the message by ID
        $message = Message::findOrFail($id);
        // Mark the message as read if it's unread
        if ($message->is_read == 0) {
            $message->is_read = 1;
            $message->save(); // Save the change
        }
    }


}
