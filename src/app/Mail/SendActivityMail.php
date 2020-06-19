<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendActivityMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $activity_data;
    public $date;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($activity_data, $date)
    {
        $this->activity_data = $activity_data;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.activity')
                    ->text('emails.activity_plain')
                    ->subject('学習状況のお知らせ')
                    ->with($this->activity_data);
    }
}
