<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ApplicationForm;
use App\Models\ProfilePhoto;
use App\Models\Task;
use App\Models\User;
use App\Notifications\ApplicationFormNotification;
use App\Notifications\ProfilePhotoUploaded;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = auth()->user();
        if ($user->hasRole('Learner')) {
            $application_form = ApplicationForm::where('learner_id', $user->id)->first();
            return view('backend.application_forms.index', compact('application_form'));
        } elseif ($user->hasRole('Super Admin') || $user->hasRole('Admin')) {
            $application_forms = ApplicationForm::query();

            $application_forms->where(function ($q) use ($search, $request) {
                if (isset($request->status)) {
                    $q->where('status', $request->status);
                } else {
                    $q->where('status', '!=', 'Not Submitted');
                }
                if (!empty($search)) {
                    $q->where(function ($q) use ($search) {
                        $q->where('last_name', 'like', "%{$search}%")
                            ->orWhere('father_name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('phone_number', 'like', "%{$search}%");
                    });
                }
            });
            $application_forms = $application_forms->orderBy('created_at', 'desc')->paginate(10);

            return view('backend.application_forms.admin_view', compact('application_forms'));
        } else {
            return redirect()->back();
        }
    }

    public function preview(Request $request)
    {
        $request->merge([
            'guideline1' => $request->has('guideline1') ? 1 : 0,
            'guideline2' => $request->has('guideline2') ? 1 : 0,
            'guideline3' => $request->has('guideline3') ? 1 : 0,
            'term' => $request->has('term') ? 1 : 0,
        ]);
        $validatedData = $request->validate([
            'father_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'email' => 'required|string|email|unique:application_forms,email',
            'post_code' => 'required',
            'phone_number' => 'required',
            'name' => 'required',
            'relationship_to_you' => 'nullable',
            'hear_about' => 'required',
            'guideline1' => 'nullable|boolean',
            'guideline2' => 'nullable|boolean',
            'guideline3' => 'nullable|boolean',
            'term' => 'required|boolean',
            // 'signature' => 'nullable|string',
        ]);
        // Generate PDF
        $pdf = new Dompdf();
        $validatedData['middle_name'] = $request->middle_name;
        $validatedData['telephone'] = $request->telephone;
        $validatedData['company'] = $request->company;
        $validatedData['emp_contact_name'] = $request->emp_contact_name;
        $validatedData['emp_contact_num'] = $request->emp_contact_num;
        $validatedData['emp_copmany_address'] = $request->emp_copmany_address;
        $validatedData['emp_post_code'] = $request->emp_post_code;
        $validatedData['levy_number'] = $request->levy_number;
        $validatedData['contact_num'] = $request->contact_num;

        $html = view('backend.application_forms.modal_view', [
            'formData' => $validatedData,
        ])->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $userDirectory = 'learners/' . auth()->user()->name . '_' . auth()->user()->last_name . '/application_form';
        $fileName = auth()->user()->name . '_application_form.pdf';
        $filePath = $userDirectory . '/' . $fileName;
        // Save the new PDF
        Storage::disk('public')->put($filePath, $pdf->output());
        // Generate the public URL for the new PDF
        $pdfPath = 'storage/' . $filePath;
        return response()->json(['pdfPath' => asset($pdfPath)]);
    }

    public function updatePreview(Request $request, $id)
    {
        // Merge the request data with binary flags
        $request->merge([
            'guideline1' => $request->has('guideline1') ? 1 : 0,
            'guideline2' => $request->has('guideline2') ? 1 : 0,
            'guideline3' => $request->has('guideline3') ? 1 : 0,
            'term' => $request->has('term') ? 1 : 0,
        ]);
        // Generate PDF
        $pdf = new Dompdf();
        $html = view('backend.application_forms.modal_view', [
            'formData' => $request->all(),
        ])->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        // Save PDF
        //$pdfPath = 'pdfs/' . uniqid() . '.pdf';


        // Save the PDF to storage
        $fileName = auth()->user()->name . '_application_form.pdf';
        $filePath = 'learners/' . auth()->user()->name . '_' . auth()->user()->last_name . '/application_form/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());
        $pdfPath = 'storage/' . $filePath;


        //file_put_contents(public_path($pdfPath), $pdf->output());
        return response()->json(['pdfPath' => asset($pdfPath)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $application_form = new ApplicationForm();
        return view('backend.application_forms.create', compact('application_form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $validatedData = $request->validate([
            'father_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'nationality' => 'required',
            'email' => 'required|string|email|unique:application_forms,email',
            'post_code' => 'required',
            'phone_number' => 'required',
            'telephone' => 'nullable',
            'name' => 'required',
            'contact_num' => 'required',
            'relationship_to_you' => 'nullable',
            'company' => 'nullable',
            'emp_contact_name' => 'nullable',
            //   'emp_contact_num' => 'required',
            'emp_copmany_address' => 'nullable',
            //  'emp_post_code' => 'required',
            'levy_number' => 'nullable',
            'hear_about' => 'required',
        ]);

        $validatedData['term'] = 1;
        $validatedData['guideline1'] = 1;
        $validatedData['guideline2'] = 1;
        $validatedData['guideline3'] = 1;
        $validatedData['emp_contact_num'] = $request->emp_contact_num;
        $validatedData['emp_post_code'] = $request->emp_post_code;

        $pdf = new Dompdf();
        $html = view('backend.application_forms.pdf_view', [
            'formData' => $validatedData,
            //'signatureData' => $signatureData
        ])->render();

        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $application_form = new ApplicationForm();
        $application_form->name = $request->name;
        $application_form->is_valid_form = 1;

        // Save the PDF to storage
        $fileName = $user->name . '_application_form.pdf';
        $filePath = 'learners/' . auth()->user()->name . '_' . auth()->user()->last_name . '/application_form/' . $fileName;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        Storage::disk('public')->put($filePath, $pdf->output());
        $pdfPath = 'storage/' . $filePath;
        $application_form->learner_pdf = $pdfPath;
        // $application_form->signature = $pdfPath;
        $application_form->pdf = $pdfPath;
        $application_form->learner_id = auth()->user()->id;
        $application_form->status = "In Progress";
        $application_form->fill($validatedData);
        $application_form->save();

        // Send notification to the admin
        $user = auth()->user();
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.application-forms.index');
        $message = 'Application form has been submitted by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new ApplicationFormNotification($message, $task_url));
        }
        return response()->json(['message' => 'Form submitted successfully', 'pdfPath' => asset($pdfPath)], 200);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplicationForm $application_form)
    {
        return view('backend.application_forms.edit', compact('application_form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $request->merge([
            'guideline1' => $request->has('guideline1') ? 1 : 0,
            'guideline2' => $request->has('guideline2') ? 1 : 0,
            'guideline3' => $request->has('guideline3') ? 1 : 0,
            'term' => $request->has('term') ? 1 : 0,
        ]);
        $application_form = ApplicationForm::findOrFail($id);
        $fileName = $user->name . '_application_form.pdf';
        $filePath = 'learners/' . auth()->user()->name . '_' . auth()->user()->last_name . '/application_form/' . $fileName;

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $pdfPath = 'storage/' . $filePath;
        $pdf = new Dompdf();
        $html = view('backend.application_forms.pdf_view', [
            'formData' => $request->all(),
        ])->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        Storage::disk('public')->put($filePath, $pdf->output());
        //        $oldPdfPath = $application_form->learner_pdf;
        //        if ($oldPdfPath && Storage::disk('public')->exists(str_replace('storage/', '', $oldPdfPath))) {
        //            Storage::disk('public')->delete(str_replace('storage/', '', $oldPdfPath));
        //        }
        $application_form->learner_pdf = $pdfPath;
        $application_form->status = 'In Progress';
        // Update the application form with new data
        $application_form->fill($request->except(['_token', '_method', 'middle_name']));
        $application_form->save();

        // Notify admins
        $admins = User::role('Super Admin')->get();
        $task_url = route('backend.application-forms.index');
        $message = 'Application form has been updated by ' . $user->name;
        foreach ($admins as $admin) {
            $admin->notify(new ApplicationFormNotification($message, $task_url));
        }

        return response()->json(['message' => 'Form updated successfully', 'pdfPath' => asset($pdfPath)], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplicationForm $application_form)
    {
        $application_form->delete();
        return redirect()->route('backend.application-forms.index')->with('success', 'Application form deleted successfully');
    }

    public function approve($id)
    {
        $applicationForm = ApplicationForm::findOrFail($id);
        $user = $applicationForm->user;
        $applicationForm->status = 'Approved';
        $applicationForm->comments = '';
        $applicationForm->save();

        // Send notification to the learner
        $task_url = route('backend.application-forms.index');
        $message = 'Application Form has been approved';
        $user->notify(new ApplicationFormNotification($message, $task_url));
        return redirect()->back()->with('success', 'Application form approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $applicationForm = ApplicationForm::findOrFail($id);
        $user = $applicationForm->user;
        $applicationForm->status = 'Rejected';
        $applicationForm->comments = $request->comments;
        $applicationForm->save();

        $task_url = route('backend.application-forms.index');
        $message = 'Application form has been rejected';
        $user->notify(new ApplicationFormNotification($message, $task_url));
        return redirect()->back()->with('error', 'Application form rejected.');
    }
}
