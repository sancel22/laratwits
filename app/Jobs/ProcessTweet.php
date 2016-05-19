<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Tweet;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessTweet extends Job implements ShouldQueue
{
    protected $tweet;

    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($tweet)
    {
        $this->tweet = $tweet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $tweet = json_decode($this->tweet, true);
        $tweet_text = $tweet['text'] ?? null;
        $user_id = $tweet['user']['id_str'] ?? null;
        $user_screen_name = $tweet['user']['screen_name'] ?? null;
        $user_avatar_url = $tweet['user']['profile_image_url_https'] ?? null;
        if (isset($tweet['id'])) {
            Tweet::create([
                'id' => $tweet['id_str'],
                'json' => $this->tweet,
                'tweet_text' => $tweet_text,
                'user_id' => $user_id,
                'user_screen_name' => $user_screen_name,
                'user_avatar_url' => $user_avatar_url,
                'approved' => 0
            ]);
        }
    }
}
