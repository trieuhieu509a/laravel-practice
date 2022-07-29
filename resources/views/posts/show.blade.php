@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>
        {{ $post->title }}
        <x-badge :show="(now()->diffInMinutes($post->created_at) < 3000000000000)" :slot="'Brand new Post!'">New Post!</x-badge>
    </h1>

    <p>{{ $post->content }}</p>
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


    <h4>Comments</h4>

    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
        <x-updated :date="$comment->created_at"></x-updated>
    @empty
        <p>No comments yet!</p>
    @endforelse
@endsection
