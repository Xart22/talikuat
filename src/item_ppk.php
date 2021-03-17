<?php
	include_once('Model.php');
	
	Class ItemPpk  extends Database
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function itemPpk()
		{
			$itemPpk = array();
			$itemPpkQuery = mysqli_query($this->conn,"SELECT * FROM 
																	master_ppk
														");
			while($itemPpkQueryFetch = mysqli_fetch_assoc($itemPpkQuery))
			{
				$itemPpk[] = $itemPpkQueryFetch;
			}
			return $itemPpk;
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