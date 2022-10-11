<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Models\BlogPost;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        // Comment::create()
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

//        $when = now()->addMinutes(1);

//        Mail::to($post->user)->send(
////            new CommentPosted($comment)
//            new CommentPostedMarkdown($comment)
//        );

        Mail::to($post->user)->queue(
            new CommentPostedMarkdown($comment)
        );

        NotifyUsersPostWasCommented::dispatch($comment);

//        Mail::to($post->user)->later(
//            $when,
//            new CommentPostedMarkdown($comment)
//        );

//        $request->session()->flash('status', 'Comment was created!');

        return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
