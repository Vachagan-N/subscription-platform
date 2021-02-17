<?php

namespace App\Console\Commands;

use App\Mail\PublishPost;
use App\Models\Post;
use App\Models\SubscriberHistory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmailsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending emails about new posts to subscribers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        set_time_limit(60 * 60);

        foreach (Post::all() as $post) {
            $website = $post->website;
            $subscribers = $website->subscribers()->whereHas('history', function($query) use($post){
                $query->where('post_id', '!=', $post->id);
            })->get();

            foreach($subscribers->chunk(50) as $chunkedSubscribers) {
                if ($chunkedSubscribers->count()) {
                    Mail::to(config('global.default_email'))
                    ->bcc($chunkedSubscribers)
                    ->later(now(), new PublishPost($website, $post));

                    foreach($chunkedSubscribers as $subscriber) {
                        $data[] = [
                            'post_id' => $post->id,
                            'subscriber_id' => $subscriber->id
                        ];
                    }
                    SubscriberHistory::insert($data);
                }
            }
        }
    }
}
