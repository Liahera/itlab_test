@extends('layouts.app')

@section('content')

    <header class="masthead" style="background-image: url('/blog/img/home-bg.jpg')">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="site-heading">
                        <h1>Mini Blog </h1>
                        <span class="subheading"></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <body>
    </body>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            @foreach($articles as $article)
                <div class="post-preview">
                    <a href="{!! route('blog.show', [
                       'id'   => $article->id,
                       'slug' => Illuminate\Support\Str::slug($article->title)
                    ]) !!}">
                        <h2 class="post-title">
                            {!! $article->title !!}
                        </h2>
                    </a>
                    <p class="post-meta">Опубликоал
                        <a href="#"> {{ $article->users()->first()->name }}  {{ $article->users()->first()->surname }}</a>
                        в {!! $article->created_at->format('H:i- d/m/Y') !!}</p>
                </div>
            @endforeach

            <!-- Pager -->
                <div class="pagination col-lg-12 col-md-12 col-sm-12 text-center">
                    <ul class="pagination" role="navigation">
                        {{ $articles->links() }}
                    </ul>
                </div>
        </div>
    </div>
</div>
@stop
