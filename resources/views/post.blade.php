@extends('layouts.layout')

@section ('content')
    <article>

        <h1> {!! $post->title !!} </h1>

        <p>
            <a href="#">{{$post->user->name}}</a>
            in
            <a href="/categories/{{ $post->category->slug }}"> {{ $post->category->name }} </a>
        </p>

        <div>
            {!! $post->body !!}
        </div>

    </article>

    <a href="/">Volver</a>
@endsection
