var addDiv;
var editDiv;
var count;

$(function() {
	$.extend($.tablesorter.themes.bootstrap, {
		table      : 'table table-bordered',
		header     : 'bootstrap-header', // give the header a gradient background
		footerRow  : '',
		footerCells: '',
		icons      : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
		sortNone   : 'fa fa-sort',
		sortAsc    : 'fa fa-chevron-up',
		sortDesc   : 'fa fa-chevron-down',
		active     : '', // applied when column is sorted
		hover      : '', // use custom css here - bootstrap class may not override it
		filterRow  : '', // filter row class
		even       : '', // odd row zebra striping
		odd        : ''  // even row zebra striping
	});
	
	$(".tablesorter").tablesorter({
		theme : "bootstrap",
		widthFixed: false,
		headerTemplate : '{content} {icon}', 
		widgets : [ "uitheme", "filter", "zebra" ],
		widgetOptions : {
			zebra : ["even", "odd"],
			filter_reset : ".reset"
		},
		headers: {
			0 : {
	        	sorter: false,
	        	filter: false
	      	},
	    }
	})
});

$(document).ready(function(){
	$(".datepicker").datepicker({'format':'dd-mm-yyyy'});
});
$(document).ready(function(){
	$('.timepicker').attr("data-format","hh:mm A");
    $('.timepicker').clockface({format: 'HH:mm A'});;
	
});


 // handle the login on enter 
$('.login input').keypress(function (e) {
    if (e.which == 13) {
        $('.login-form').submit();
    }
});

$(document).on("click", ".add-div", function() {
    var btn = $(this);
	$(".modal-body").html('Loading');
    $(".modal").modal('show');
	var initial_html = btn.html();
	addDiv = btn.attr('div-id');
	var title = btn.attr('modal-title');
	var formAction = base_url+'/'+btn.attr('action');
	$(".modal-title").html(title);
	$.ajax({
	    type: "GET",
	    url : formAction,
	    success : function(data){
	    	$(".modal-body").html(data);
			initialize();
	    }
	},"json");
});

$(document).on('click','form.ajax_add_pop button[type=submit]', function(e){
    e.preventDefault();
    if($(".ajax_add_pop").valid()){
    	var btn = $(this);
    	var initial_html = btn.html();
    	btn.html(initial_html+' <i class="fa fa-spin fa-spinner"></i>');
    	var form = jQuery(this).parents("form:first");
		var dataString = form.serialize();
		var formAction = form.attr('action');
		$.ajax({
		    type: "POST",
		    url : formAction,
		    data : dataString,
		    success : function(data){
		    	data = JSON.parse(data);
		    	if(data.success){
		    		// alert(data.message);
		    		$("#"+addDiv).append(data.message);
		    		$(".modal").modal("hide");
		    	} else {
		    		bootbox.alert(data.message);
		    	}
			    btn.html(initial_html);
		    }
		},"json");
    }
});

$(document).on("click", ".edit-div", function() {
    var btn = $(this);
    $(".modal").modal('show');
	$(".modal-body").html('Loading');
	var initial_html = btn.html();
	editDiv = btn.attr('div-id');
	count = btn.attr('count');
	var title = btn.attr('modal-title');
	var formAction = base_url+'/'+btn.attr('action');
	$(".modal-title").html(title);
	$.ajax({
	    type: "GET",
	    url : formAction,
	    success : function(data){
	    	$(".modal-body").html(data);
	    }
	},"json");

});

$(document).on('click','form.ajax_edit_pop button[type=submit]', function(e){
    e.preventDefault();
    if($(".ajax_edit_pop").valid()){
    	var btn = $(this);
    	var initial_html = btn.html();
    	btn.html(initial_html+' <i class="fa fa-spin fa-spinner"></i>');
    	var form = jQuery(this).parents("form:first");
		var dataString = form.serialize();
		dataString = dataString + "&count=" + count;
		var formAction = form.attr('action');
		$.ajax({
		    type: "PUT",
		    url : formAction,
		    data : dataString,
		    success : function(data){
		    	data = JSON.parse(data);
		    	if(data.success){
		    		$("#"+editDiv).replaceWith(data.message);
			    	$(".modal").modal("hide");
		    	} else {
		    		bootbox.alert(data.message);
		    	}
			    btn.html(initial_html);
		    }
		},"json");
    }
});

$(document).on("click", ".delete-div", function() {
    var btn = $(this);
	bootbox.confirm("Are you sure?", function(result) {
      if(result) {
    	var initial_html = btn.html();
    	btn.html(initial_html+' <i class="fa fa-spin fa-spinner"></i>');
		var deleteDiv = btn.attr('div-id');
		var formAction = base_url+'/'+btn.attr('action');
		$.ajax({
		    type: "DELETE",
		    url : formAction,
		    success : function(data){
		    	data = JSON.parse(data);
		    	if(!data.success) bootbox.alert(data.message);
		    	else {
		    		$("#"+deleteDiv).hide('500', function(){
		    			$("#"+deleteDiv).remove();
			    	});
		    	}
		    }
		},"json");

      }
    });
});



$(document).on("click", ".details", function() {
    var btn = $(this);
    $(".modal").modal('show');
	$(".modal-body").html('Loading');
	var initial_html = btn.html();
	
	var title = btn.attr('modal-title');
	var formAction = base_url+'/'+btn.attr('action');
	
	$(".modal-title").html(title);
	$.ajax({
	    type: "GET",
	    url : formAction,
	    success : function(data){
	    	$(".modal-body").html(data);
	    }
	},"json");

});

$(document).on('change','#stateid', function(e){
    e.preventDefault();

		var datatosend = $("#stateid").serialize();
		$.ajax({
		    type: "POST",
		    url : base_url+'/admin/statesCity',
		    data : datatosend,
		    success : function(data){
		    	data = JSON.parse(data);

		    	if(data.success){

		    		var cities = data.message;
		    		// console.log(cities);
		    		var str = '';
		    		for (var i = cities.length - 1; i >= 0; i--) {
		    			str += '<option value="'+cities[i].id+'">'+cities[i].value+'</option>'; 
		    		};
		    		$("#cityid").html(str);
			    	
		    	} else {
		    		bootbox.alert(data.message);
		    	}
		    }
		});
		
    
});
$(document).on('change','#cityid', function(e){
    e.preventDefault();
	var datatosend = $("#cityid").serialize();
	$.ajax({
	    type: "POST",
	    url : base_url+'/admin/cityArea',
	    data : datatosend,
	    success : function(data){
	    	data = JSON.parse(data);

	    	if(data.success){

	    		var areas = data.message;
	    		// console.log(areas);
	    		var str = '';
	    		for (var i = areas.length - 1; i >= 0; i--) {
	    			str += '<option value="'+areas[i].id+'">'+areas[i].value+'</option>';
	    		};
	    		$("#areaid").html(str);
		    	
	    	} else {
	    		bootbox.alert(data.message);
	    	}
	    }
	});

});
$(document).on('change','#studentClass', function(e){
    e.preventDefault();
	var datatosend = $("#studentClass").serialize();
	$.ajax({
	    type: "POST",
	    url : base_url+'/school/findsection',
	    data : datatosend,
	    success : function(data){
	    	data = JSON.parse(data);

	    	if(data.success){

	    		var areas = data.message;
	    		// console.log(areas);
	    		var str = '';
	    		str +='<option value="">---Select Section--- </option>';
	    		for (var i = areas.length - 1; i >= 0; i--) {
	    			str += '<option value="'+areas[i].id+'">'+areas[i].value+'</option>';
	    		};
	    		$("#studentSection").html(str);
		    	
	    	} else {
	    		bootbox.alert(data.message);
	    	}
	    }
	});

});

$(document).on('change','#studentClass', function(e){
    e.preventDefault();
	var datatosend = $("#studentClass").serialize();
	$.ajax({
	    type: "POST",
	    url : base_url+'/teacher/findsection',
	    data : datatosend,
	    success : function(data){
	    	data = JSON.parse(data);

	    	if(data.success){

	    		var areas = data.message;
	    		// console.log(areas);
	    		var str = '';
	    		str +='<option value="">---Select Section--- </option>';
	    		for (var i = areas.length - 1; i >= 0; i--) {
	    			str += '<option value="'+areas[i].id+'">'+areas[i].value+'</option>';
	    		};
	    		$("#studentSection").html(str);
		    	
	    	} else {
	    		bootbox.alert(data.message);
	    	}
	    }
	});

});

/*******************functions for meetings starts *********/

	
$(document).on("click", ".viewMeeting", function() {
    var btn = $(this);
	var title = btn.attr('modal-title');
	var formAction = base_url+'/'+btn.attr('action');
	$(".modal-title").html(title);
	$(".modal").modal('show');
	$(".modal-body").html('Loading');
	var initial_html = btn.html();
	var title = btn.attr('modal-title');
	$(".modal-title").html(title);
	$.ajax({
	    type: "GET",
	    url : formAction,
	    success : function(data){
	    	// data = JSON.parse(data);
	    	$(".modal-body").html(data);
	    	initialize();
	    }
	},"json");
});
$(document).on("click", ".conversationView", function(e) {
	e.preventDefault();
    var btn = $(this);
    // $(this).children().removeClass("fa-sort-asc");

	var formAction = btn.attr('action');
	var divId = btn.attr('div-id');
	$.ajax({
	    type: "GET",
	    url : formAction,
	    success : function(data){
	    	
	    	btn.children().toggleClass("fa-sort-asc");
		    data = JSON.parse(data);
	    	$(".content"+divId).toggle();
	    	$(".content"+divId).html(data.message);
	    	initialize();
	    }
	},"json");
});
$(document).on('click','form.ajax_add button[type=submit]', function(e){
    e.preventDefault();
    if($(".ajax_add").valid()){
    	var btn = $(this);
    	var initial_html = btn.html();
    	btn.html(initial_html+' <i class="fa fa-spin fa-spinner"></i>');
    	var form = jQuery(this).parents("form:first");
		var dataString = form.serialize();
		var formAction = form.attr('action');
		$.ajax({
		    type: "POST",
		    url : formAction,
		    data : dataString,
		    success : function(data){
		    	data = JSON.parse(data);
		    	if(data.success==true){
		    		// alert(data.message);
		    		$(".message").html(data.message);
		    		$(".modal").modal("hide");
		    	} else {
		    		bootbox.alert(data.message);
		    	}
			    btn.html(initial_html);
		    }
		},"json");
    }
});

// $(document).on("click",".datepicker",function(){
// 	$(this)..datepicker({'format':'dd-mm-yyyy'});
// });
$(document).on("click",".timepicker",function(){
	$('.timepicker').attr("data-format","hh:mm A");
	// $(this).clockface({format: 'HH:mm A'});;
});

function initialize(){
	$(".datepicker").datepicker({'format':'dd-mm-yyyy'});
	$('.timepicker').attr("data-format","hh:mm A");
    $('.timepicker').clockface({format: 'hh:mm A'});
    

}

/*******************functions for meetings end*********/

// $("#classId").change(function(e){
// 	e.preventDefault();
// 	var datatosend = $("#classId").serialize();
// 	$.ajax({
// 	    type: "POST",
// 	    url : 'school/subjects/getSection',
// 	    data : datatosend,
// 	    success : function(data){
	    	
// 	    	data = JSON.parse(data);
// 	    	$("#section").html(data);
// 	    }
// 	});
// });


