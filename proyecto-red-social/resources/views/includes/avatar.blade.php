@if (Auth::user()->image_path)
    <div class="container-avatar">
        <img src="{{ route('user.avatar', ['filename'=>Auth::user()->image_path]) }}" class="avatar" style="width:45px; height:45px; margin-left: 25px; border-radius: 900px; overflow:hidden;">
    </div>
@endif
