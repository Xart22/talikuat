$(document).ready(function ()
	{
		var counter = 1;
		
		$("#addrow").on("click", function () 
		{
			var selectValue = $('#nmp').val();
			var selectText = $("#nmp option:selected").text();
			//var selectText = $("#select option:selected").val();
			
			if(selectValue != 0)
			{
				
				//var re = "/\s*(?:;|$)\s*/";
				//var selectValueSplit=selectValue.split(re);
				//var selectItemId = selectValueSplit[0];
				
				var selectValueSplit = selectValue.split(",");
				var selectItemdetail = selectValueSplit[0];
				var selectItemId = selectValueSplit[1];
				var selectItemSatuan = selectValueSplit[2];
				var harga_satuan1 = $('#harga_satuan1').val();
				var volume1 = $('#volume1').val();
				var jumlah_harga1 = $('#jumlah_harga1').val();
				var bobot1 = $('#bobot1').val();
				
				//$('#extras').show();
				$('#detail_jadual').show();
				
				counter++;
				//htmlRows += '<td><input type="text" name="jenis_peralatan[]" id="jenis_peralatan_'+count+'" class="form-control" autocomplete="off"></td>';   
				var newRow = $("<tr>");
				var cols = "";
				cols += '<td>'+
							'<input type="date" class="form-control" id="tgl" name="tgl[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text" class="form-control" value='+selectItemId+' id="nmp" name="nmp[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" value='+selectText+' id="uraian" name="uraian[]" autocomplete="off"/>'+
						'</td>';
				
				cols += '<td>'+
							'<input type="text"  class="form-control" value='+selectItemSatuan+' id="satuan" name="satuan[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" value='+harga_satuan1+' id="harga_satuan" name="harga_satuan[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" value='+volume1+' id="volume" name="volume[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" value='+jumlah_harga1+' id="jumlah_harga" name="jumlah_harga[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" value='+bobot1+' id="bobot" name="bobot[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" id="koefisien" name="koefisien[]" autocomplete="off"/>'+
						'</td>';
				cols += '<td>'+
							'<input type="text"  class="form-control" id="nilai" name="nilai[]" autocomplete="off"/>'+
						'</td>';
					
				cols += '<td>'+
							'<a class="deleteRow btn btn-danger btn-xs"> <span class="fas fa-times"></span> </a>'+
						'</td>';
				newRow.append(cols);
				
				$("table.order-list").append(newRow);
				
				
			}
			
			else
				alert('Silahkan Pilih Mata Pembayaran Dulu Kang ');
		});
		
		$("table.order-list").on("keyup", 'input[name^="bobot"], input[name^="koefisien"]', function (event) 
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
		var bobot = +row.find('input[name^="bobot"]').val();
		var koefisien = +row.find('input[name^="koefisien"]').val();
		row.find('input[name^="nilai"]').val((bobot / koefisien).toFixed(2));
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
	
	
	
	
	
	