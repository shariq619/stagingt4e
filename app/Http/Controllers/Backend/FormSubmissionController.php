<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\FormSubmission;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $latestSubmission = FormSubmission::latest()->first();
        return view('backend.form.index', compact('latestSubmission'));
    }

    public function submit(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string',
            'signature' => 'required|string', // Signature is now a base64 string
        ]);

        // Decode signature from base64
        $signatureData = $request->signature;
        $signatureData = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureData = str_replace(' ', '+', $signatureData);
        $signatureImage = base64_decode($signatureData);

        // Generate PDF
        $pdf = new Dompdf();
        $html = '
        <h1>Form Submission</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Name</th>
                <th>Signature</th>
            </tr>
            <tr>
                <td>' . $request->name . '</td>
                <td><img src="data:image/png;base64,' . $signatureData . '" width="200" height="100"></td>
            </tr>
        </table>';



        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        // Save PDF
        $pdfPath = 'pdfs/' . uniqid() . '.pdf';
        file_put_contents(public_path($pdfPath), $pdf->output());

        // Save form submission data to database
        $formSubmission = new FormSubmission();
        $formSubmission->name = $request->name;
        $formSubmission->signature_path = $pdfPath;
        $formSubmission->save();

        // Redirect back to form with success message
        return redirect()->route('backend.form.index')->with('success', 'Form submitted successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormSubmission  $formSubmission
     * @return \Illuminate\Http\Response
     */
    public function show(FormSubmission $formSubmission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormSubmission  $formSubmission
     * @return \Illuminate\Http\Response
     */
    public function edit(FormSubmission $formSubmission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormSubmission  $formSubmission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormSubmission $formSubmission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormSubmission  $formSubmission
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormSubmission $formSubmission)
    {
        //
    }
}
