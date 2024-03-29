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
                <x-badge :show="(now()->diffInMinutes($post->created_at) < 3000000000000)" :slot="'Brand new Post!'">{{ __('Brand new Post!') }}</x-badge>
            @if($post->image)
                </h1>
            </div>
            @else
                </h1>
            @endif

            <p>{{ $post->content }}</p>
            <img src="{{ $post->image ? $post->image->url() : '' }}" />
            <img src="{{ $post->image ? Storage::url($post->image->path) : '' }}" />

            <x-updated :date="$post->created_at" :name="$post->user->name"></x-updated>
            <x-updated :date="$post->updated_at">{{ __('Updated') }}</x-updated>

            {{--    @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 2000)--}}
            {{--        @component('badge', ['type' => 'primary'])--}}
            {{--            Brand new Post!--}}
            {{--        @endcomponent--}}

            {{--        <x-badge :type="'primary'">--}}
            {{--            Brand new Post!--}}
            {{--        </x-badge>--}}
            {{--    @endif--}}

            <p>{{ trans_choice('messages.people.reading', $counter) }}</p>
{{--            <p>Currently usersKey: {{ $usersKey }}</p>--}}
            <h4>{{ __('Comments') }}</h4>

            <x-commentForm route="{{ route('posts.comments.store', ['post' => $post->id]) }}"></x-commentForm>
            <x-commentList :comments="$post->comments"></x-commentList>
        </div>
        <div class="col-4">
            @include('posts._activity')
        </div>
    </div>
@endsection
