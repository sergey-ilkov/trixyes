@extends('admin.layouts.base-show')




@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.post-show')" />

    <div class="content-box">

        <div class="content-box-top">

            <x-admin.link href="{{ route('admin.posts.index') }}" class="admin-link">

                <svg class="admin-link-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>


                <span>

                    {{__('admin.button.back')}}

                </span>

            </x-admin.link>

        </div>

    </div>

</div>

<section class="article">
    <div class="container">

        <div class="article-top">
            <a class="article__link-back" href="{{ route('admin.posts.index') }}">
                <svg width="17" height="29" viewBox="0 0 17 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.5 2L3 14.5L15.5 27" stroke="#65F967" stroke-width="3"></path>
                </svg>
            </a>
            <h1 class="article__title title-h1">
                {{ $post->title }}
            </h1>
        </div>
        <div class="article-content">
            <img class="article__img-hero" src="{{ asset('storage/' . $post->image ) }}" alt="">

            {!! $post->body !!}

        </div>




        <div class="article-bottom">
            <span class="article-info">
                {{ $post->created_at->format('d.m.Y') }}
                (
                {{ $post->views }}
                переглядів)
            </span>
        </div>


    </div>
</section>



@endsection