
"use strict"; 

$(document).ready(function() {

	if($('#tableTechnician').length > 0){
		$('#tableTechnician').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			// "aoColumns": [
			// 	{ "sWidth": "95px", "sClass": "shadow" },
			// ],
			"ajax": {
				"url": AppHelper.baseUrl +"api/technician_list",
				"type": "POST"
			},
			"columnDefs": [{ 
				"targets": [ 0 ], 
				"orderable": false
			},
			{
				"targets": [ 2 ], 
				"orderable": false,
				"render": function ( data, type, row, meta ) {
					var css = (data == "Yes")? "primary" : "danger";
					return  '<span class="label label-'+css+'">'+data+'</span>';
					
				}
			},
			{
				"targets": [ 5 ], 
				"orderable": false,
				"render": function ( data, type, row, meta ) {
					return '<a href="'+AppHelper.baseUrl+'admin/get_technician_by_id/'+data+'" class="btn btn-xs btn-primary mr-10" id="updateTechnician" data-id="'+data+'">Edit</a>' 
					       + '<button type="button" class="btn btn-xs btn-default" id="deleteTechnician" data-id="'+data+'">Delete</button>';
					
				}
			},
		]
		});
	}

	$('#tableTechnician').delegate('#deleteTechnician', 'click', function(){
		var technician_id = $(this).attr('data-id');  
		lnv.confirm({
			title: 'Confirm',
			content: 'Are you sure you want to delete this technician?',
			confirmBtnText: 'Yes',
			confirmHandler: function(){
				$.ajax({
					type: 'POST',
					url: AppHelper.baseUrl  +'api/delete_technician',
					data: {technician_id : technician_id},
					dataType  : 'json',
					success: function(response){
						if(response.type == "success"){
							 $('#tableTechnician').DataTable().ajax.reload(); 
							 $('#AjaxResponse').html('<div class="alert alert-success alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-check"></i>'+response.message+'</div>');
						 }else{
							 $('#AjaxResponse').html('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>'+response.message+'</div>');
						 }
					}
				}); 				
			},
			cancelBtnText: 'No',
			cancelHandler: function(){
		
			}
		})	
	});
	
	if($('#tableClient').length > 0){
		$('#tableClient').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			// "aoColumns": [
			// 	{ "sWidth": "95px", "sClass": "shadow" },
			// ],
			"ajax": {
				"url": AppHelper.baseUrl +"api/client_list",
				"type": "POST"
			},
			"columnDefs": [{ 
				"targets": [ 0 ], 
				"orderable": false
			},
			{
				"targets": [ 5 ], 
				"orderable": false,
				"render": function ( data, type, row, meta ) {
					return '<a href="'+AppHelper.baseUrl+'admin/get_client_by_id/'+data+'" class="btn btn-xs btn-primary mr-10" id="updateClient" data-id="'+data+'">Edit</a>' 
					       + '<button type="button" class="btn btn-xs btn-default" id="deleteClient" data-id="'+data+'">Delete</button>';
					
				}
			},
		]
		});
	}

	$('#tableClient').delegate('#deleteClient', 'click', function(){
		var client_id = $(this).attr('data-id');  
		lnv.confirm({
			title: 'Confirm',
			content: 'You are about to delete this client. All the of jobs related to this client  will be deleted. Are you sure you want to delete this Client?',
			confirmBtnText: 'Yes',
			confirmHandler: function(){
				$.ajax({
					type: 'POST',
					url: AppHelper.baseUrl  +'api/delete_client',
					data: {client_id : client_id},
					dataType  : 'json',
					success: function(response){
						if(response.type == "success"){
							 $('#tableClient').DataTable().ajax.reload(); 
							 $('#AjaxResponse').html('<div class="alert alert-success alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-check"></i>'+response.message+'</div>');
						 }else{
							 $('#AjaxResponse').html('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>'+response.message+'</div>');
						 }
					}
				}); 				
			},
			cancelBtnText: 'No',
			cancelHandler: function(){
		
			}
		})	
	});
	
	if($('#tableJob').length > 0){
		$('#tableJob').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			// "aoColumns": [
			// 	{ "sWidth": "95px", "sClass": "shadow" },
			// ],
			"ajax": {
				"url": AppHelper.baseUrl +"api/job_list",
				"type": "POST",
				"data": function ( data ) {
					data.company   = $('#company').val();
					data.client_id  = $('#client_id').val();
					data.start_date = $('#start_date').val();
					data.end_date   = $('#end_date').val();
					data.category   = $('#category').val();
				}
			},

		"columnDefs": [{ 
			"targets": [ 0 ], 
			"orderable": false
		},
		{
			"targets": [ 5 ], 
			"orderable": false,
			"render": function ( data, type, row, meta ) {
				return '<a href="'+AppHelper.baseUrl+'admin/get_job_by_id/'+data+'" class="btn btn-xs btn-default mr-10" id="updateClient" data-id="'+data+'">Edit</a>' 
			     	   + '<a href="'+AppHelper.baseUrl+'admin/single_job_download/'+data+'" class="btn btn-xs btn-primary mr-10">PDF</a>'
					   + '<button type="button" class="btn btn-xs btn-default" id="delete_job" data-id="'+data+'">Delete</button>'
					   + '<a href="'+AppHelper.baseUrl+'admin/clone_job/'+data+'" class="btn btn-xs btn-primary btn-outline ml-10" data-id="'+data+'">Clone</a>';
				
			}
		},
	]
		});

		$('#apply').click(function(){ 
			$('#tableJob').DataTable().ajax.reload(); 
		});
	}

	$('#tableJob').delegate('#delete_job', 'click', function(){
		var job_id = $(this).attr('data-id');  
		lnv.confirm({
			title: 'Confirm',
			content: 'Are you sure you want to delete this Job?',
			confirmBtnText: 'Yes',
			confirmHandler: function(){
				$.ajax({
					type: 'POST',
					url: AppHelper.baseUrl  +'api/delete_job',
					data: {job_id : job_id},
					dataType  : 'json',
					success: function(response){
						if(response.type == "success"){
							 $('#tableJob').DataTable().ajax.reload(); 
							 $('#AjaxResponse').html('<div class="alert alert-success alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-check"></i>'+response.message+'</div>');
						 }else{
							 $('#AjaxResponse').html('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>'+response.message+'</div>');
						 }
					}
				}); 				
			},
			cancelBtnText: 'No',
			cancelHandler: function(){
		
			}
		})	
	});

	if($('#tableTechnicianJob').length > 0){
		$('#tableTechnicianJob').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			"ajax": {
				"url": AppHelper.baseUrl +"api/technician_job_list",
				"type": "POST",
				"data": function ( data ) {
					data.client_id  = $('#client_id').val();
					data.start_date = $('#start_date').val();
					data.end_date   = $('#end_date').val();
					data.category   = $('#category').val();
				}
			},

		"columnDefs": [{ 
			"targets": [ 0 ], 
			"orderable": false
		},
		{
			"targets": [ 4 ], 
			"orderable": false,
			"render": function ( data, type, row, meta ) {
				return '<a href="'+AppHelper.baseUrl+'technician/job_details/'+data+'" class="btn btn-xs btn-primary mr-10">View</a>';
				
			}
		},
	]
		});

		$('#applyTechnician').click(function(){ 
			$('#tableTechnicianJob').DataTable().ajax.reload(); 
		});
	}

	if($('#tableTechnicianAttendance').length > 0){
		$('#tableTechnicianAttendance').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			"ajax": {
				"url": AppHelper.baseUrl +"api/attendance_list_technician",
				"type": "POST",
				"data": function ( data ) {
					data.start_date = $('#start_date').val();
					data.end_date   = $('#end_date').val();
				}
			},
			"columnDefs": [{ 
					"targets": [ 0 ], 
					"orderable": false
			}],
			"footerCallback": function (tfoot, data, start, end, display) {
				var api = this.api(), data;

				var intVal = function ( i ) {
					return typeof i === 'string' ?
						i.replace(/[\$,]/g, '')*1 :
						typeof i === 'number' ?
							i : 0;
				};
	 
				var total = api.column( 3 ).data().reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );

				$('#totalHours').text("Total Hours: "+ total);  
			},
		});

		$('#applyAttendanceTechnician').click(function(){ 
			$('#tableTechnicianAttendance').DataTable().ajax.reload(); 
		});
	}

	if($('#tableAttendance').length > 0){
		$('#tableAttendance').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			"ajax": {
				"url": AppHelper.baseUrl +"api/attendance_list",
				"type": "POST",
				"data": function ( data ) {
					data.technician_id = $('#technician_id').val();
					data.start_date = $('#start_date').val();
					data.end_date   = $('#end_date').val();
				}
			},
			"columnDefs": [{ 
					"targets": [ 0 ], 
					"orderable": false
			},
			{
				"targets": [ 5 ], 
				"orderable": false,
				"render": function ( data, type, row, meta ) {
					return '<a href="'+AppHelper.baseUrl+'admin/update_attendance/'+data+'" class="btn btn-xs btn-primary mr-10">Edit</a>';
					
				}
			}],
			"footerCallback": function (tfoot, data, start, end, display) {
				var api = this.api(), data;

				var intVal = function ( i ) {
					return typeof i === 'string' ?
						i.replace(/[\$,]/g, '')*1 :
						typeof i === 'number' ?
							i : 0;
				};
	 
				var total = api.column( 4 ).data().reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				$('#totalHours').text("Total Hours: "+ total);  
			},
		});

		$('#applyAttendance').click(function(){ 
			$('#tableAttendance').DataTable().ajax.reload(); 
		});

		    
		$('#resetAttendance').click(function(){ 
			$('#start_date').val("")
			$('#end_date').val("");
			$('#technician_id').val("");
			$('#tableAttendance').DataTable().ajax.reload(); 
		});
		
	}

	if($("#tableEstimates").length > 0){
		$('#tableEstimates').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			"ajax": {
				"url": AppHelper.baseUrl +"api/estimate_list",
				"type": "POST",
				"data": function ( data ) {
					data.company = $('#company').val();
					data.start_date = $('#start_date').val();
					data.end_date   = $('#end_date').val();
				}
			},
			"columnDefs": [{ 
					"targets": [ 0 ], 
					"orderable": false
			},
			{
				"targets": [ 0 ], 
				"orderable": false,
				"render": function ( data, type, row, meta ) {
					return  '<span class="label label-primary">'+data+'</span>';
					
				}
			},
			{
				"targets": [ 5 ], 
				"orderable": false,
				"render": function ( data, type, row, meta ) {
					return  '<a href="'+AppHelper.baseUrl+'admin/download_estimate/'+data+'" class="btn btn-xs btn-primary mr-10">Download</a>' +
							'<a href="'+AppHelper.baseUrl+'admin/update_estimate/'+data+'" class="btn btn-xs btn-outline btn-primary mr-10">Edit</a>' +
							'<button type="button" id="delete_estimate" data-id="'+data+'" class="btn btn-xs btn-default mr-10">Delete</button>';
					
				}
			},
		]
		});

		$('#applyEstimates').click(function(){ 
			$('#tableEstimates').DataTable().ajax.reload(); 
		});

		    
		$('#resetEstimates').click(function(){ 
			$('#start_date').val("")
			$('#end_date').val("");
			$('#company').val("");
			$('#tableEstimates').DataTable().ajax.reload(); 
		});

	}

	$('#tableEstimates').delegate('#delete_estimate', 'click', function(){
		var estimates_id = $(this).attr('data-id');  
		lnv.confirm({
			title: 'Confirm',
			content: 'Are you sure you want to delete this Estimate?',
			confirmBtnText: 'Yes',
			confirmHandler: function(){
				$.ajax({
					type: 'POST',
					url: AppHelper.baseUrl  +'api/delete_estimates',
					data: {estimates_id : estimates_id},
					dataType  : 'json',
					success: function(response){
						if(response.type == "success"){
							 $('#tableEstimates').DataTable().ajax.reload(); 
							 $('#AjaxResponse').html('<div class="alert alert-success alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-check"></i>'+response.message+'</div>');
						 }else{
							 $('#AjaxResponse').html('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>'+response.message+'</div>');
						 }
					}
				}); 				
			},
			cancelBtnText: 'No',
			cancelHandler: function(){
		
			}
		})	
	});

	if($("#progressReportTable").length > 0){
		$('#progressReportTable').DataTable({
			responsive: true,
			"processing": true, 
			"serverSide": true, 
			"ordering": false,
			"ajax": {
				"url": AppHelper.baseUrl +"api/progress_report_list",
				"type": "POST",
				"data": function ( data ) {
					data.job_id = $('#job_id').val();
					data.start_date = $('#start_date').val();
					data.end_date   = $('#end_date').val();
				}
			},
			"columnDefs": [{ 
					"targets": [ 0 ], 
					"orderable": false
			},
			{
				"targets": [ 5 ], 
				"orderable": false,
				"render": function ( data, type, row, meta ) {
					return  '<a href="'+AppHelper.baseUrl+'admin/update_progress_report/'+data+'" class="btn btn-xs btn-primary mr-10">Edit</a>' +
							'<button type="button" id="delete_progressreport" data-id="'+data+'" class="btn btn-xs btn-default mr-10">Delete</button>';
					
				}
			}],
			"footerCallback": function (tfoot, data, start, end, display) {
				var api = this.api(), data;

				var intVal = function ( i ) {
					return typeof i === 'string' ?
						i.replace(/[\$,]/g, '')*1 :
						typeof i === 'number' ?
							i : 0;
				};
	 
				var total = api.column( 4 ).data().reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				$('#totalHours').text("Total Amount(LKR): "+ total);  
			},
		});

		$('#applyProgress').click(function(){ 
			$('#progressReportTable').DataTable().ajax.reload(); 
		});

		    
		$('#resetProgress').click(function(){ 
			$('#start_date').val("")
			$('#end_date').val("");
			$('#job_no').val("");
			$('#progressReportTable').DataTable().ajax.reload(); 
		});

	}

	$('#progressReportTable').delegate('#delete_progressreport', 'click', function(){
		var progress_repor_id = $(this).attr('data-id');  
		lnv.confirm({
			title: 'Confirm',
			content: 'Are you sure you want to delete this Progress Report?',
			confirmBtnText: 'Yes',
			confirmHandler: function(){
				$.ajax({
					type: 'POST',
					url: AppHelper.baseUrl  +'api/delete_progressreport',
					data: {progress_repor_id : progress_repor_id},
					dataType  : 'json',
					success: function(response){
						if(response.type == "success"){
							 $('#progressReportTable').DataTable().ajax.reload(); 
							 $('#AjaxResponse').html('<div class="alert alert-success alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-check"></i>'+response.message+'</div>');
						 }else{
							 $('#AjaxResponse').html('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>'+response.message+'</div>');
						 }
					}
				}); 				
			},
			cancelBtnText: 'No',
			cancelHandler: function(){
		
			}
		})	
	});

	if($('#attendance_chart_table').length > 0){
		$('#attendance_chart_table').DataTable({
			ordering: false,
			bFilter: false,
			bInfo : false,
			scrollY:        false,
			scrollX:        true,
			scrollCollapse: true,
			fixedColumns:   {
				leftColumns: 1
			}
		});
	}


	if($('.imageupload').length > 0){
		var $imageupload = $('.imageupload');
		$imageupload.imageupload();
	}

	if($('#date').length > 0){
		$('#date').datepicker({
			format: 'yyyy-mm-dd',
		}).on('changeDate', function(ev){
			$('#date').datepicker('hide');
		});
	}

	if($('#start_date').length > 0){
		$('#start_date').datepicker({
			format: 'yyyy-mm-dd',
		}).on('changeDate', function(ev){
			$('#start_date').datepicker('hide');
		});
	}

	if($('#end_date').length > 0){
		$('#end_date').datepicker({
			format: 'yyyy-mm-dd',
		}).on('changeDate', function(ev){
			$('#end_date').datepicker('hide');
		});
	}

	if($('#in_time').length > 0){
		$('#in_time, #out_time').datetimepicker({
			format:'Y-m-d h:i:s'
		  });
	}

	if($('#out_time').length > 0){
		$('#out_time').datetimepicker({
			format:'Y-m-d h:i:s'
		  });
	}
	
	if($('#in_time').length > 0){
		$('#in_time').datetimepicker({
			format:'Y-m-d h:i:s'
		});
	}

	if($('#estimate_date').length > 0){
		$('#estimate_date').datetimepicker({
			format:'Y-m-d h:i:s'
		});
	}


	if($('#service_type').length > 0){
	  $('#service_type').on('change', function() {
		if(this.value == "service_type_other"){
			$('#service_type_other_custom').show();
		}else{
			$('#service_type_other_custom').hide();
		}
	  });
	}

	if($('#product_type').length > 0){
		$('#product_type').on('change', function() {
		  if(this.value == "product_type_other"){
			  $('#product_type_other_custom').show();
		  }else{
			  $('#product_type_other_custom').hide();
		  }
		});
	}

	if($('#brand').length > 0){
		$('#brand').on('change', function() {
		  if(this.value == "brand_other"){
			  $('#brand_other_custom').show();
		  }else{
			  $('#brand_other_custom').hide();
		  }
		});
	}

	if($('#fault_description').length > 0){
		$('#fault_description').on('change', function() {
		  if(this.value == "fault_description_other"){
			  $('#fault_description_other_custom').show();
		  }else{
			  $('#fault_description_other_custom').hide();
		  }
		});
	}

	if($('#accessories').length > 0){
		$('#accessories').on('change', function() {
		  if(this.value == "accessories_other"){
			  $('#accessories_other_custom').show();
		  }else{
			  $('#accessories_other_custom').hide();
		  }
		});
	}

	if($('#add_technician_form').length > 0){
        $("#add_technician_form").validate();
	}
	
	if($('#add_client_form').length > 0){
        $("#add_client_form").validate();
	}
	

	$('#estimateTable').on('click', 'input[type="button"]', function () {
		$(this).closest('tr').remove();
	})

	if($('#markTechnician').length > 0){
	    $('#markTechnician').click(function() {
			var in_time = $('#in_time').val();
			var user_id = $('#user_id').val();
			$.ajax({
				type: 'POST',
				url: AppHelper.baseUrl  +'api/add_attendance_by_technician',
				data: {user_id : user_id, in_time : in_time},
				dataType  : 'json',
				success: function(response){
					if(response.type == "success"){
						$('#tableTechnicianAttendance').DataTable().ajax.reload();
						 $('#AjaxResponse').html('<div class="alert alert-success alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-check"></i>'+response.message+'</div>');
					 }else{
						 $('#AjaxResponse').html('<div class="alert alert-info alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-info-outline"></i>'+response.message+'</div>');
					 }
				}
			}); 
		});
	}


	if($(".selectJobId").length > 0){
		$('.selectJobId').select2();
	}

	if($("#tableEstimate").length > 0){
		var i = 1;
		$("#add_row").click(function(){var b=i-1;
			  $('#parentElement'+i).html($('#parentElement'+b).html()).find('td:first-child').html(i+1);
			  $('#tableEstimate').append('<tr id="parentElement'+(i+1)+'"></tr>');
			  i++; 
		  });
		$("#delete_row").click(function(){
			if(i>1){
			$("#parentElement"+(i-1)).html('');
			i--;
			}
			calc();
		});
		
		$('#tableEstimate tbody').on('keyup change',function(){
			calc();
		});

		$('#tax').on('keyup change',function(){
			calc_total();
		});

		$('#srcharges').on('change',function(){
			//$('#total_amount').val(parseInt($('#total_amount').val()) + parseInt($(this).val()).toFixed(2));
			var input =  parseInt($(this).val());
			var current = parseInt($('#total_amount').val());
			var result =  input + current;
			//console.log(result.toFixed(2));
			$('#total_amount').val(result.toFixed(2));
		});
		
	}

    if($("#save_progress_report").length > 0){
		$("#save_progress_report").click( function() {
			var job_no         = $("#job_no").val();
			var status         = $("#status").val();
			var estimate_no    = $("#estimate_no").val();
			var estimate_date  = $("#date").val();
			var estimate_value = $("#estimate_value").val();
			$.ajax({
				type: 'POST',
				url: AppHelper.baseUrl +'api/add_progress_report',
				data: {job_no : job_no, status : status, estimate_no : estimate_no, estimate_date : estimate_date, estimate_value : estimate_value},
				dataType  : 'json',
				success: function(response){
					if(response.type == "success"){
						$('#progressReportForm')[0].reset();
						$('#progressReportModal').modal('hide');
						$('#progressReportTable').DataTable().ajax.reload(); 
						$('#AjaxResponse').html('<div class="alert alert-success alert-dismissable alert-style-1"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="zmdi zmdi-check"></i>'+response.message+'</div>');
					}else{
						$('#errors').html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> You must fill in all of the fields</div>');
					}
				}
			}); 
		});
	}

	if($(".create_calculator").length > 0){
		$(document).on("click", ".create_calculator", function(ev){
			//create_calculator();
			ev.preventDefault();
		});
	}

	if($("#idCalculadora").length > 0){
	 $("#idCalculadora").Calculadora({'EtiquetaBorrar': 'Clear', TituloHTML: ''});
	}

});



function calc(){
	$('#tableEstimate tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!=''){
			var qty = $(this).find('.quantity').val();
			var price = $(this).find('.unit_price').val();
			$(this).find('.price').val(qty*price);
			var discount = $(this).find('.discount').val();
			var current_price =  qty * price;
			$(this).find('.price').val(parseInt(current_price) - (current_price * discount)/100);
			
			calc_total();
		}
    });
}


function calc_total(){
	var total=0;
	$('.price').each(function() {
        total += parseInt($(this).val());
    });
	$('#sub_total').val(total.toFixed(2));
	var tax_sum = total/100*$('#tax').val();
	$('#tax_amount').val(tax_sum.toFixed(2));
	$('#total_amount').val((tax_sum+total).toFixed(2));
}

function filter_format(html, filter, value, text) {
	return "<a href='#filter' class='text-inherit tip-datatable' data-text='"+text+"' title='"+globalLang["filter"]+"' data-filter='"+filter+"' data-value='"+value+"'>"+html+"</a>";
  }
  

