jQuery(document).ready(function() {

    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
	
		jQuery(".map-canvas").each(function() {
		
			var LatValue = jQuery(this).attr('data-lat');
			var LngValue = jQuery(this).attr('data-lng');
			var GetID = jQuery(this).attr('id');
			var myLatLng = new google.maps.LatLng(LatValue,LngValue);
			var roadAtlasStyles = [ { "featureType": "landscape", "elementType": "geometry.fill", "stylers": [ { "color": "#474D5D" } ] },{ "elementType": "labels.text.fill", "stylers": [ { "color": "#FFFFFF" } ] },{ "elementType": "labels.text.stroke", "stylers": [ { "visibility": "off" } ] },{ "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "color": "#50525f" } ] },{ "featureType": "road", "elementType": "geometry.stroke", "stylers": [ { "visibility": "on" }, { "color": "#808080" } ] },{ "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ] },{ "featureType": "transit", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] },{ "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#808080" } ] },{ "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#3071a7" }, { "saturation": -65 } ] },{ "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] },{ "featureType": "landscape", "elementType": "geometry.stroke", "stylers": [ { "color": "#bbbbbb" } ] } ];

			var water = jQuery(this).attr('data-water');
			var landscape = jQuery(this).attr('data-landscape');
			var road = jQuery(this).attr('data-road');
			var poi = jQuery(this).attr('data-poi');
			var labelstroke = jQuery(this).attr('data-labelstroke');
			var labelfill = jQuery(this).attr('data-labelfill');
			var administrative = jQuery(this).attr('data-administrative');
	
		
			var mapOptions = {
				zoom: 13,
				scrollwheel: false,
				draggable: false,
				center: myLatLng,
				styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":""+ water +""}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":""+ landscape +""}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":""+ road +""},{"lightness":-37}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":""+ poi +""}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":""+ poi +""}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":""+ labelstroke +""},{"weight":2},{"gamma":0.84}]},{"elementType":"labels.text.fill","stylers":[{"color":"" + labelfill + ""}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"weight":0.6},{"color":"" + administrative + ""}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":""+ landscape +""}]}]								
			};

			
			var mapElement = document.getElementById(GetID);

			var map = new google.maps.Map(mapElement, mapOptions);		
			
			var marker = new google.maps.Marker({
				  position: myLatLng,
				  map: map,
				  title: 'Hello World!'
			  });				
		});
        
    }

});