@extends('_layout.base')
@section('body')
        <header style="background-image: url('/images/background-contact.jpg')">
            <h1>Blog</h1>
            <p>My thoughts on industry, technology, and computer science</p>
        </header>
        <section>
            @foreach($articles as $article)
            <div class="blog-preview">
                <h2><a href="{{ Request::url() }}/{{ $article->id }}/{{ $article->slug }}">{{ $article->title }}</a></h2>
                <h3><i class="fa fa-calendar"></i> {{ $article->created_at->diffForHumans() }}</h3>
                <p>{{ substr(strip_tags((new Parsedown())->text($article->text)), 0, 250) }}...</p>
            </div>
            @endforeach
        </section>
@stop
