<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Correo extends Mailable
{
    use Queueable, SerializesModels;


    public $data, $file;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $file)
    {
        $this->data = $data;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correo')->with([
            'mensaje' => $this->data->mensaje,
            "file" => "/modules/file/".$this->file->id
        ]);
    }
}
