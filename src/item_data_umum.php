<?php
	include_once('Model.php');
	
	Class ItemData_umum  extends Database
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function itemData_Umum()
		{
			$itemData_Umum = array();
			$itemData_UmumQuery = mysqli_query($this->conn,"SELECT * FROM 
																	data_umum
														");
			while($itemData_UmumQueryFetch = mysqli_fetch_assoc($itemData_UmumQuery))
			{
				$itemData_Umum[] = $itemData_UmumQueryFetch;
			}
			return $itemData_Umum;
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
