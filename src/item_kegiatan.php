<?php
	include_once('Model.php');
	
	Class ItemKegiatan  extends Database
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function itemKegiatan()
		{
			$itemKegiatan = array();
			$itemKegiatanQuery = mysqli_query($this->conn,"SELECT * FROM 
																	data_umum
														");
			while($itemKegiatanQueryFetch = mysqli_fetch_assoc($itemKegiatanQuery))
			{
				$itemKegiatan[] = $itemKegiatanQueryFetch;
			}
			return $itemKegiatan;
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