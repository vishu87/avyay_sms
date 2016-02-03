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

$(document).on("change","#cityId",function(e){
	e.preventDefault();
	// alert("working");
	var datatosend = $("#cityId").serialize();
	$.ajax({
		type:"post",
		url:base_url+'/admin/student/getCenter',
		data:datatosend,
		success : function(data){
			data = JSON.parse(data);
			if(data.success=='true'){
				var center = data.message;
	    		// console.log(center);
	    		var str = '';
	    		str +='<option value="">select</option>';
	    		for (var i = center.length - 1; i >= 0; i--) {
	    			str += '<option value="'+center[i].id+'">'+center[i].value+'</option>';
	    		};
	    		$('#centerId').html(str);
				
			}
			else{
				bootbox.alert(data.message);
			}
		}
	},"json");

});

$(document).on("change","#centerId",function(e){
	e.preventDefault();
	// alert("working");
	var datatosend = $("#centerId").serialize();
	$.ajax({
		type:"post",
		url:base_url+'/admin/student/getGroup',
		data:datatosend,
		success : function(data){
			data = JSON.parse(data);
			if(data.success=='true'){
				var group = data.message;
				var plans = data.plans;
	    		// console.log(center);
	    		var str = '';
	    		str +='<option value="">select</option>';
	    		for (var i = group.length - 1; i >= 0; i--) {
	    			str += '<option value="'+group[i].id+'">'+group[i].value+'</option>';
	    		};

	    		var str2 = '';
	    		str2 +='<option value="">select</option>';
	    		for (var i = plans.length - 1; i >= 0; i--) {
	    			str2 += '<option value="'+plans[i].id+'">'+plans[i].value+' month</option>';
	    		};
	    		$('#groupId').html(str);
				$('#mplan').html(str2);
			}
			else{
				bootbox.alert(data.message);
			}
		}
	},"json");

});
$(document).on("change","#mplan",function(e){
	e.preventDefault();
	// alert("working");
	var datatosend = $("#mplan").serialize();
	$.ajax({
		type:"post",
		url:base_url+'/admin/student/getFee',
		data:datatosend,
		success : function(data){
			data = JSON.parse(data);
			if(data.success=='true'){
				$('#reg_fee').val(data.message.reg_fee);
				$('#sub_fee').val(data.message.sub_fee);
				$('#kit_fee').val(data.message.kit_fee);
				$('#amount').val(data.total);
			}
			else{
				bootbox.alert(data.message);
			}
		}
	},"json");

});
$("#reg_fee").keyup(function(){
    value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());
    $("#amount").val(value);

});

$("#sub_fee").keyup(function(){
  value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());
  $("#amount").val(value);

});

$("#kit_fee").keyup(function(){
  value = parseInt($("#reg_fee").val())+parseInt($("#sub_fee").val())+parseInt($("#kit_fee").val());
  $("#amount").val(value);

});

$(document).on("click","#calculate",function(e){
	e.preventDefault();
	// alert("working");
	var dos= $("#dos").val();
	var mplan=$("#mplan").val();
	var adjust=$("#adjust").val();
	var datatosend = "dos="+dos;
	datatosend += "&mplan="+mplan;
	datatosend += "&adjust="+adjust;
	// alert(datatosend);
	$.ajax({
		type:"POST",
		url:base_url+'/admin/student/calDate',
		data:datatosend,
		success : function(data){
			data = JSON.parse(data);
			if(data.success){
				$("#sub_end").val(data.message);
			}
			else{
				bootbox.alert(data.message);
			}
		}
	},"json");
  });
