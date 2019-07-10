<script type="text/javascript">
  	$(document).ready(function(){
		
		checkPercent();

		checkDataPerform();

		// nhap ty trong
		$('input[name="percent[]"]').on('input propertychange', function() {
			checkPercent();
		});

		// nhap chi tieu
		$('input[name="target[]"]').on('input propertychange', function() {
			checkPercent();
		});

		// nhap ket qua thuc hien
	   $('input[name="perform[]"]').on('input propertychange', function() {
			updatePerform();
			checkDataPerform();
		});

		// chi nhap so nguyen
		// $('.onlynumber').keypress(function(e) {
		// 	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		// 		return false;
		// 	}
		// });

		// chi nhap so nguyen hoac so thuc
		$('.onlynumber').keypress(function(evt){
			return (/^[0-9]*\.?[0-9]*$/).test($(this).val()+evt.key);
		});
    
   });

   function checkPercent() {
	  	var totalPercent = 0;
	  	addPercent = document.getElementsByName('percent[]');
		for(var i=0;i<addPercent.length;i++) {
			if(addPercent[i].value) {
				var a = parseFloat(addPercent[i].value);
	    		totalPercent += a;
			}
	  	}
	  	$('#tPercent').html(totalPercent);
		if(totalPercent < 100) {
			$('#tPercentMsg').html('<span class="text-right text-warning">Chưa đủ 100% tỷ trọng</span>');
			$("#reviced").prop('disabled', true);
			enabledKpiForm();
		} else if(totalPercent > 100) {
			$('#tPercentMsg').html('<span class="text-right text-danger">Quá 100% tỷ trọng</span>');
			$("#reviced").prop('disabled', true);
			enabledKpiForm();
		} else if(totalPercent == 100) {
			$('#tPercentMsg').html('<span class="text-right text-success">Đủ 100% tỷ trọng</span>');
			if(checkDataPercentTarget()) {
				$("#reviced").prop('disabled', false);
			} else {
				$("#reviced").prop('disabled', true);
			}
			disableKpiForm();
		} else {
			return false;
		}
   }

   function updatePerform() {
   	url = window.location.origin + '/updatePerform';

		var idArray = $('input[name="id[]"]').map(function () {
	  		return this.value;
		}).get();

		var percentArray = $('input[name="percent[]"]').map(function () {
		  	return this.value;
		}).get();

		var targetArray = $('input[name="target[]"]').map(function () {
		  	return this.value;
		}).get();

		var performArray = $('input[name="perform[]"]').map(function () {
		  	return this.value;
		}).get();

		$.ajax(
		{
			type: 'post',
			url: url,
			data: {
				'idArray': idArray,
				'percentArray': percentArray,
				'targetArray': targetArray,
				'performArray': performArray,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
			   //
			},
			success: function(data)
			{
				reloadDataCol('per_perform[]', data);
			},
			error: function(xhr)
			{
				// console.log("An error occured: " + xhr.status + " " + xhr.statusText);
				// window.location.reload();
			}
		});
   }

   function disableKpiForm() {
   	$("#addKpiForm button").prop('disabled', true);
   	$("#addKpiForm input").prop('disabled', true);
   	$("#addKpiForm select").prop('disabled', true);
   }

   function enabledKpiForm() {
   	$("#addKpiForm button").prop('disabled', false);
   	$("#addKpiForm input").prop('disabled', false);
   	$("#addKpiForm select").prop('disabled', false);
   }

   function checkDataPercentTarget() {
   	var percentArray = $('input[name="percent[]"]').map(function () {
		  	return this.value;
		}).get();

		var targetArray = $('input[name="target[]"]').map(function () {
		  	return this.value;
		}).get();

		if(!checkExistValue(percentArray) || !checkExistValue(targetArray)) {
			return false;
		}
		return true;
   }

   // kiem tra co phan tu null trong array hay ko (chua nhap)
   function checkExistValue(array) {
   	for(i=0; i<array.length; i++) {
   		if(array[i] === '') {
			   return false;
			}
   	}
   	return true;
   }

   function checkDataPerform() {
   	var percentArray = $('input[name="percent[]"]').map(function () {
		  	return this.value;
		}).get();

		var targetArray = $('input[name="target[]"]').map(function () {
		  	return this.value;
		}).get();

	  	var performArray = $('input[name="perform[]"]').map(function () {
		  	return this.value;
		}).get();

		if(!checkExistValue(percentArray) || !checkExistValue(targetArray) || !checkExistValue(performArray)) {
			$("#evaluate").prop('disabled', true);
			return false;
		} else {
			$("#evaluate").prop('disabled', false);
			return true;
		}
   }

   // click nhan
   function reviced() {
   	updatePerform();

		$("#evaluate").prop('disabled', false);

		disableKpiForm();

		$('input[name="percent[]"]').prop('disabled', true);
		$('input[name="target[]"]').prop('disabled', true);

		$('#btnReviced').html('<button class="btn btn-info btn-xs m-3" id="retype" onclick="retype();"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Nhập lại</button>');
   }
	
   // click danh gia
   function evaluated() {
		url = window.location.origin + '/updateScores';

  		var user_id = document.getElementsByName('user_id')[0].value;

    	$.ajax(
		{
			type: 'post',
			url: url,
			data: {
				'user_id': user_id,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
          //
      	},
			success: function(data)
			{
				reloadDataCol('scores[]', data['scores']);
				reloadDataCol('efficiency[]', data['efficiency']);
				$('#tEff').html('<strong>' + data['total'] + '</strong>');
				$('#tRank').html('<strong class="text-danger">' + data['rank'] + '</strong>');
			},
			error: function(xhr)
			{
				// console.log("An error occured: " + xhr.status + " " + xhr.statusText);
				// window.location.reload();
			}
		});
   }

 	// click nut luu chi tieu
   function clickTarget() {
   	url = window.location.origin + '/updateTarget';

		var idArray = $('input[name="id[]"]').map(function () {
	  		return this.value;
		}).get();

		var targetArray = $('input[name="target[]"]').map(function () {
		  	return this.value;
		}).get();

		if(!checkExistValue(targetArray)) {
			return false;
		}

		$.ajax(
		{
			type: 'post',
			url: url,
			data: {
				'idArray': idArray,
				'targetArray': targetArray,
				'_token': '{{ csrf_token() }}'
			},
			beforeSend: function() {
			   //
			},
			success: function(data)
			{
				alert('Đã lưu');
				return false;
				// reloadDataCol('target[]', data);
			},
			error: function(xhr)
			{
				// console.log("An error occured: " + xhr.status + " " + xhr.statusText);
				// window.location.reload();
			}
		});
   }

   // load data column
   function reloadDataCol(name, data) {
   	var x = document.getElementsByName(name);
		for(i = 0; i < x.length; i++) {
	  		x[i].value = data[i];
		}
		return false;
   }

</script>

@role('admin')
	<script type="text/javascript">
		// click nhap lai
	   function retype() {
			$('input[name="percent[]"]').prop('disabled', false);
			$('input[name="target[]"]').prop('disabled', false);
			$('#btnReviced').html('<button class="btn btn-warning btn-xs m-3" id="reviced" onclick="reviced();"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Nhận</button>');
	   }
	</script>
@endrole
@role('mod') 
	<script type="text/javascript">
		// click nhap lai
	   function retype() {
			$('input[name="percent[]"]').prop('disabled', false);
			$('#btnReviced').html('<button class="btn btn-warning btn-xs m-3" id="reviced" onclick="reviced();"><i class="fa fa-fw fa-plus" aria-hidden="true"></i> Nhận</button>');
	   }
	</script>
@endrole