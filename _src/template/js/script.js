$(document).ready(function(){
    // MASCARAS
    $('.cCelular').mask('(00) 0 0000-0000');  
    $('.cTelefone').mask('(00) 0000-0000'); 
    $('.cData').mask('00/00/0000'); 
    $('.cPreco').maskMoney({showSymbol:true, symbol:'R$ ', decimal:',', thousands:''});
    $('.cNumber').maskMoney({decimal:'.', thousands:''});
    // $('.cInteiro').maskMoney({thousands:''});
    $('.cInteiro').keyup(function(){ $(this).val(this.value.replace(/[^\d]/, '')); });

    $('#iDados').on('click', function(){
    	$(this).addClass('active');
    });

    $(document).on('click', function (e) {
    	$('#iDados').removeClass('active');
    	if(!$(".nav").hasClass("side-fechado")) {
    		$('.nav').animate({
			    left: "-200px",
			}, 100, function() {
			    $(".nav").addClass("side-fechado");
			});
    	}
    });

    var tamanhoJanela = $(window).width();
	$(".nav-toggle").remove();

	if (tamanhoJanela < 1170) { 
		$('.nav').css('left', '-200px').addClass('side-fechado');
		$('.nav').append( "<div class='nav-toggle'><button type='button' class=''><span></span><span></span><span></span></button></div>" );
		$('#div-master').removeClass('container');
	} else {
		$('.nav').css('left', '0px').addClass('side-fechado');
		$('#div-master').addClass('container');
	}

	menu();
});                 

function menu() {
	$('.nav-toggle').click(function() {
		if($(".nav").hasClass("side-fechado")) {
			$('.nav').animate({
			    left: "0px",
			}, 100, function() {
			    $(".nav").removeClass("side-fechado");
			});
		}
		else {
			$('.nav').animate({
			    left: "-200px",
			}, 100, function() {
			    $(".nav").addClass("side-fechado");
			});
		}
	});
}

//Menu Sidebar
$(window).resize(function() {
	var tamanhoJanela = $(window).width();
	$(".nav-toggle").remove();

	if (tamanhoJanela < 1170) { 
		$('.nav').css('left', '-200px').addClass('side-fechado');
		$('.nav').append( "<div class='nav-toggle'><button type='button' class=''><span></span><span></span><span></span></button></div>" );
		$('#div-master').removeClass('container');
	} else {
		$('.nav').css('left', '0px').addClass('side-fechado');
		$('#div-master').addClass('container');
	}

	menu();
});

