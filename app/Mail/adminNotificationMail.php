<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;

class adminNotificationMail extends Mailable {

    use Queueable,
        SerializesModels;

    public $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student) {
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        return $this->subject('New Student Joined')
                        ->html(
                                (new MailMessage)->greeting('Dear Admin')
                                ->line('please find below .')
                                ->line('name:' . $this->student->name)
                                ->line('email:' . $this->student->email)
                                ->line('School:' . $this->student->school->name)
                                ->line('')->render()
        );
    }

}
