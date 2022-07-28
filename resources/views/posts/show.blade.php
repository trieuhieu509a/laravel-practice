@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p>Added {{ $post->created_at->diffForHumans() }}</p>

    @if(now()->diffInMinutes($post->created_at) < 5)
        <div class="alert alert-info">New!</div>
    @endif

    @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20000000)
{{--        @component('badge', ['type' => 'primary'])--}}
{{--            Brand new Post!--}}
{{--        @endcomponent--}}

        <x-badge :type="'primary'">
            Brand new Post!
        </x-badge>
    @endif

    <h4>Comments</h4>

    @forelse($post->comments as $comment)
        <p>
            {{ $comment->content }}
        </p>
        <p class="text-muted">
            added {{ $comment->created_at->diffForHumans() }}
        </p>
    @empty
        <p>No comments yet!</p>
    @endforelse
@endsection
