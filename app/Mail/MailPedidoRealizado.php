<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailPedidoRealizado extends Mailable
{
    use Queueable, SerializesModels;

    protected $index;

    public $idPaquete;

    public $asunto = [
        'Ya hicimos el pedido de tu paquete en el exterior',
        'Tu paquete fue despachado en el exterior',
        'Tu paquete ingresó a Argentina',
        'Ya recibimos tu paquete',
    ];

    public $textos = [
        'Ya realizamos el pedido de tu paquete en el exterior, y te mantendremos informado/a por cualquier novedad que surja. Podrás ver los detalles de tu pedido haciendo click en el botón debajo.',
        'El pedido de importación de cartas que hiciste ya fue despachado de su país de origen. Podrás ver los detalles de tu pedido haciendo click en el botón debajo.',
        'El pedido de importación de cartas que hiciste ya ingresó al país, y es custión de tiempo para que llegue a nuestras manos y así poder entregartelo.',
        'Ya recibimos el pedido de importación de cartas que hiciste, y está listo para ser entregado.'
    ];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($paquete, $indexu)
    {
        $this->idPaquete = $paquete;

        $this->index = $indexu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $paquete = $this->idPaquete;

        $textoMail = $this->textos[$this->index];

        return $this->view('mail.notif-pedido-realizado', compact('paquete', 'textoMail'))
                        ->subject($this->asunto[$this->index]);
    }
}
