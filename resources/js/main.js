$( document ).ready(function() {
    $(window).on('resize', function(){
	      var win = $(this); //this = window
	      if (win.width() <= 974) { 
	      		$( ".main__scroller" ).removeClass( "row" );
	      } else {
	      		$( ".main__scroller" ).addClass( "row" );
	      }


	      if (win.width() <= 750) { 
	      		$( ".my-wine div a>div:first-child" ).addClass( "col-4" );
	      } else {
	      		$( ".my-wine div a>div:first-child" ).removeClass( "col-4" );
	      }

	      if (win.width() <= 750) { 
	      		$( ".my-wine div a>div:nth-child(2)" ).addClass( "col-8" );
	      } else {
	      		$( ".my-wine div a>div:nth-child(2)" ).removeClass( "col-8" );
	      }
	});

	if ($(window).width() < 960) {
	   $( ".main__scroller" ).removeClass( "row" );
	}
	else {
	   $( ".main__scroller" ).addClass( "row" );
	}


	if ($(window).width() < 768) {
	   $( ".my-wine div a>div:first-child" ).addClass( "col-4" );
	}
	else {
	   $( ".my-wine div a>div:first-child" ).removeClass( "col-4" );
	}

	if ($(window).width() < 768) {
	   $( ".my-wine div a>div:nth-child(2)" ).addClass( "col-8" );
	}
	else {
	   $( ".my-wine div a>div:nth-child(2)" ).removeClass( "col-8" );
	}


/*
    $(window).scroll(function(){
        if ($(window).scrollTop() > 0){
            $('header').addClass('sticky');
        } else {
    		$('header').removeClass('sticky');
		}
    });
*/


    //PROFILE EDIT

    $( ".edit-personal" ).click(function() {
    	$( '#personal .edit-text' ).empty();
	  	$( '#personal .edit-text' ).append( "<input type='text'>" );
	});

	$( ".edit-password" ).click(function() {
    	$( '#pass .edit-text' ).empty();
	  	$( '#pass .edit-text' ).append( "<input type='password'>" );
	});

	$( ".edit-preferance" ).click(function() {
    	$( '#preferance .edit-text' ).empty();
	  	$( '#preferance .edit-text' ).append( "<input type='text'>" );
	});

	$(".auto-submit").change(function() {
        const el = $(this);
        let form;

        if (el.is('form')) { form = el; }
        else { form = el.closest('form'); }

        form.submit();
	});

	$("#defaultCheck2").change(function(){
		$("#over-21").toggleClass("d-none");
	});

	(function() {
		setTimeout(function () {
			if(document.getElementById("msg")!==null) {
				document.getElementById("msg").style.display = 'none';
				$.post('/hideMsg');
			}
		}, 5000);
	})();
});

// POPUP   

$('#acceptTerms').on('click', function(event){
	console.log("click");
    if( $(event.target).is('#acceptTerms')) {
        console.log("click");
        event.preventDefault();
        $('.terms-popup').addClass('is-visible');
        $('body').addClass('overflow-hidden');
    }
});
    //close popup
    $('.terms-popup').on('click', function(event){
        if( $(event.target).is('.popup-close') || $(event.target).is('.terms-popup') ) {
            event.preventDefault();
            $(this).removeClass('is-visible');
            $('body').removeClass('overflow-hidden');
        }
    });
    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event){
        if(event.which=='27'){
            $('.terms-popup').removeClass('is-visible');
        }
    });
   

