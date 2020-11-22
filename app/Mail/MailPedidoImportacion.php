<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailPedidoImportacion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $idPaquete;

    public function __construct($id)
    {
        $this->idPaquete = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $paquete = $this->idPaquete;

        return $this->view('mail.notif-pedido-importacion', compact('paquete'))->subject('Recibiste un pedido de importación de cartas');
    }
}
