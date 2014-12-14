var app = {
		
	formAddPath: WWW_DIR_JAVASCRIPT,	
	
	protectCSFR : function() {
		
    	$('a.csfr-required').click(function(){
    		var inst = $(this);    		
    		if (!inst.attr('data-secured')){
        		inst.attr('href',inst.attr('href')+'/(csfr)/'+WWW_CSRF);
        		inst.attr('data-secured',1);
        	}
    	});
    	
    },
    
    init_module_policy_selection : function() {
    
    	$( "#ModuleSelectedID" ).change( function () { 
    		var module_val = $( "#ModuleSelectedID" ).val();
    		if (module_val != '*'){
    		    $.getJSON(WWW_DIR_JAVASCRIPT + 'permission/modulefunctions/' + module_val ,{ }, function(data){ 
    		        if (data.error == 'false') {	 
    	                $( "#ModuleFunctionsID" ).html(data.result);
    		        }		
    	    	});
    		} else {
    		    $( "#ModuleFunctionsID" ).html( '<select name="ModuleFunction" ><option value="*">All functions></option></select>');
    		}
    	});
    	
    },
    
    single_page_map : function (lat, long) {
    	$('.map-block iframe').height(231);
    	$('.map-block iframe').width(223);
    	initialize(lat, long);
    	
    	function initialize(lat, long) {
    		
    		var mapOptions = {
    				zoom: 7,
    				center: new google.maps.LatLng(lat, long),
    				panControl: false,
    				scrollwheel: false,
    				zoomControl: true,
    				scaleControl: false,
    				streetViewControl: false,
    				mapTypeControl: false,
    				zoomControlOptions: {
    					position: google.maps.ControlPosition.LEFT_CENTER
    				},
    				mapTypeId: google.maps.MapTypeId.ROADMAP
    		}
    		var map = new google.maps.Map(document.getElementById('map_canvas'),
    				mapOptions);
    		var location = new google.maps.LatLng(lat, long);
    		var text = "  ";
    		var infowindow = new google.maps.InfoWindow({
    			content: text,
    			maxWidth: 200
    		});
    		var marker = new google.maps.Marker({
    			position: location,
    			map: map
    		});
    		
    	};
    },
    
    front_page_map : function (lat, long) {
    	$('.map-block iframe').height(431);
    	initialize(lat, long);
    	
    	function initialize(lat, long) {
    		
    		var mapOptions = {
    				zoom: 7,
    				center: new google.maps.LatLng(lat, long),
    				panControl: false,
    				scrollwheel: false,
    				zoomControl: true,
    				scaleControl: false,
    				streetViewControl: false,
    				mapTypeControl: false,
    				zoomControlOptions: {
    					position: google.maps.ControlPosition.LEFT_CENTER
    				},
    				mapTypeId: google.maps.MapTypeId.ROADMAP
    		}
    		var map = new google.maps.Map(document.getElementById('map_canvas'),
    				mapOptions);
    		
    		map.set('styles', [
    		                   {
    		                     featureType: 'all',
    		                     elementType: 'all',
    		                  
    		                     stylers: [
    		                       {   saturation:'-70' },
    		                     
    		                     ]
    		                   }
    		                 ]);
    		
    		var location = new google.maps.LatLng(lat, long);
    		var text = "  ";
    		var infowindow = new google.maps.InfoWindow({
    			content: text,
    			maxWidth: 200
    		});
    		var marker = new google.maps.Marker({
    			position: location,
    			map: map
    		});
    		
    	};
    },

};