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

     /*********Shipping Status Popup***********/ 
     
     let detailsOpen = document.querySelectorAll('.details-popup');
     let detailsClose = document.querySelectorAll('.details-close');
     let detailsPopup = document.querySelectorAll('.orders-popup');

     if(detailsPopup.length > 0){
        
       detailsOpen.forEach((item)=>{
        	
        	item.addEventListener('click', ()=>{
        		console.log(item.nextElementSibling.classList)
                item.nextElementSibling.classList.remove('op-none');
                console.log(item.nextElementSibling.classList)
        	})
        })

        detailsClose.forEach((item)=>{
        	
        	item.addEventListener('click', ()=>{
               detailsPopup.forEach((item)=>{
        	
        	        item.classList.add('op-none');
        	
               })
        	})
        })

     }



      /*********Shipping Status Popup***********/ 
});



