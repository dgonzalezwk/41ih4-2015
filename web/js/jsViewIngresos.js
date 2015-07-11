$(function () {
	$("#combo-tipo-ingreso").change(function(){
		var valor = $('#combo-tipo-ingreso option:selected').text();
		if ( valor == "Comun" ) {
			$('.field-ingreso-cantidad_esperada').parent().removeClass('hidden');
			$('#ingreso-descripcion').attr( 'rows' , '7' );
		} else if ( valor == "Cierre de caja" ) {
			$('.field-ingreso-cantidad_esperada').parent().addClass('hidden');
			$('#ingreso-descripcion').attr( 'rows' , '6' );
		} else {  }
	});
});
$(function() {
	$('#ingreso-fecha_cierre_caja').datetimepicker().on('changeDate', function(ev){
	    alert('hola');
	});
});
