<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVendedor extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $ordenCompra;

    public $subject = 'Alguien compró uno o más productos desde la página web';

    public function __construct($orden)
    {
        $this->ordenCompra = $orden;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.compra-vendedor')->subject('Alguien compró uno o más productos desde la página web');
    }
}
