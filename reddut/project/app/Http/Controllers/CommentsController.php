<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;

class CommentsController extends Controller
{
    public function delete(Comment $comment)
    {
      $comment->delete();

      return redirect('/posts/' . $comment->post->id);
    }
}
