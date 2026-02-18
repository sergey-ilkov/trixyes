@extends('frontend.layouts.base-article')



@section('content')



<section class="article">
    <div class="container">

        <div class="article-top">
            <a class="article__link-back" href="{{ route('blog') }}">
                <svg width="17" height="29" viewBox="0 0 17 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.5 2L3 14.5L15.5 27" stroke="#65F967" stroke-width="3" />
                </svg>
            </a>
            <h1 class="article__title title-h1">

                {{ $post->title }}

            </h1>
        </div>

        <div class="article-content">


            <picture>
                <source media="(max-width: 600px)" srcset="{{ asset('storage/' . $post->image_min ) }}">
                <img class="article__img-hero" src="{{ asset('storage/' . $post->image ) }}" alt="{{ $post->alt_image }}">
            </picture>
            {!! $post->body !!}

        </div>


        <div class="article-bottom">
            <span class="article-info">

                {{ $post->created_at->format('d.m.Y') }}

                ({{ $post->views }} visitas)

            </span>
        </div>

    </div>
</section>



@endsection