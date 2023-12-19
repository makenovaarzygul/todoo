<?php
namespace App\Mail;

use App\Models\Todo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WaringMail extends Mailable
{
    use Queueable, SerializesModels;

    public $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function build(): self
    {
        return $this->markdown('emails.waring')
            ->with('todo', $this->todo); // Передача объекта Todo в шаблон
    }
}
