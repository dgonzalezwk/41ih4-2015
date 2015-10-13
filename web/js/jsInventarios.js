var urlBase="/41ih4-2015/web/item-inventario/";
var urlView = urlBase+'view?id=';
var urlDelete = urlBase+'delete?id=';

function controlarSubmit ( event ) {
  	event.preventDefault();
}
function limpiar(){
	$('#iteminventario-talla').val( '' );
	$('#iteminventario-color').val( '' );
	$('#iteminventario-tipo').val( '' );
	$('#iteminventario-detalle').val( '' );
	$('#iteminventario-cantidad_esperada').val( '' );
	$('#iteminventario-cantidad_defectuasa').val( '' );
	$('#iteminventario-cantidad_entregada').val( '' );
	$('#iteminventario-precio_unidad-disp').val( '' );
	$('#iteminventario-precio_mayor-disp').val( '' );
	$('#iteminventario-precio_unidad').val( '' );
	$('#iteminventario-precio_mayor').val( '' );
	$('#iteminventario-producto').val( '' );
	$('#inventario-codigobarras').val( '' );
	$('#iteminventario-codigo').val( '' );
	$('#img-producto').removeAttr( 'src' );
	$('#nombre-producto').text( '' );
	$('#codigo-producto').text('');
	$('#estado-producto').text('');
	$('#descripcion-producto').text('');
	$('#formulario').find('.previous').trigger('click');

	$( ".edit-item" ).addClass( "hidden" );
	$( ".add-item" ).removeClass( "hidden" );
}
function addTable( key , cantidad_esperada , cantidad_defectuasa , cantidad_entregada , precio_unidad , precio_mayor ){

	var talla  = $('#iteminventario-talla option:selected').html();
	$('#consolidado').find('tbody').prepend(
		$('<tr class="' + key + '"></tr>').append( 
			$('<td></td>').append( $('#inventario-codigobarras').val() )
		).append( 
			$('<td></td>').append( $('#nombre-producto').text() )
		).append( 
			$('<td></td>').append( cantidad_esperada )
		).append( 
			$('<td></td>').append( cantidad_defectuasa )
		).append( 
			$('<td></td>').append( cantidad_entregada )
		).append( 
			$('<td></td>').append( '$' + precio_unidad )
		).append( 
			$('<td></td>').append( '$' + precio_mayor )
		).append( 
			$('<td></td>').append( '$' + ( parseInt(precio_unidad) * ( parseInt(cantidad_entregada) - parseInt(cantidad_defectuasa) ) ) )
		).append( 
			$('<td></td>').append( '$' + ( parseInt(precio_mayor) * ( parseInt(cantidad_entregada) - parseInt(cantidad_defectuasa) ) ) )
		).append( 
			$('<td></td>').append( 
				$('<a href="' + urlView + key + '"></a>').
					attr( 'onclick' , "selectedItemTable( $(this) , event );" ).
					append($('<span class="glyphicon glyphicon-pencil"></span>'))
			).append( 
				$('<a href="' + urlDelete + key + '"></a>').
					attr( 'onclick' , "removeItem( $(this) , event );" ).
					append($('<span class="glyphicon glyphicon-remove"></span>'))
			)
		)
	);
}
function addList( key , cantidad_esperada , cantidad_defectuasa , cantidad_entregada , precio_unidad , precio_mayor ){

	var talla  = $('#iteminventario-talla option:selected').html();
	$('#lista').prepend(
		$('<div class="row item-list ' + key + '"></div>').append( 
			$('<div class="col-lg-3"></div>').append( 
				$('<img class="img-rounded">').attr('src' , 
					$('#img-producto').attr('src')
				).attr('style','width: 100%;')
			)
		).append( 
			$('<div class="col-lg-9"></div>').append(
				$('<div class="row"></div>').append(
					$('<div class="col-lg-6"></div>').append(
						$('<div class="row title-item-list"></div>').append(
							$('<div class="col-lg-6 text text-left"></div>').append(
								$('<h3></h3>').text(
									$('#nombre-producto').text()
								)
							)
						).append(
							$('<div class="col-lg-6 text text-right"></div>').append(
								$('<p></p>').append( 
									$('<a href="' + urlView + key + '" class="btn btn-warning" onclick="selectedItemList( $(this) , event )" role="button"><i class="glyphicon glyphicon-pencil"></i></a>')
								).append( 
									$('<a href="' + urlDelete + key + '" class="btn btn-danger"  onclick="removeItem( $(this) , event )"   role="button"><i class="glyphicon glyphicon-remove"></i></a>')
								) 
							)
						)
					) 
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Codigo&nbsp;</label>')
					).append(
						$('<p></p>').text(
							$('#iteminventario-producto').val()
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Talla&nbsp;</label>')
					).append(
						$('<p></p>').text(
							talla.split( ' - ' )[1]
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Color&nbsp;</label>')
					).append(
						$('<p></p>').text(
							$('#iteminventario-color option:selected').html()
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Tipo&nbsp;</label>')
					).append(
						$('<p></p>').text(
							$('#iteminventario-tipo option:selected').html()
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Detalle&nbsp;</label>')
					).append(
						$('<p></p>').text(
							$('#iteminventario-detalle option:selected').html()
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Cantidad Esperada&nbsp;</label>')
					).append(
						$('<p></p>').text(
							cantidad_esperada
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Cantidad Defectuasa&nbsp;</label>')
					).append(
						$('<p></p>').text(
							cantidad_defectuasa
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Cantidad Entregada&nbsp;</label>')
					).append(
						$('<p></p>').text(
							cantidad_entregada
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Precio Unidad&nbsp;</label>')
					).append(
						$('<p></p>').text(
							'$' + precio_unidad
						)
					)
				).append(
					$('<div class="col-lg-3"></div>').append(
						$('<label>Precio Mayor&nbsp;</label>')
					).append(
						$('<p></p>').text(
							'$' + precio_mayor
						)
					)
				)
			)
		)
	);
}
function removeItem ( element , event ) {
	bootbox.confirm("¿Esta seguro que desea eliminar este elemento?", function(result) {
		if( result ){
			
			var dataUrl = element.attr( 'href' );
			var partesUrl = dataUrl.split('=');
			if($('#iteminventario-codigo').val() != partesUrl[2]){
				limpiar();
			} 
			$.ajax({
			    type:'POST',
			    url: dataUrl ,
			    dataType: "json",
			    success: function(data)
			    {
			    	if( data.success == true ){

			    		$('.' + data.datos.codigo + '').remove();
					}
			    }
			});
		}
	});
	event.preventDefault();
}
function selectedItem ( element , event ) {
	
	$( ".add-item" ).addClass( "hidden" );
	$( ".edit-item" ).removeClass( "hidden" );
	var dataUrl = element.attr( 'href' );
	$.ajax({
	    type:'POST',
	    url: dataUrl ,
	    dataType: "json",
	    success: function(data)
	    {
	    	if( data.success == true ){
				var datos = data.datos;
				$('#inventario-codigobarras').val( datos.codeBar );
				$('#inventario-codigobarras').trigger( 'change' );

				$('#iteminventario-codigo').val( datos.codigo );
				$('#iteminventario-cantidad_esperada').val( datos.cantidad_esperada );
				$('#iteminventario-cantidad_defectuasa').val( datos.cantidad_defectuasa );
				$('#iteminventario-cantidad_entregada').val( datos.cantidad_entregada );

				$('#iteminventario-precio_unidad').val( datos.precio_unidad );
				$('#iteminventario-precio_mayor').val( datos.precio_mayor );

				$('#iteminventario-precio_unidad-disp').val( datos.precio_unidad + ",00" );
				$('#iteminventario-precio_mayor-disp').val( datos.precio_mayor + ",00" );

				$('#iteminventario-cantidad_actual').val( datos.cantidad_actual );
			}
	    }
	});
	event.preventDefault();
}
function selectedItemTable( element , event ){
	bootbox.confirm("¿Esta seguro que desea editar este elemento?", function(result) {
		if( result ){
			$( '#consolidado' ).attr( 'style' , 'display: none; left: 50%; opacity: 0;' );
			$( '#lista' ).attr( 'style' , 'display: none; left: 50%; opacity: 0; transform: scale(1);' );
			$('#progressbar').find('li').each(function( index ) {
				if (index != 0) {
					$(this).removeClass('active');
				}
			});
			$('#lista').find('.previous').trigger('click');
			$('#consolidado').find('.previous').trigger('click');
			selectedItem ( element , event );
		}
	});
	event.preventDefault();
}
function selectedItemList( element , event ){
	bootbox.confirm("¿Esta seguro que desea editar este elemento?", function(result) {
		if( result ){
			$('#lista').find('.previous').trigger('click');
			selectedItem ( element , event );
		}
	});
	event.preventDefault();
}
function addItem ( element , event ) {
	
	$( "#item-inventario-form" ).trigger( 'submit' );

	var href = element.attr( 'href' );
	var oldClass = element.find( 'i' ).attr('class');
	element.attr( 'disabled' , 'disabled');
	element.find( 'i' ).attr( 'class' , 'glyphicon glyphicon-refresh glyphicon-refresh-animate' );

	$.ajax({
	    type:'POST',
	    url: href ,
	    dataType: "json",
	    data: $( "#item-inventario-form" ).serialize() ,
	    success: function(data)
	    {
			if( data.success == true ){
		    	var datos = data.datos;
				var key = datos.codigo;
		    	if( typeof datos.codigoRemove == "undefined" ){
					$('.'+key).remove();
		    	} else {
		    		$('.'+datos.codigoRemove).remove();
		    	}
				addList( key , datos.cantidad_esperada , datos.cantidad_defectuasa , datos.cantidad_entregada , datos.precio_unidad , datos.precio_mayor );
				addTable( key , datos.cantidad_esperada , datos.cantidad_defectuasa , datos.cantidad_entregada , datos.precio_unidad , datos.precio_mayor );
				limpiar();
				$('#formulario').find('.next').trigger('click');
			}
	    	element.find( 'i' ).attr( 'class' , oldClass );
			element.removeAttr('disabled');
	    }
	});
	event.preventDefault();
}
function save ( element , event ) {
	var href = element.attr( 'href' );
	var oldClass = element.find( 'i' ).attr('class');
	element.attr( 'disabled' , 'disabled');
	element.find( 'i' ).attr( 'class' , 'glyphicon glyphicon-refresh glyphicon-refresh-animate' );
	bootbox.confirm("¿Esta seguro que desea guardar el inventario?", function(result) {
		if( result ){
			$('#inventario-form').attr('action', href ).unbind("submit").submit();
		} else {
			event.preventDefault();
			element.find( 'i' ).attr( 'class' , oldClass );
			element.removeAttr('disabled');
		}
	});
}
$(
	function () {
		$("#inventario-codigobarras").change(function(){
			var dataUrl = $( this ).attr( 'data-url' );
			var code = $( this ).val();
			if( code != "" && dataUrl != "" ){
				$('#iteminventario-codigo_barras').val(code);
				$.ajax({
				    type:'POST',
				    url: dataUrl ,
				    dataType: "json",
				    data: {
				    	'code' : code
				    },
				    success: function(data)
				    {
				    	if( data.success == true ){

							var datos = data.datos;

							$('#iteminventario-talla').val( parseInt(datos.talla) );
							$('#iteminventario-color').val( parseInt(datos.color) );
							$('#iteminventario-tipo').val( parseInt(datos.tipo) );
							$('#iteminventario-detalle').val( parseInt(datos.detalle) );
							$('#iteminventario-producto').val( parseInt(datos.producto.codigo) );

							$('#img-producto').attr( 'src' , datos.producto.imagen ).attr( 'style' , 'width: 100%;' );
							$('#codigo-producto').text( datos.producto.codigo );
							$('#nombre-producto').text( datos.producto.nombre );
							$('#estado-producto').text( datos.producto.estado );
							$('#descripcion-producto').text( datos.producto.descripcion );
							$('#iteminventario-cantidad_actual').val( datos.producto.cantidadActual );

						} else {
							alert( data.mensajeError );
						} 
				    }
				});
			}
		});
		$("#iteminventario-cantidad_esperada").change(function(){
			$('#iteminventario-cantidad_entregada').val( $( this ).val() );
		});
		$("#iteminventario-precio_unidad-disp").change(function(){
			$('#iteminventario-precio_mayor').val( $('#iteminventario-precio_unidad').val() );
			$('#iteminventario-precio_mayor-disp').val( $( this ).val() );
		});
		$( '#inventario-form' ).submit(controlarSubmit);
		$( "#item-inventario-form" ).submit(controlarSubmit);
	}
);