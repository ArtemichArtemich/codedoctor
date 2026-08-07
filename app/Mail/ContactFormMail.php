<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->from('noreply@code-doctor.ru', 'Code-Doctor.ru')
                    ->to('web@code-doctor.ru') // Только ваша почта
                    ->subject('Новая заявка с сайта: ' . $this->contact->name)
                    ->view('emails.contact-form');
    }
}