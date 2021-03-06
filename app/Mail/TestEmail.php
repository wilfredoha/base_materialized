<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

     public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'descarga@blce.com';
        $subject = 'Su archivo está listo para ser descargado!';
        $name = 'Buscador de literatura científica en español';
        
        return $this->view('emails.test')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([ 'test_message' => $this->data['message'] ]);
    }
}
