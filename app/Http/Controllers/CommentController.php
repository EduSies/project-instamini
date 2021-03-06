<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        $validate = $this->validate($request, [
            'image_id' => ['required', 'integer'],
            'content' => ['required', 'string', 'max:255']
        ]);

        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detail',['id' => $image_id])
                ->with(['message' => 'El comentario ha sido publicado correctamente']);
    }

    public function delete($id)
    {
        $user = Auth::user();

        $comment = Comment::find($id);

        if( $user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id) ){
            $comment->delete();

            $message = array('message' => 'El comentario ha sido eliminado correctamente');
        } else {
            $message = array('message-error' => 'El comentario NO ha podido ser eliminado');
        }

        return redirect()->route('image.detail',['id' => $comment->image->id])
                ->with($message);
    }
}
