<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $bodyHtml;
    public $subjectLine;
    public $fromAddress;
    // public $attachments;

    public function __construct($bodyHtml, $subjectLine, $fromAddress, $attachments = [])
    {
        $this->bodyHtml = $bodyHtml;
        $this->subjectLine = $subjectLine;
        $this->fromAddress = $fromAddress;
        // $this->attachments = $attachments;
    }

    public function build()
    {
        $email = $this->subject($this->subjectLine)
            ->html($this->bodyHtml);
        // $this->attachFiles($email);
        return $email;
    }

    /**
     * Attach files to the email.
     * @param \Illuminate\Mail\Mailable $email
     */
    protected function attachFiles($email)
    {
        if (is_array($this->attachments) && count($this->attachments)) {
            foreach ($this->attachments as $file) {
                if (!$file) continue;

                $filePath = is_object($file) ? ($file->file_path ?? null) : ($file['file_path'] ?? null);
                $fileName = is_object($file) ? ($file->file_name ?? null) : ($file['file_name'] ?? null);
                $mimeType = is_object($file) ? ($file->mime_type ?? null) : ($file['mime_type'] ?? null);

                if ($filePath && file_exists(storage_path('app/public/' . $filePath))) {
                    $options = [];

                    if (!empty($fileName)) {
                        $options['as'] = $fileName;
                    }
                    if (!empty($mimeType)) {
                        $options['mime'] = $mimeType;
                    }

                    $fullPath = storage_path('app/public/' . $filePath);

                    // Attach with or without options
                    if (!empty($options)) {
                        $email->attach($fullPath, $options);
                    } else {
                        $email->attach($fullPath);
                    }
                }
            }
        }
    }
}
