<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tweeter;
use App\Tweet;
use \DB;

class TweeterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tweeters = Tweeter::all();
        $tweets = Tweet::orderBy('created_at', 'desc')->paginate(20);
        return view('tweeters.index', compact(['tweeters','tweets']));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
                'category_name' => 'required'
        ]);

        $tweeter = new Tweeter;
        $tweeter->create($request->except('_token'));
        return back();
    }

    public function show(Tweeter $tweeter)
    {
        $tweeters = Tweeter::all();
        $twits = Tweet::where('tweet_text', 'LIKE', "%{$tweeter->category_name}%")->orderBy('created_at', 'desc')->paginate(20);
        return view('tweeters.show', compact(['tweeter','tweeters','twits']));
    }
}
