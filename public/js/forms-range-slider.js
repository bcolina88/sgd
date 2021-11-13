$(document).ready(function() {

	$("#range_default").ionRangeSlider({
	    type: "double",
	    min: 1000000,
	    max: 2000000,
	    force_edges: true
	});

	$("#range_lock").ionRangeSlider({
	    type: "double",
	    min: 0,
	    max: 100,
	    from: 30,
	    to: 70,
	    from_fixed: true
	});

	$("#range_disable").ionRangeSlider({
	    min: 0,
	    max: 100,
	    from: 30,
	    disable: true
	});

	$("#range_grid").ionRangeSlider({
	    type: "double",
	    min: 0,
	    max: 3,
		from: 0,
	    grid: true,
	    from_fixed: true
	});
	
	$("#range_grid2").ionRangeSlider({
	    type: "double",
	    min: 0,
	    max: 3,
		from: 0,
	    grid: true,
	    from_fixed: true
	});
	
	$("#range_newtons").ionRangeSlider({
	    type: "double",
	    min: 0,
	    max: 50,
		from: 0,
	    grid: true,
	    from_fixed: true
	});
	
	$("#range_newtons2").ionRangeSlider({
	    type: "double",
	    min: 0,
	    max: 50,
		from: 0,
	    grid: true,
	    from_fixed: true
	});

});