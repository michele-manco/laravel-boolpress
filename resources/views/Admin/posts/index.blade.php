@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="float-left">Lista Post x gestione Admin</h1>
        <a class="btn btn-success float-right" href="{{ route('admin.posts.create') }}">Crea un nuovo Post</a>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <table class="table">
          <thead>
            <tr>
                <th>ID</th>
                <th>Titolo</th>
                <th>Slug</th>
                <th>Autore</th>
                <th>Azioni</th>
              </tr>
          </thead>
        <tbody>
              @forelse ($posts as $post)

                <tr>
                  <td>{{ $post->id }}</td>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->slug }}</td>
                  <td>{{ $post->author }}</td>
                  <td>
                    <a class="btn btn-info float-left" href="{{ route('admin.posts.show', ['post'=> $post->id]) }}">Visualizza</a>
                    <a class="btn btn-warning float-left" href="{{ route('admin.posts.edit', ['post'=> $post->id]) }}">Modifica</a>
                    <form class="" action="{{route('admin.posts.destroy', ['post'=> $post->id]) }}" method="post">
                      @method('DELETE')
                      @csrf
                      <input class="btn btn-danger float-left" type="submit" name="" value="Cancella">

                    </form>
                  </td>

                </tr>

              @empty
                <tr>
                  <td colspan="5">Non c'è alcun post</td>
                </tr>

              @endforelse
        </tbody>
        </table>
      </div>
    </div>
  </div>




@endsection
