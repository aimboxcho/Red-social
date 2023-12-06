@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('includes.message')
            @foreach ($images as $image)
                
            <div class="card pub_image" style="margin-bottom: 25px; padding: 0;">
                <div class="card-header">
                    <div class="container-avatar">
                        <a href="{{ route('image.detail', ['id' => $image->id])}}" style="text-decoration: none;">
                            <img src="{{ route('user.avatar', ['filename'=>$image->user->image_path]) }}" class="avatar" style="width:45px; height:45px; margin-left: 0px; border-radius: 900px; overflow:hidden;">
                            <strong style="margin-left: 5px;">{{ $image->user->name.' '.$image->user->surname }}</strong>
                            <span style="color:grey">{{ ' | @'.$image->user->nick }}</span>
                        </a>
                    </div>
                    
                </div>
                <div class="card-body" style="padding:0;">
                    <div class="image-container" style="max-height: 500px; overflow:hidden; width:100%;">
                        <img src="{{ route('image.file', ['filename' =>$image->image_path]) }}" alt="" style="width:100%; height: 100%;">
                    </div>
                    <div class="description"  style="padding: 20px; padding-bottom: 0px;">
                        
                        <span class="nickname" style="color:grey;">{{$image->user->nick}}</span>
                        <span class="nickname" style="color: grey;">
                            {{ ' | '.$image->created_at->locale('es_ES')->diffForHumans(null, false, false, 1) }}
                        </span>
                        <p>{{ $image->description }}</p>
                    </div>
                    <div class="likes" style="padding:15px; padding-top: 0px; float:left; margin-bottom: 10px; ">
                        @if (count($image->likes->where('user_id', Auth::user()->id)))
                            <img src="{{ asset('../resources/image/heart-rojo.png') }}" alt="" style="width:30px;" data-id="{{$image->id}}" class="btn-dislike">
                        @else
                            <img src="{{ asset('../resources/image/heart-gris.png') }}" alt="" style="width:30px;" data-id="{{$image->id}}" class="btn-like">
                        @endif
                        <span style="color:grey; font-size: 13px;">{{count($image->likes)}}</span>

                    </div>
                    <div class="comments">
                        <a href="" class="btn btn-warning btn-comments btn-sm" style=" margin-top:0px;">
                            Comentarios ({{count($image->comments)}})
                        </a>
                    </div>
                    <div class="nuevo" style="padding:20px;">
                        <form action="{{ Route('comment.save') }}" method="POST" class="form">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <textarea name="content" id="" class="form-control">
                            </textarea><br>
                            @if($errors->has('content'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('content') }}</strong>
                            </span>
                        @endif
                            <input type="submit" value="Comentar" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Paginacion -->
            {{$images->links()}}
        </div>



    </div>
</div>
@endsection
