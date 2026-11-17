<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class SendAttachment extends Mailable
{
    use Queueable, SerializesModels;

    public $quillContent;
    public $files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quillContent, $files)
    {
        $this->quillContent = $quillContent;
        $this->files = $files;
        set_time_limit(300);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $attachmentFiles = $this->files; // Assuming $this->files is an array of URLs

        $email =  $this->markdown('emails.attachment')
            ->subject('Attachment From Admin')
            ->with(['quillContent' => $this->quillContent]);

            $chunkSize = 10; // Set the desired chunk size
            $attachmentFiles = $this->files;

            foreach (array_chunk($attachmentFiles, $chunkSize) as $fileChunk) {
            foreach ($fileChunk as $filePath) {
            $email->attach($filePath);
            }
            }

            DB::reconnect();

            return $email;

    }
    
}
