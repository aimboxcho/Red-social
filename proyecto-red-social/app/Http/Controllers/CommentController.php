<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){

        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'required',
        ]);

        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;

        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id])->with(['message' => 'Has publicado tu comentario correctamente']);
    }

    public function delete($id){
        //Recoger datos de usuario logueado
        $user = Auth::user();

        //Conseguir objeto del comentario
        $comment = Comment::find($id);

        //Comprobar si soy el dueño del comentario o de la publicacion
        if($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)){
            $comment->delete();
            return redirect()->route('image.detail', ['id' => $comment->image])->with(['message' => 'Comentario eliminado correctamente']);
        }else{
            return redirect()->route('image.detail', ['id' => $comment->image])->with(['message' => 'El comentario no se ha eliminado']);
        }

        //Eliminar
    }
}
