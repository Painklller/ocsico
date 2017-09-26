(function () {
	'use strict';
	// iPad and iPod detection	
	var isiPad = function(){
		return (navigator.platform.indexOf("iPad") != -1);
	};
	var isiPhone = function(){
	    return (
			(navigator.platform.indexOf("<i></i>Phone") != -1) || 
			(navigator.platform.indexOf("iPod") != -1)
	    );
	};
}());

equalheight = function(container){
		var currentTallest = 0,
		     currentRowStart = 0,
		     rowDivs = new Array(),
		     $el,
		     topPosition = 0;
		 	$(container).each(function() {

		   $el = $(this);
		   $($el).height('auto')
		   topPostion = $el.position().top;

		   if (currentRowStart != topPostion) {
		     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
		       rowDivs[currentDiv].height(currentTallest);
		     }
		     rowDivs.length = 0; // empty the array
		     currentRowStart = topPostion;
		     currentTallest = $el.height();
		     rowDivs.push($el);
		   } else {
		     rowDivs.push($el);
		     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		  }
		   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
		     rowDivs[currentDiv].height(currentTallest);
		   }
		 });
		}

		$(window).load(function() {
		  equalheight('.posts-block .posts-block-items');
		});


		$(window).resize(function(){
		  equalheight('.posts-block .posts-block-items');
		});