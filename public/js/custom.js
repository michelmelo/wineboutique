document.addEventListener('DOMContentLoaded', ()=>{

   /*********INFO POPUP**************/
	     let popUpInfo = document.querySelectorAll('.popup-info-trigers');
	     let popContainer = document.querySelectorAll('.popup-info'); 

	    function openPopup(el){

	     	el.classList.add('d-block');	
	     	      
	     }

	     function closePopup(el){

	     	el.classList.remove('d-block');	

	     }

	     document.addEventListener('click', function(event) {
	      
	       popUpInfo.forEach((item)=>{

	      	
	         let isClickInside = item.contains(event.target);
	         let el = item.parentElement.nextElementSibling;	       
	       

	         if(!isClickInside ){
	         	closePopup(el)
	        
	           }

           })  
		});

	    document.addEventListener('touchstart', function(event) {
	      
	       popUpInfo.forEach((item)=>{

	      	
	         let isClickInside = item.contains(event.target);
	         let el = item.parentElement.nextElementSibling;	       

	         if(!isClickInside ){
	         	closePopup(el)
	        
	           }

           })  
		});

	    popUpInfo.forEach((item)=>{

	     	 let el = item.parentElement.nextElementSibling;
	         
	         item.addEventListener('click', (e)=>{

	             openPopup(el)
	         });
	         item.addEventListener('touchstart', ()=>{
	             openPopup(el)
	         });      

	     });

    /*********INFO POPUP**************/
    /*********SCROLL TO TOP***********/

       window.addEventListener('scroll', function(){ 
		    
		    let scrollpos = window.scrollY;
		    let scrollTopButton = document.getElementById('back-to-top');
           
           if(scrollpos > 200){

              scrollTopButton.classList.add('d-block');
              scrollTopButton.addEventListener('click', ()=>{
                    window.scrollTo({
						  top: 0,						 
						  behavior: 'smooth'
						});
              });

           }else{
              
               scrollTopButton.classList.remove('d-block');

           }		   
		    
		});

    /*********SCROLL TO TOP***********/ 
    /*********WINERY STATS FORM VALIDATION***********/ 
      let delivery = document.getElementById('delivery');
      let confirmShip = document.getElementById('confirm-ship-wine');

      confirmShip.addEventListener('click', (e)=>{

      	if(!delivery.value || delivery.value < 0){
          e.preventDefault();
          delivery.setAttribute('style', 'border: 1px solid red;');
          
         } else{
         delivery.setAttribute('style', 'border-color: initial;');
         }
      })





     /*********WINERY STATS FORM VALIDATION***********/ 
});



