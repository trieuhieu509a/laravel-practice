<h3>
    @if($post->trashed())
        <del>
    @endif
        <a href="{{ route('posts.show', ['post' => $post->id]) }}">
            {{ $post->title }}
        </a>
    @if($post->trashed())
        </del>
    @endif
</h3>

{{--<p class="text-muted">Added {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</p>--}}
<x-updated :date="$post->created_at" name="{{$post->user->name}}" :userId="$post->user->id"></x-updated>

<x-tags :tags="$post->tags"></x-tags>

<p>
    {{ trans_choice('messages.comments', $post->comments_count) }}
</p>

<div class="mb-3">
    @auth
        @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
               class="btn btn-primary">
                {{ __('Edit') }}
            </a>
        @endcan
    @endauth

    {{-- @cannot('delete', $post)
        <p>You can't delete this post</p>
    @endcannot --}}

    @auth
        @if(!$post->trashed())
            @can('delete', $post)
                <form class="d-inline" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="{{ __('Delete!') }}" class="btn btn-primary">
                </form>
            @endcan
        @endif
    @endauth
</div>
