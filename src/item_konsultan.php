<?php
	include_once('Model.php');
	
	Class ItemKonsul  extends Database
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function itemKonsul()
		{
			$itemKonsul = array();
			$itemKonsulQuery = mysqli_query($this->conn,"SELECT * FROM 
																	master_konsultan
														");
			while($itemKonsulQueryFetch = mysqli_fetch_assoc($itemKonsulQuery))
			{
				$itemKonsul[] = $itemKonsulQueryFetch;
			}
			return $itemKonsul;
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
