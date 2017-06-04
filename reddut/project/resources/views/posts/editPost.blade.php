@extends('layout')

@section('navbar')
  <a class="navbar-brand" href="/posts">Terug naar Posts</a>

@endsection
@section('content')
  <h2>{{ $post->title }}</h2>
  <hr>
  <div class="well well-lg">
        <form class="form-horizontal" action="/posts/{{ $post->id }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group">
              <label class="control-label col-sm-2" for="title">Title:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ $post->title }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="body">Body:</label>
              <div class="col-sm-10">
                <textarea name="body" id="body" class="form-control" >{{ $post->body }}</textarea>
              </div>
            </div>
            <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary">Update Post</button>
            </div>
            </div>
        </form>
  </div>

  @if (count($errors))
    <div class="alert alert-warning alert-dismissable fade in">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error}}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <hr>
  <h3>Voeg een comment toe:</h3>
  <form class="form-horizontal" action="/posts/{{ $post->id }}/comment" method="POST">

      {{ csrf_field() }}

    <div class="form-group">
      <label class="control-label col-sm-2" for="body">Comment:</label>
      <div class="col-sm-10">
        <textarea name="body" class="form-control" placeholder="Enter comment">{{ old('body') }}</textarea>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Add Comment</button>
      </div>
    </div>

  </form>
  <hr>
  <h1>Comments</h1>

  @foreach ($comments as $comment)
    <div class="well well-md">
      <div class="row">
        <div class="col-md-1">
          <p><i class="glyphicon glyphicon-chevron-up"></i></p>
          <p><i class="glyphicon glyphicon-chevron-down"></i></p>
        </div>
        <div class="col-md-1">
          <p class="text-center">{{ $comment->score}}</p>
        </div>
        <div class="col-md-9">
          <p>{{ $comment->body }}</p>
          <i>-{{ $comment->user->name }}</i>
        </div>
        <div class="col-md-1">
          @if ($comment->user->name == Auth::user()->name)
            <form action="/posts/{{ $post->id }}/edit" method="post">
              {{ csrf_field() }}

                <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i></button>
            </form><br>
            <form action="/comments/{{ $comment->id }}" method="post">
              {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">

                <button type="submit" name="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
            </form>
          @endif
        </div>
      </div>
    </div>
  @endforeach
  <hr>




@endsection
