<?php

namespace App\Http\Controllers;

use App\Http\Requests\Websites\PublishPostRequest;
use App\Models\Post;
use App\Models\SubscriberHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class WebsitesController extends Controller
{
    public function publishPost(PublishPostRequest $request) {
        Artisan::call('emails:subscribers');
        dd();
        $data = $request->only(['website_id', 'title', 'description']);

        $post = Post::create($data);

        return response()->json([
            'status' => !!$post,
            'post' => $post
        ]);
    }
}
