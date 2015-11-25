	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
	function distant() {
		$('#map_canvas').on('click', function() {
			var p1 = new google.maps.LatLng(10.732897216070397, 106.62367165088654 );//bach khoa
			var p2 = new google.maps.LatLng($('#lng').val(), $('#lat').val());
			alert((google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2));
		});
		//calculates distance between two points in km's
	}