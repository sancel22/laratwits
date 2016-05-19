@extends('layouts.app')

@section('content')
    <div class="row clearfix">
        <div class="col-md-12">
            <div class="col-md-3">
                @include('tweeters.sidebar')
            </div>
            <div class="col-md-9"> 
                <div class="panel panel-default">
                    <div class="panel-heading"> Tweets for {{ $tweeter->category_name }}</div>
                    <div class="panel-body">
                      {{ $twits }}
                        @foreach($twits as $tweet)
                            <div class="tweet">
                                <div class="media">
                                    <div class="media-left">
                                        <img class="img-thumbnail media-object" src="{{ $tweet->user_avatar_url }}" alt="Avatar">
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ '@' . $tweet->user_screen_name }}</h4>
                                        <p>{{ $tweet->tweet_text }}</p>
                                        <p><a target="_blank" href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id }}">
                                            View on Twitter
                                        </a></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $twits }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection