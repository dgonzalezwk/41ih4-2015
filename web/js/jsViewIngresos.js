$(
	function () {
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
	}
);
function validarCierres ( sUrl , sDate ) {
	//var bResultado = false;
	//$.post( sUrl , { fecha : sDate } , function( data ){
		//console.log( data );
    	//if ( data.success ) {
    		//console.log( " resultado falso de peticion " );
			//bResultado = true;
    	//} else {
    		//console.log( " resultado falso de peticion " );
            //bResultado = false;
    	//}
	//} , "Json ");
	//console.log( "resultado:" + bResultado );
	//return bResultado;
}
