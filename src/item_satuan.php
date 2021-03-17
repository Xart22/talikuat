<?php
	include_once('Model.php');
	
	Class ItemSatuan  extends Database
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function itemSatuan()
		{
			$itemSatuan = array();
			$itemSatuanQuery = mysqli_query($this->conn,"SELECT * FROM 
																	satuan
														");
			while($itemSatuanQueryFetch = mysqli_fetch_assoc($itemSatuanQuery))
			{
				$itemSatuan[] = $itemSatuanQueryFetch;
			}
			return $itemSatuan;
		}
	/*	
		public function maxInvoiceId()
		{
			$maxInvoiceIdQuery = mysqli_query($this->conn, "SELECT max(id)+1 AS maxInvoiceId FROM invoice_details");
			$maxInvoiceId = mysqli_fetch_assoc($maxInvoiceIdQuery);
			return $maxInvoiceId;
		}
		
		public function vat()
		{
			$vatQ = mysqli_query($this->conn, "SELECT* FROM vat");
			$vat = mysqli_fetch_assoc($vatQ);
			return $vat;
		}
		*/
	}
		
?>