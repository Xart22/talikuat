 $(document).ready(function(){
	$(document).on('click', '#checkAll4', function() {          	
		$(".itemRow4").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow4', function() {  	
		if ($('.itemRow4:checked').length == $('.itemRow4').length) {
			$('#checkAll4').prop('checked', true);
		} else {
			$('#checkAll4').prop('checked', false);
		}
	});  
	var count = $(".itemRow4").length;
	$(document).on('click', '#addRows4', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow4" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" name="bahan_hotmix[]" id="bahan_hotmix_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="no_dt[]" id="no_dt_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="time" name="waktu_datang[]" id="waktu_datang_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="time" name="waktu_hampar[]" id="waktu_hampar_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="suhu_datang[]" id="suhu_datang_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="suhu_hampar[]" id="suhu_hampar_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="pro_p[]" id="pro_p_'+count+'" class="form-control" autocomplete="off"></td>';		
		htmlRows += '<td><input type="text" name="pro_l[]" id="pro_l_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="pro_t[]" id="pro_t_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '<td><input type="text" name="ket_hotmix[]" id="ket_hotmix_'+count+'" class="form-control" autocomplete="off"></td>';
		htmlRows += '</tr>';
		$('#invoiceItem4').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows4', function(){
		$(".itemRow4:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll4').prop('checked', false);
		calculateTotal();
	});		
	$(document).on('blur', "[id^=quantity_]", function(){
		calculateTotal();
	});	
	$(document).on('blur', "[id^=price_]", function(){
		calculateTotal();
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
function calculateTotal(){
	var totalAmount = 0; 
	$("[id^='price_']").each(function() {
		var id = $(this).attr('id');
		id = id.replace("price_",'');
		var price = $('#price_'+id).val();
		var quantity  = $('#quantity_'+id).val();
		if(!quantity) {
			quantity = 1;
		}
		var total = price*quantity;
		$('#total_'+id).val(parseFloat(total));
		totalAmount += total;			
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

 