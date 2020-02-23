@extends('layouts.public')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>lista di tutti i post</h1>
        <ul>


        @forelse ($posts as $post)
            <li> <a href="{{ route('blog.show', [ 'slug' => $post->slug])}}">{{ $post->title}}</a> </li>

        @empty
            <li>NOn ci sono post da mostrare</li>


        @endforelse
        </ul>
      </div>
    </div>
  </div>

@endsection
