<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComprobanteMailable2 extends Mailable
{
    use Queueable, SerializesModels;

    public $pasajero;

    public $subject = "Compra pasaje express";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pasajero)
    {
        $this->pasajero = $pasajero;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.pasajeroExpressContraseña');
    }
}
