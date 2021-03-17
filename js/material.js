 $(document).ready(function(){
	$(document).on('click', '#checkAll1', function() {          	
		$(".itemRow1").prop("checked", this.checked);
	});	
	$(document).on('click', '.itemRow1', function() {  	
		if ($('.itemRow1:checked').length == $('.itemRow1').length) {
			$('#checkAll1').prop('checked', true);
		} else {
			$('#checkAll1').prop('checked', false);
		}
	});  
	var count = $(".itemRow1").length;
	$(document).on('click', '#addRows1', function() { 
		count++;
		var htmlRows = '';
		htmlRows += '<tr>';
		htmlRows += '<td><input class="itemRow1" type="checkbox"></td>';          
		htmlRows += '<td><input type="text" name="bahan[]" id="bahan_'+count+'" class="form-control" autocomplete="off"></td>';          
		htmlRows += '<td><input type="text" name="volume_bahan[]" id="volume_bahan_'+count+'" class="form-control" autocomplete="off"></td>';	
		htmlRows += '<td><input type="text" name="satuan_bahan[]" id="satuan_bahan_'+count+'" class="form-control quantity" autocomplete="off"></td>';   		         
		htmlRows += '</tr>';
		$('#invoiceItem1').append(htmlRows);
	}); 
	$(document).on('click', '#removeRows1', function(){
		$(".itemRow1:checked").each(function() {
			$(this).closest('tr').remove();
		});
		$('#checkAll1').prop('checked', false);
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

 