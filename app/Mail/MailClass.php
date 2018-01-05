<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailClass extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;

    public $subject;

    protected $content;

    protected $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $params = [], string $template = 'contact_mail')
    {
        $this->name = $params['name'] ?? '';;
        $this->subject = $params['subject'] ?? 'without subject';
        $this->content = $params['content'] ?? '';
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails/' . $this->template)
            ->with([
                'name' => $this->name,
                'content' => $this->content,
            ])
            ->subject($this->subject)->from('oursite@gmail.com');
    }
}
