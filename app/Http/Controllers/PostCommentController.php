<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Http\Resources\Comment as CommentResource;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
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

    //http://192.168.56.101:8000/posts/1/comments
    public function index(BlogPost $post)
    {
        // dump(is_array($post->comments));
        // dump(get_class($post->comments));
        // die;
//        return $post->comments;
        return CommentResource::collection($post->comments()->with('user')->get());
//        return CommentResource::collection($post->comments);
        // return $post->comments()->with('user')->get();
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

//        Mail::to($post->user)->queue(
//            new CommentPostedMarkdown($comment)
//        );

//        ThrottledMail::dispatch(new CommentPostedMarkdown($comment), $post->user);
//
//        NotifyUsersPostWasCommented::dispatch($comment);

//        ThrottledMail::dispatch(new CommentPostedMarkdown($comment), $post->user)
//            ->onQueue('low');
//
//        NotifyUsersPostWasCommented::dispatch($comment)
//            ->onQueue('high');

        event(new \App\Events\CommentPosted($comment));


//        Mail::to($post->user)->later(
//            $when,
//            new CommentPostedMarkdown($comment)
//        );

//        $request->session()->flash('status', 'Comment was created!');

        return redirect()->back()
            ->withStatus('Comment was created!');
    }
}
