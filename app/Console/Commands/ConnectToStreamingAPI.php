<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TwitterStream;
use App\Tweeter;

class ConnectToStreamingAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'phirehose_connect';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Connect to the Twitter Streaming API';
    protected $twitterStream;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TwitterStream $twitterStream)
    {
        parent::__construct();
        $this->twitterStream = $twitterStream;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $twitter_consumer_key = env('TWITTER_CONSUMER_KEY', '');
        $twitter_consumer_secret = env('TWITTER_CONSUMER_SECRET', '');

        $this->twitterStream->consumerKey = $twitter_consumer_key;
        $this->twitterStream->consumerSecret = $twitter_consumer_secret;
        $tweets_category = Tweeter::all();
        $keyword = [];
        foreach ($tweets_category as $key => $value) {
            $keyword[] = $value->category_name;
        }
        $this->twitterStream->setTrack($keyword);
        $this->twitterStream->consume();
    }
}
