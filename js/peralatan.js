 $(document).ready(function(){
	$(document).on('click', '#checkAll3', function() {          	
		$(".itemRow3").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow3', function() {  	
		if ($('.itemRow3:checked').length == $('.itemRow3').length) {
			$('#checkAll3').prop('checked', true);
		} else {
			$('#checkAll3').prop('checked', false);
		}
	});  
	var count = $(".itemRow3").length;
	$(document).on('click', '#addRows3', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow3" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" name="jenis_peralatan[]" id="jenis_peralatan_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="jumlah_peralatan[]" id="jumlah_peralatan_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="text" name="satuan_peralatan[]" id="satuan_peralatan_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		         
		htmlRows += '</tr>';
		$('#invoiceItem3').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows3', function(){
		$(".itemRow3:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll3').prop('checked', false);
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

 