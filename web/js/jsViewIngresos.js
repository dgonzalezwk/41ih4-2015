$(
	function () {
		$("#combo-tipo-ingreso").change(function(){
			var valor = $('#combo-tipo-ingreso option:selected').text();
			if ( valor == "Comun" ) {
				$('#modalContent .alert').remove();
				$('#modalContent #btn-save').removeAttr( 'disabled' );
				$('.field-ingreso-cantidad_esperada').parent().removeClass('hidden');
				$('#ingreso-descripcion').attr( 'rows' , '6' );
			} else if ( valor == "Cierre de caja" ) {
				$('#modalContent .alert').remove();
				$('#modalContent #btn-save').removeAttr( 'disabled' );
				$('#ingreso-fecha_cierre_caja').val( '' );
				$('.field-ingreso-cantidad_esperada').parent().addClass('hidden');
				$('#ingreso-descripcion').attr( 'rows' , '6' );
			} else {  }
		});
	}
);
function validarCierres ( sUrl , sFecha ) {
	var valor = $('#combo-tipo-ingreso option:selected').text();
	if ( valor == "Cierre de caja" ) {
	    $.post( sUrl , { fecha : sFecha } , function( data ){
	        if ( data.success ) {
	            $('#modalContent .alert').remove();
	            $('#modalContent #btn-save').removeAttr( 'disabled' );
	            $('#ingreso-cantidad_esperada').val( data.valor );
	        } else {
	            $('#modalContent .alert').remove();
	            $('#modalContent').prepend('<div class="alert alert-danger role="alert">No puedes generar un cierre de caja en el dia seleccionado</div>');
	            $('#modalContent #btn-save').attr( 'disabled' , 'disabled' );
	        }
	    } , 'json');
	}
}
function controlarSubmit ( event ) {
	$('#modalContent #btn-save').attr( 'disabled' , 'disabled' );
  	$.ajax({
	    type:'POST',
	    url: $(this).attr('action') ,
	    data:$( this ).serialize(),
	    success: function(data)
	    {
	    	var errores = $(data).find('.has-error').length;
	    	if ( errores > 0 ) {
	    		$('#modal').find('#modalContent').html(data);
	    		$( "#modalContent form" ).submit(controlarSubmit);
	    	} else {
	    		$(document).html(data);
	    	} 
	        
	    }
	});
  	event.preventDefault();
}
$( "#modalContent form" ).submit(controlarSubmit);