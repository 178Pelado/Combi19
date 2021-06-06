<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComprobanteMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $pasajes;

    public $subject = "Comprobante de pago";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pasajes)
    {
        $this->pasajes = $pasajes;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.comprobante');
    }
}
