@extends('layout')

@section('title')
  Reddut - Posts
@endsection

@section('content')
  @if (Auth::check())
    <h1>Start een nieuwe post</h1>

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

      <form class="form-horizontal" action="posts" method="POST">

        {{ csrf_field() }}

        <div class="form-group">
          <label class="control-label col-sm-2" for="title">Title:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="body">Body:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="body" name="body" placeholder="Enter body" value="{{ old('body') }}">
          </div>
        </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Make Post</button>
        </div>
      </div>
    </form>
  @else
    <div class="alert alert-warning">
      Make an account or log in to make posts or comments.
    </div>
  @endif



  <h1>Alle Posts</h1>
  @foreach ($posts as $post)
    <div class="well post">
      <div class="row">
        <div class="col-md-2 flex-center">
          <form action="/posts/{{ $post->id }}/upvote" method="post">
              {{ csrf_field() }}

              <button type="submit" name="button" class="no-btn glyphicon glyphicon-chevron-up"></button>
          </form>
          Score: {{ $post->score }}
          <form action="/posts/{{ $post->id }}/downvote" method="post">
              {{ csrf_field() }}

              <button type="submit" name="button" class="no-btn glyphicon glyphicon-chevron-down"></button>
          </form>
        </div>
        <div class="col-md-9">
          <h3>{{ $post->title }}</h3>
          <a class="post" href="posts/{{ $post->id }}">
            <p>reacties: {{ count($post->comments) }}</p>
            <p>{{ Carbon\Carbon::parse($post->created_at)->format('d-m-Y H:i:s') }} by <i>{{ $post->user->name}}</i></p>
          </a>
        </div>
        @if (Auth::check() && $post->user->name == Auth::user()->name)
          <div class="col-md-1">
            <form action="/posts/{{ $post->id }}/edit" method="post">
              {{ csrf_field() }}

                <button type="submit" name="button" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-edit"></i></button>
            </form><br>
            <form action="/posts/{{ $post->id }}" method="post">
              {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">

                <button type="submit" name="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
            </form>
          </div>
        @endif
      </div>
    </div>

  @endforeach
@endsection
