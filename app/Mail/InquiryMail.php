<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $firstname;
    public $lastname;
    public $phone;
    public $role;
    public $contact;
    public $details;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {

        $this->data = $data;
        // 各プロパティにデータをセットする
        $this->email = $data['email'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->phone = $data['phone'];
        $this->role = $data['role'];
        $this->contact = $data['contact'];
        $this->details = $data['details'];
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->to($this->email)
                    ->subject('Inquiry Confirmation')
                    ->view('registers.mail')
                    ->with([
                        'email' => $this->email,
                        'firstname' => $this->firstname,
                        'lastname' => $this->lastname,
                        'phone' => $this->phone,
                        'role' => $this->role,
                        'contact' => $this->contact,
                        'details' => $this->details,
                        'data' => $this->data
                    ]);
    }

}

