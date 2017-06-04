@extends('layout')

@section('navbar')
  <a class="navbar-brand" href="../posts">Terug naar Posts</a>

@endsection
@section('content')

{{-- POST --}}

  <h2>{{ $post->title }}</h2>
  <i>{{ $post->user->name }}</i>

  <hr>
  <div class="well well-lg post">
    <div class="row">
      <div class="col-md-2 flex-center">
        <p><i class="glyphicon glyphicon-chevron-up"></i></p>
        <p>Score: {{ $post->score }}</p>
        <p><i class="glyphicon glyphicon-chevron-down"></i></p>
      </div>
      <div class="col-md-9">
        <p>{{ $post->body }}</p>
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
  <hr>



{{-- PLACE COMMENT --}}

  @if (Auth::check())
    <h3>Voeg een comment toe:</h3>
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
  @else
    <div class="alert alert-warning">
      Make an account or log in to post a comment.
    </div>
  @endif

{{-- VIEW COMMENTS --}}

  <h1>Comments</h1>

  @foreach ($comments as $comment)
    <div class="well well-md">
      <div class="row">
        <div class="col-md-1 flex-center">
          <p><i class="glyphicon glyphicon-chevron-up"></i></p>
          <p>Score: {{ $comment->score }}</p>
          <p><i class="glyphicon glyphicon-chevron-down"></i></p>
        </div>
        <div class="col-md-2 line-right">
          <p>{{ $comment->user->name }}</p>
          <p>{{ Carbon\Carbon::parse($comment->created_at)->format('d-m-Y H:i:s') }}</p>

        </div>
        <div class="col-md-8">
          <p>{{ $comment->body }}</p>
        </div>
        <div class="col-md-1 flex-center">
          @if (Auth::check() && $comment->user->name == Auth::user()->name)
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
