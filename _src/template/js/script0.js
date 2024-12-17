$(document).ready(function(){
    $(document).on('click', function (e) {
    	$('#iDados').removeClass('active');
    });

    var tamanhoJanela = $(window).width();
	$(".nav-toggle").remove();

	if (tamanhoJanela < 785) { 
		$('.nav').css('left', '-350px').addClass('side-fechado');
		$('.nav').append( "<div class='nav-toggle'><button type='button' class=''><span></span><span></span><span></span></button></div>" );
		// $('nav').removeClass('container');
	} else {
		$('.nav').css('left', '0px').addClass('side-fechado');
		// $('nav').addClass('container');
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
			    left: "-350px",
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

	if (tamanhoJanela < 785) { 
		$('.nav').css('left', '-350px').addClass('side-fechado');
		$('.nav').append( "<div class='nav-toggle'><button type='button' class=''><span></span><span></span><span></span></button></div>" );
		// $('#div-master').removeClass('container');
	} else {
		$('.nav').css('left', '0px').addClass('side-fechado');
		// $('#div-master').addClass('container');
	}

	menu();
});

