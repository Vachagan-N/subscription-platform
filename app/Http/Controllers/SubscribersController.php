<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subscribers\PostSubscribeRequest;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function subscribe(PostSubscribeRequest $request) {
        $data = $request->only(['email', 'website_id']);

        $subscriber = Subscriber::firstOrCreate($data);
        
        return response()->json([
            'status' => !!$subscriber,
            'subscriber' => $subscriber
        ]);
    }
}
