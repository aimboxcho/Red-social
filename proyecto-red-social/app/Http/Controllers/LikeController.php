<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LikeController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function like($image_id){
        //Recoger datos de usuario

        $user = Auth::user();

        //Condicion para ver si ya existe el like y no duplicar
        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();

        if($isset_like == 0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;

            //Guardar
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        }else{
            return response()->json([
                'message' => 'Ya le diste like'
            ]);
        }
    }

    public function dislike($image_id){
        //Recoger datos de usuario

        $user = Auth::user();

        //Condicion para ver si ya existe el like y no duplicar
        $like = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();

        if($like){

            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike',
            ]);
        }else{
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }

}
