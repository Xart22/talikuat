     function volume(){  
          if(document.getElementById("req").checked == true){  
            document.getElementById("request").disabled = false; 
			document.getElementById("volume_1").disabled = false;
			document.getElementById("volume_bahan_1").disabled = false;
document.getElementById("volume_bahan_2").disabled = false;				
          }else{
            document.getElementById("request").disabled = true;
			document.getElementById("volume_1").disabled = true;
			document.getElementById("volume_bahan_1").disabled = true;
			document.getElementById("volume_bahan_2").disabled = true;
          }  
     } 