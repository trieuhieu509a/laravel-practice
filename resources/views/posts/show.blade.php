@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="row">
        <div class="col-8">
            @if($post->image)
            <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align: center; background-attachment: fixed;">
                <h1 style="padding-top: 100px; text-shadow: 1px 2px #000">
            @else
                <h1>
            @endif
                {{ $post->title }}
                <x-badge :show="(now()->diffInMinutes($post->created_at) < 3000000000000)" :slot="'Brand new Post!'">New Post!</x-badge>
            @if($post->image)
                </h1>
            </div>
            @else
                </h1>
            @endif

            <p>{{ $post->content }}</p>
            <img src="{{ $post->image->url() }}" />
            <img src="{{ Storage::url($post->image->path) }}" />

            <x-updated :date="$post->created_at" :name="$post->user->name"></x-updated>
            <x-updated :date="$post->updated_at">Updated</x-updated>

            {{--    @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 2000)--}}
            {{--        @component('badge', ['type' => 'primary'])--}}
            {{--            Brand new Post!--}}
            {{--        @endcomponent--}}

            {{--        <x-badge :type="'primary'">--}}
            {{--            Brand new Post!--}}
            {{--        </x-badge>--}}
            {{--    @endif--}}

            <p>Currently read by {{ $counter }} people</p>
            <p>Currently usersKey: {{ $usersKey }}</p>
            <h4>Comments</h4>

            @include('comments._form')

            <x-tags :tags="$post->tags"></x-tags>

            @forelse($post->comments as $comment)
                <p>
                    {{ $comment->content }}
                </p>
                <x-updated :date="$comment->created_at"  :name="$comment->user->name"></x-updated>
            @empty
                <p>No comments yet!</p>
            @endforelse
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection
