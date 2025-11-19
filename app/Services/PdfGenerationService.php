<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;

class PdfGenerationService
{
    public function generateApplicationFormPdf($formData, $user)
    {
        $pdf = new Dompdf();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $pdf->setOptions($options);

        $html = view('backend.application_forms.pdf_view', [
            'formData' => $formData,
        ])->render();

        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $fileName = $user->name . '_application_form.pdf';
        $filePath = 'learners/' . $user->name . '_' . $user->last_name . '/application_form/' . $fileName;

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }
        Storage::disk('public')->put($filePath, $pdf->output());
        return 'storage/' . $filePath;
    }
}
