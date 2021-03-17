$(document).ready(function ()
	{
		var counter = 1;
		
		$("#addrow").on("click", function () 
		{
			var selectValue = $('#ruas_jalan2').val();
			var selectText = $("#ruas_jalan2 option:selected").text();
			//var selectText = $("#select option:selected").val();
			
			if(selectValue != 0)
			{
				
				//var re = "/\s*(?:;|$)\s*/";
				//var selectValueSplit=selectValue.split(re);
				//var selectItemId = selectValueSplit[0];
				
				var selectValueSplit = selectValue.split(",");
				var selectItemId = selectValueSplit[0];
				var selectItemPrice = selectValueSplit[1];
				var selectItemUnit = selectValueSplit[2];
				
				//$('#extras').show();
				$('#ruas_koordinat').show();
				
				var html += '<td>'+'<input type="text" class="form-control" value='+selectText+' id="ruas_jalan" name="ruas_jalan[]" autocomplete="off"/>'+'</td>';
				//html += '<td><input type="text" class="form-control" value='+selectText+' id="ruas_jalan" name="ruas_jalan[]" autocomplete="off"/></td>';   
				/*
				counter++;
				//htmlRows += '<td><input type="text" name="jenis_peralatan[]" id="jenis_peralatan_'+count+'" class="form-control" autocomplete="off"></td>';   
				var newRow = $("<tr>");
				var cols = "";
				cols += '<td>'+
							'<input type="text" class="form-control" value='+selectText+' id="ruas_jalan" name="ruas_jalan[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" id="segmen_jalan" name="segmen_jalan[]" autocomplete="off" placeholder="Km Bdg... s/d Km...Bdg"/>'+
						'</td>';
				
				cols += '<td>'+
							'<input type="text"  class="form-control" id="lat_awal" name="lat_awal[]" autocomplete="off" placeholder="-7.123456"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" id="long_awal" name="long_awal[]" autocomplete="off" placeholder="107.12345"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" id="lat_akhir" name="lat_akhir[]" autocomplete="off" placeholder="-7.12345"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" id="long_akhir" name="long_akhir[]" autocomplete="off" placeholder="107.12345"/>'+
						'</td>';
					
				cols += '<td>'+
							'<a class="deleteRow btn btn-danger btn-xs"> <span class="glyphicon glyphicon-remove"></span> </a>'+
						'</td>';
				newRow.append(cols);
				
				$("table.order-list").append(newRow);
				*/
				
			}
			
			else
				alert('Select Product');
		});
		
		$("table.order-list").on("keyup", 'input[name^="unit_price"], input[name^="qty"]', function (event) 
		{
			calculateRow($(this).closest("tr"));
			calculateGrandTotal();
		});
		
		$("table.order-list").on("click", "a.deleteRow", function (event) 
		{
			$(this).closest("tr").remove();
			calculateGrandTotal();
		});
		
		
		
	});
    
	function calculateRow(row)
	{
		var price = +row.find('input[name^="unit_price"]').val();
		var qty = +row.find('input[name^="qty"]').val();
		row.find('input[name^="unit_total"]').val((price * qty).toFixed(2));
	}
    
	function calculateGrandTotal() 
	{
		var grandTotal = 0;
		$("table.order-list").find('input[name^="unit_total"]').each(function () {
			grandTotal += +$(this).val();
		});
		$("#grandtotal").val(grandTotal.toFixed(2));
		
		
		var totalPriceWithoutTax = grandTotal.toFixed(2);
		var tax = $('#tax').val();
		//$('#tax').val(tax);
		var totalTax = (tax/100)*totalPriceWithoutTax;
		document.getElementById('totalTax').value=totalTax.toFixed(2);
					
		var total = parseInt(totalPriceWithoutTax)+parseInt(totalTax);
		document.getElementById('total').value=total.toFixed(2);
		
	}
	
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;

		return true;
	}
	
	
	
	
	
	