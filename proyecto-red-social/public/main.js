var url = 'http://localhost/red-social/proyecto-red-social/public/';
window.addEventListener("load", function(){

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor','pointer');

    //boton de like
    function like(){
        $('.btn-like').click(function(){
            $(this).addClass('btn-dislike').unbind('click').removeClass('btn-like');
            $(this).attr('src', '../resources/image/heart-rojo.png');

            $.ajax({
                url: url+'like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado like a la publicacion');
                    }else{
                        console.log('Error al dar like');
                    }
                }
            });

            dislike();
        });
    }
    like();

    function dislike(){
        $('.btn-dislike').click(function(){
            $(this).addClass('btn-like').unbind('click').removeClass('btn-dislike');
            $(this).attr('src', '../resources/image/heart-gris.png');

            $.ajax({
                url: url+'dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('Has dado dislike a la publicacion');
                    }else{
                        console.log('Error al dar dislike');
                    }
                }
            });

            like();
        })
    }
    dislike();

});