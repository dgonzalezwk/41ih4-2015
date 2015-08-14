$(function () {
    $(".modalButton").click(function(){
        var element = $(this);
        var oldClass = $(this).find( 'i' ).attr('class');
        $(this).attr( 'disabled' , 'disabled');
        $(this).find( 'i' ).attr( 'class' , 'glyphicon glyphicon-refresh glyphicon-refresh-animate' );
        if ($('#modal').data('bs.modal').isShown) {
            $.ajax({
                type:'POST',
                url: $(this).attr('value') ,
                success: function(data)
                {
                    element.find( 'i' ).attr( 'class' , oldClass );
                    element.removeAttr('disabled');
                    $('#modal').find('#modalContent').html(data);
                    $('#modal').modal('show');
                }
            });
        } else {
            $.ajax({
                type:'POST',
                url: $(this).attr('value') ,
                success: function(data)
                {
                    element.find( 'i' ).attr( 'class' , oldClass );
                    element.removeAttr('disabled');
                    $('#modal').find('#modalContent').html(data);
                    $('#modal').modal('show');
                }
            });
        }
    });
});