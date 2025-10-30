<?php

namespace App\Livewire;

use App\Mail\ContactFormMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $name = '';

    public $phone = '';

    public $email = '';

    public $message = '';

    public $successMessage = '';

    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required',
        'email' => 'required|email',
        'message' => 'nullable',
    ];

    public function submit()
    {
        $this->validate();

        $contact = Contact::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'message' => $this->message,
        ]);

        // Send email notification
        try {
            Mail::to('info@wellmarkeg.com')->send(new ContactFormMail($contact));
        } catch (\Exception $e) {
            \Log::error('Failed to send contact email: '.$e->getMessage());
        }

        $this->successMessage = 'Thank you for your message! We will contact you soon.';

        $this->reset(['name', 'phone', 'email', 'message']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
