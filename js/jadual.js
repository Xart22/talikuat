 $(document).ready(function(){
	$(document).on('click', '#checkAll', function() {          	
		$(".itemRow").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow', function() {  	
		if ($('.itemRow:checked').length == $('.itemRow').length) {
			$('#checkAll').prop('checked', true);
		} else {
			$('#checkAll').prop('checked', false);
		}
	});  
	var count = $(".itemRow").length;
	$(document).on('click', '#addRows', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow" type="checkbox"></td>';          
		htmlRows += '<td><input type="date" name="tgl[]" id="tgl_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="nmp[]" id="nmp_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="uraian[]" id="uraian_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="satuan[]" id="satuan_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="text" name="harga_satuan[]" id="harga_satuan_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="text" name="volume[]" id="volume_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="text" name="jumlah_harga[]" id="jumlah_harga_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="bobot[]" id="bobot_'+count+'" class="form-control bobot" autocomplete="off"></td>';
		htmlRows += '<td><input type="number" name="koefisien[]" id="koefisien_'+count+'" class="form-control koefisien" autocomplete="off"></td>';	
		htmlRows += '<td><input type="number" name="nilai[]" id="nilai_'+count+'" class="form-control nilai" autocomplete="off"></td>';	
		htmlRows += '</tr>';
		$('#JadualItem').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows', function(){
		$(".itemRow:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=bobot_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=koefisien_]", function(){
		calculateTotal();
	});	

	$(document).on('blur', "[id^=harga_satuan]", function(){
		jumlah();
	});	
	$(document).on('blur', "[id^=volume_]", function(){
		jumlah();
	});
	
	$(document).on('blur', "#taxRate", function(){		
		calculateTotal();
	});	
	$(document).on('blur', "#amountPaid", function(){
		var amountPaid = $(this).val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {
			$('#amountDue').val(totalAftertax);
		}	
	});	
	$(document).on('click', '.deleteInvoice', function(){
		var id = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?")){
			$.ajax({
				url:"action.php",
				method:"POST",
				dataType: "json",
				data:{id:id, action:'delete_invoice'},				
				success:function(response) {
					if(response.status == 1) {
						$('#'+id).closest("tr").remove();
					}
				}
			});
		} else {
			return false;
		}
	});
});	

function jumlah(){
	var nilaiAmount1 = 0; 
	$("[id^='volume_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("volume_",'');
		var volume = $('#volume_'+id).val();
		var harga_satuan  = $('#harga_satuan_'+id).val();
		if(!harga_satuan) {
			harga_satuan = 1;
		}
		var jumlah_harga = harga_satuan*volume;
		$('#jumlah_harga_'+id).val(parseFloat(jumlah_harga));
		nilaiAmount1 += jumlah_harga;			
	});

}

function calculateTotal(){
	var nilaiAmount = 0; 
	$("[id^='koefisien_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("koefisien_",'');
		var koefisien = $('#koefisien_'+id).val();
		var bobot  = $('#bobot_'+id).val();
		if(!bobot) {
			bobot = 1;
		}
		var nilai = bobot/koefisien;
		$('#nilai_'+id).val(parseFloat(nilai));
		nilaiAmount += nilai;			
	});
	
	$('#subTotal').val(parseFloat(totalAmount));	
	var taxRate = $("#taxRate").val();
	var subTotal = $('#subTotal').val();	
	if(subTotal) {
		var taxAmount = subTotal*taxRate/100;
		$('#taxAmount').val(taxAmount);
		subTotal = parseFloat(subTotal)+parseFloat(taxAmount);
		$('#totalAftertax').val(subTotal);		
		var amountPaid = $('#amountPaid').val();
		var totalAftertax = $('#totalAftertax').val();	
		if(amountPaid && totalAftertax) {
			totalAftertax = totalAftertax-amountPaid;			
			$('#amountDue').val(totalAftertax);
		} else {		
			$('#amountDue').val(subTotal);
		}
	}
}

 