<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PublishPost extends Mailable
{
    use Queueable, SerializesModels;

    public $website;
    public $post;
    public $subscriber;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Website $website, Post $post)
    {
        $this->website = $website;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New post on {$this->website->name}!")
        ->markdown('emails.new_post');
    }
}
