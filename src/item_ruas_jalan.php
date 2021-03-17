<?php
	include_once('Model.php');
	
	Class ItemRuas_jalan  extends Database
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function itemRuas_Jalan()
		{
			$itemRuas_Jalan = array();
			$itemRuas_JalanQuery = mysqli_query($this->conn,"SELECT * FROM 
																	ruas_jalan
														");
			while($itemRuas_JalanQueryFetch = mysqli_fetch_assoc($itemRuas_JalanQuery))
			{
				$itemRuas_Jalan[] = $itemRuas_JalanQueryFetch;
			}
			return $itemRuas_Jalan;
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
