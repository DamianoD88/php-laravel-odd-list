@extends('layouts.app')

@section('content')
  <h2>{{$category->name}}</h2>

  @if ($category->categoryPost->isNotEmpty())
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Post ID</th>
          <th scope="col">Titolo</th>
          <th scope="col">Comandi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($category->categoryPost as $post)
          <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>
              <a href="{{route('admin.posts.show', $post->slug)}}" class="btn btn-outline-info px-3"><i class="fas fa-info"></i></a>
              <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-outline-secondary"><i class="far fa-edit"></i></a>
              <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST" class="d-inline-block">

                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Sei sicuro di voler cancellare l\'elemento?')"><i class="far fa-trash-alt"></i></button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <p>{{'No post'}}</p>
  @endif
  <a href="{{route('admin.categories.index')}}" class="btn btn-outline-dark"><i class="fas fa-arrow-left me-2"></i> Retry to categorie</a>


@endsection