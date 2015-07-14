$(function () {
    $("#modalButton").click(function(){
        if ($('#modal').data('bs.modal').isShown) {
            $.ajax({
                type:'POST',
                url: $(this).attr('value') ,
                success: function(data)
                {
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
                    $('#modal').find('#modalContent').html(data);
                    $('#modal').modal('show');
                }
            });
        }
    });
});