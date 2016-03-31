(function($) {
 "use strict";

	$("#owl-example").owlCarousel({
     
        // Most important owl features
        items : 5,
        itemsCustom : false,
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [980,3],
        itemsTablet: [768,2],
        itemsTabletSmall: false,
        itemsMobile : [479,1],
        singleItem : false,
        itemsScaleUp : false,
     
        //Basic Speeds
        slideSpeed : 1000,
        paginationSpeed : 800,
        rewindSpeed : 1000,
     
        //Autoplay
        autoPlay : true,
        stopOnHover : false,
     
        // Navigation
        navigation : false,
        navigationText : ["prev","next"],
        rewindNav : true,
        scrollPerPage : false,
     
        //Pagination
        pagination : true,
        paginationNumbers: false,
     
        // Responsive 
        responsive: true,
        responsiveRefreshRate : 200,
        responsiveBaseWidth: window,
     
        // CSS Styles
        baseClass : "owl-carousel",
        theme : "owl-theme",
     
        //Lazy load
        lazyLoad : false,
        lazyFollow : true,
        lazyEffect : "fade",
     
        //Auto height
        autoHeight : false,
     
        //JSON 
        jsonPath : false, 
        jsonSuccess : false,
     
        //Mouse Events
        dragBeforeAnimFinish : true,
        mouseDrag : true,
        touchDrag : true,
     
        //Transitions
        transitionStyle : false,
     
        // Other
        addClassActive : false,
     
        //Callbacks
        beforeUpdate : false,
        afterUpdate : false,
        beforeInit: false, 
        afterInit: false, 
        beforeMove: false, 
        afterMove: false,
        afterAction: false,
        startDragging : false,
        afterLazyLoad : false
     
	})
		
	var sync5 = $("#sync5");
	var sync6 = $("#sync6");
	
	sync5.owlCarousel({
	singleItem : true,
	autoPlay : 5000,
	slideSpeed : 1000,
	stopOnHover : true,
	pagination:false,
	afterAction : syncPosition,
	responsiveRefreshRate : 200,
	});
	
	sync6.owlCarousel({
	items : 4,
	itemsDesktop      : [1170,4],
	itemsDesktopSmall     : [979,3],
	itemsTablet       : [768,3],
	itemsMobile       : [479,3],
	pagination:false,
	autoPlay : 5000,
	stopOnHover : true,
	responsiveRefreshRate : 100,
	afterInit : function(el){
	  el.find(".owl-item").eq(0).addClass("synced");
	}
	});
	
	function syncPosition(el){
	var current = this.currentItem;
	$("#sync6")
	  .find(".owl-item")
	  .removeClass("synced")
	  .eq(current)
	  .addClass("synced")
	if($("#sync6").data("owlCarousel") !== undefined){
	  center(current)
	}
	
	}
	
	$("#sync6").on("click", ".owl-item", function(e){
	e.preventDefault();
	var number = $(this).data("owlItem");
	sync5.trigger("owl.goTo",number);
	});
	
	function center(number){
	var sync6visible = sync6.data("owlCarousel").owl.visibleItems;
	
	var num = number;
	var found = false;
	for(var i in sync6visible){
	  if(num === sync6visible[i]){
		var found = true;
	  }
	}
	
	if(found===false){
	  if(num>sync6visible[sync6visible.length-1]){
		sync6.trigger("owl.goTo", num - sync6visible.length+2)
	  }else{
		if(num - 1 === -1){
		  num = 0;
		}
		sync6.trigger("owl.goTo", num);
	  }
	} else if(num === sync6visible[sync6visible.length-1]){
	  sync6.trigger("owl.goTo", sync6visible[1])
	} else if(num === sync6visible[0]){
	  sync6.trigger("owl.goTo", num-1)
	}
	}
		
	
})(jQuery);