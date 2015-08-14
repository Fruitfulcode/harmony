jQuery(document).ready(function($) 
{

  if ($(window).width() <= 640) 
  {
   if ($('.sticky-container').length > 0) 
   {
   	$(".sticky-container").removeClass( );
   }
  }
  
  
  $(window).resize(function() 
  {
   if ($(window).width() <= 640) 
   {
   	 if ($('.sticky-container').length > 0) 
	  {
	   	$(".sticky-container").removeClass( );
	  }
   }
  });

});