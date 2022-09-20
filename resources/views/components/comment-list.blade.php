@forelse($comments as $comment)
    <p>
        {{ $comment->content }}
    </p>
    <x-tags :tags="$comment->tags" name="{{$comment->user->name}}"></x-tags>
    <x-updated :date="$comment->created_at" name="{{$comment->user->name}}" :userId="$comment->user->id"></x-updated>
@empty
    <p>No comments yet!</p>
@endforelse
