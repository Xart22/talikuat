$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
  // Kita sembunyikan dulu untuk loadingnya
  $("#loading").hide();
  
  $("#sup").change(function(){ // Ketika user mengganti atau memilih data provinsi
    $("#ruas_jalan").hide(); // Sembunyikan dulu combobox kota nya
    $("#loading").show(); // Tampilkan loadingnya
  
        $.ajax({
            type: "POST", // Method pengiriman data bisa dengan GET atau POST
            url: "option_ruas_jalan.php", // Isi dengan url/path file php yang dituju
            data: {ruas : $("#sup").val()}, // data yang akan dikirim ke file yang dituju
            dataType: "json",
            beforeSend: function(e) {
                if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response){ // Ketika proses pengiriman berhasil
                $("#loading").hide();
                // alert(response.data_ruas_jalan);
                $("#ruas_jalan").html(response.data_ruas_jalan).show();
            },
            error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
                alert(thrownError); // Munculkan alert error
            }
        });
    });
});