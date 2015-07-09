//Definimos los tipos de estructuras
var tipEstInfo = 'informacion';
var tipEstEstr = 'estructura';
var tipEstRedir = 'redirecionar';
var tipEstMens = 'mensaje';
//Definimos los tipos de elementos
var tipFile = 'redirect';
var tipGroup = 'group';
var tipRedirect = 'redirect';
var tipContent = 'content';

function crearElementoJson(obj){
	var tipoElemento = obj.type;
	if(typeof(tipoElemento) != "undefined"){
		var element;
		var valueAction = obj.action;
		var valueAlt = obj.alt;
		var valueClass = obj.class;
		var valueContent = obj.content;
		var valueData = obj.data;
		var valueDisplay = obj.display;
		var valueEnable = obj.enable;
		var valueEnctype = obj.enctype;
		var valueEventos = obj.eventos;
		var valueHref = obj.href;
		var valueId = obj.id;
		var valueMethod = obj.method;
		var valueName = obj.name;
		var valueNameElement = obj.nameElement;
		var valueRel = obj.rel;
		var valueSrc = obj.src;
		var valueText = obj.text;
		var valueTitle = obj.title;
		var valueType = obj.type;
		var valueValue = obj.value;
		var valueSalected = obj.selected;
		//se toma primero el nombre del elemento
		if(typeof(valueNameElement) != "undefined"){

			//se crea el elemento con la etiqueta obtenida
			var element = $(valueNameElement);
			//se agregan los atributos
			if(typeof(valueClass) != "undefined"){
				$(element).addClass(valueClass);
			}
			if(typeof(valueAction) != "undefined"){
				$(element).attr("action",valueAction);
			}
			if(typeof(valueSalected) != "undefined"){
				$(element).attr("selected",valueSalected);
			}
			if(typeof(valueAlt) != "undefined"){
				$(element).attr("alt",valueAlt);
			}
			if(typeof(valueDisplay) != "undefined"){
				$(element).attr("display",valueDisplay);
			}
			if(typeof(valueEnable) != "undefined"){
				$(element).attr("disable",!valueEnable);
			}
			if(typeof(valueEnctype) != "undefined"){
				$(element).attr("enctype",valueEnctype);
			}
			if(typeof(valueHref) != "undefined"){
				$(element).attr("href",valueHref);
			}
			if(typeof(valueId) != "undefined"){
				$(element).attr("id",valueId);
			}
			if(typeof(valueMethod) != "undefined"){
				$(element).attr("method",valueMethod);
			}
			if(valueNameElement=="<input>" || valueNameElement=="<textarea>" || valueNameElement=="<select>"){
				if(typeof(valueName) != "undefined"){
					$(element).attr("name",valueName);
				}
				if (valueNameElement!="<select>") {
					if(typeof(valueType) != "undefined"){
						$(element).attr("type",valueType);
					}
				};
			}
			if(typeof(valueRel) != "undefined"){
				$(element).attr("rel",valueRel);
			}
			if(typeof(valueSrc) != "undefined"){
				$(element).attr("src",valueSrc);
			}
			if(typeof(valueTitle) != "undefined"){
				$(element).attr("title",valueTitle);
			}
			if(typeof(valueText) != "undefined"){
				$(element).text(valueText);
			}
			//se agregan los eventos al elemento
			if(typeof(valueEventos) != "undefined"){
				for (var i = 0; i < valueEventos.length; i++) {
					var eventos = valueEventos[i];
					$( "button" ).on(eventos.evento,funcion);
				};
			}
			//despede del tipo de elemento a crear la asignacion del value varia. O en caso que sea tipo Group se debe llamar el metodo a si mismo.
			if(tipFile==tipoElemento){
				if(typeof(valueValue) != "undefined"){
					//asignacion del value file
				}
				return element;
			}else if(tipGroup==tipoElemento){
				if(typeof(valueData) != "undefined"){
					for (var i = 0; i < valueData.length; i++) {
						var subJson = valueData[i];
						var subElement = crearElementoJson(subJson);
						$(element).append(subElement);
					};
				}
				return element;
			}else if(tipRedirect==tipoElemento){
				var valueUrl = obj.url;
				var valueJson = obj.Json;
				if(typeof(valueUrl) != "undefined"){
					$(element).load(valueUrl,valueJson);
				}
				return element;
			}else{
				if(typeof(valueValue) != "undefined"){
					$(element).attr("value",valueValue);
				}
				return element;
			}
		}
		if (typeof(valueNameElement) != "undefined") {
			if(tipRedirect==tipoElemento){
				var valueUrl = obj.url;
				var valueJson = obj.Json;
				$('body').load(valueUrl,valueJson);
			}
		}
	}
}
	function gestorDeContenido (objectJson) {
		//se obtiene las propiedades del Json principal
		var type = objectJson.type;
		var data = objectJson.data;
		if(typeof(type) != "undefined" || typeof(data) != "undefined"){
			//se iteran los elementos a crear
			for (var i = 0; i < data.length; i++) {
				//se obtiene el elemento
				var element = data[i];
				//se obtiene el elemento que va a contener el objeto html
				var eContent = $(element.content);
				//se define si existe el elemento 
				if(typeof(eContent) != "undefined"){
					//se obtiene el nombre del elemento a crear
					var eNameElement = element.nameElement;
					var eType = element.type;
					if(typeof(eNameElement) != "undefined" && typeof(eType) != "undefined"){
						//var eElement = crearElemento(element,type);	
						var eElement = crearElementoJson(element);
						$(eContent).append(eElement);
					}
				}
			}
		}
	}