<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ElasticEmailService
{
    public function sendEmail($to, $subject, $body)
    {
        $response = Http::post('https://api.elasticemail.com/v2/email/send', [
            'apikey' => config('services.elastic_email.key'),
            'subject' => $subject,
            'from' => env('MAIL_FROM_ADDRESS'),
            'to' => $to,
            'body' => $body,
        ]);

        \Log::info('Elastic Email API Response: ' . json_encode($response->json()));

        
        return $response->json();
    }
}
