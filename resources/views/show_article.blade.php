@extends('layouts.app')
@section('content')
    <!-- Page Header -->
    <header class="masthead">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="post-heading">
                        <h1>{!! $article->title !!}</h1>
                        <span class="meta"> Опубликовал
                        <a href="#"> {{ $article->users()->first()->name }}  {{ $article->users()->first()->surname }}</a>
                        в {!! $article->created_at->format('H:i - d/m/Y') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {!! $article->text !!}
                </div>
            </div>
        </div>
    </article>
@stop
