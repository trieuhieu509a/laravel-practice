@extends('layouts.app')

@section('title', 'Blog Posts')

@section('content')
    <div class="row">
        <div class="col-8">
            {{-- @each('posts.partials.post', $posts, 'post') --}}
            @forelse ($posts as $key => $post)
                @include('posts.partials.post', [])
            @empty
                No posts found!
            @endforelse
        </div>
        <div class="col-4">
            <div class="container">
                <div class="row">
                    <x-card :title="'Most Commented'">
                        @slot('subtitle')
                            What people are currently talking about
                        @endslot
                        @slot('items')
                            @foreach ($mostCommented as $post)
                                <li class="list-group-item">
                                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                        {{ $post->title }}
                                    </a>
                                </li>
                            @endforeach
                        @endslot
                    </x-card>
                </div>

                <div class="row mt-4">
                    <x-card :title="'Most Active'">
                    @slot('subtitle')
                        Writers with most posts written
                    @endslot
                    @slot('items', collect($mostActive)->pluck('name'))
                    </x-card>
                </div>

                <div class="row mt-4">
                    <x-card :title="'Most Active Last Month'">
                        @slot('subtitle')
                            Users with most posts written in the month
                        @endslot
                        @slot('items', collect($mostActiveLastMonth)->pluck('name'))
                    </x-card>
                </div>
            </div>
        </div>
    </div>
@endsection
