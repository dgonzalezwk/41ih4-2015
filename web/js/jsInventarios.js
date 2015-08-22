$(
	function () {
		$("#inventario-codigobarras").change(function(){
			var dataUrl = $( this ).attr( 'data-url' );
			var code = $( this ).val();
			if( code != "" && dataUrl != "" ){
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
	}
);
function controlarSubmit ( event ) {
  	event.preventDefault();
}
function addItem ( idForm , element , event ) {

	var href = element.attr( 'href' );
	var oldClass = element.find( 'i' ).attr('class');

	element.attr( 'disabled' , 'disabled');
	element.find( 'i' ).attr( 'class' , 'glyphicon glyphicon-refresh glyphicon-refresh-animate' );
	
	$( idForm ).submit(controlarSubmit);
	$( "#item-inventario-form" ).submit(controlarSubmit);
	$( idForm ).trigger( 'submit' );
	$( "#item-inventario-form" ).trigger( 'submit' );

	$.ajax({
	    type:'POST',
	    url: href ,
	    dataType: "json",
	    data: $( idForm ).serialize() + "" + $( "#item-inventario-form" ).serialize() ,
	    success: function(data)
	    {
			var key = $('#iteminventario-producto').val() + "" + $('#iteminventario-color').val() + "" + $('#iteminventario-talla').val() + "" + $('#iteminventario-tipo').val() + "" + $('#iteminventario-detalle').val();
			$('#' + key + '').remove();
			if( data.success == true ){
				$('#lista').prepend(
					$('<div class="row item-list" id="' + key + '" ></div>').append( 
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
												$('<a href="#" class="btn btn-warning" role="button"><i class="glyphicon glyphicon-pencil"></i></a>')
											).append( 
												$('<a href="#" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove"></i></a>')
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
										$('#iteminventario-talla').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Color&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-color').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Tipo&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-tipo').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Detalle&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-detalle').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Cantidad Esperada&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-cantidad_esperada').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Cantidad Defectuasa&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-cantidad_defectuasa').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Cantidad Entregada&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-cantidad_entregada').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Precio Unidad&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-precio_unidad-disp').val()
									)
								)
							).append(
								$('<div class="col-lg-3"></div>').append(
									$('<label>Precio Mayor&nbsp;</label>')
								).append(
									$('<p></p>').text(
										$('#iteminventario-precio_mayor-disp').val()
									)
								)
							)
						)
					)
				);
			}
			
			$('#iteminventario-talla').val( '' );
			$('#iteminventario-color').val( '' );
			$('#iteminventario-tipo').val( '' );
			$('#iteminventario-detalle').val( '' );
			$('#iteminventario-cantidad_esperada').val( '' );
			$('#iteminventario-cantidad_defectuasa').val( '' );
			$('#iteminventario-cantidad_entregada').val( '' );
			$('#iteminventario-precio_unidad-disp').val( '' );
			$('#iteminventario-precio_mayor-disp').val( '' );
			$('#iteminventario-producto').val( '' );
			$('#inventario-codigobarras').val( '' );
			$('#img-producto').removeAttr( 'src' );
			$('#nombre-producto').text( '' );
			$('#codigo-producto').text('');
			$('#estado-producto').text('');
			$('#descripcion-producto').text('');

	    	element.find( 'i' ).attr( 'class' , oldClass );
			element.removeAttr('disabled');
	    }
	});
	event.preventDefault();
}
function removeItem ( element , event ) {
	var id = element.attr( 'data-id' );
	var dataUrl = element.attr( 'href' );
	$.ajax({
	    type:'POST',
	    url: dataUrl ,
	    dataType: "json",
	    data: {
	    	'id' : id
	    },
	    success: function(data)
	    {
	    	if( data.success == true ){
	    		$('#' + id + '').remove();
			}
	    }
	});
	event.preventDefault();
}