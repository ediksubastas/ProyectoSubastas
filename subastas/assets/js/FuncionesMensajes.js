function MensajesControlador(_tipo , _mensaje , _posicion){
	 

  		 noty({
      			theme: 'urban-noty',
      			text: _mensaje,
      			type: _tipo,
      			timeout: 3000,
      			layout: _posicion,
      			closeWith: ['button', 'click'],
      			animation: {
        			open: 'in',
        			close: 'out',
        			easing: 'swing'
      			},
    		});
}



//DESABILITAR EL EVENTO DEL ENTER AL PRESIONARLO PARA EVITAR QUE SE RECARGE  EL FORMULARIO
function disableEnterKey(e) {
    var key;
    if (window.event)
        key = window.event.keyCode;     //IE
    else
        key = e.which;     //firefox

    if (key == 13)
        return false;
    else
        return true;
};

//SE ABRE EL FANCYBOX MOSTRANDO  MENSAJE DE ESPERA
function mostrarmodalloading() {
    $.fancybox(
        '<h2>Cargando</h2><p>Espere un momento por favor.</p></br>',
        {
            'closeBtn': false,
            'autoDimensions': false,
            'closeClick': false, // prevents closing when clicking INSIDE fancybox 
            'helpers': { overlay: { closeClick: false } }, // prevents closing when clicking OUTSIDE fancybox
            'width': '350px',
            'height': '300px',
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 600,
            'speedOut': 200,
            'easingIn': 'swing',
            'easingOut': 'swing',
            'enableEscapeButton': false,
      'onComplete' : function(){$('.closer').click(function(){parent.$.fancybox.close();})},
            keys: {
                close: null
            }
        }
    );
};

//SE CIERRA EL FANCYBOX MOSTRANDO  MENSAJE DE ESPERA
function ocultarmodalloading() {
    $.fancybox.close();
};