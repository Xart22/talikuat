<?php
include_once('Model.php');

class ItemPenyedia extends Database
{
	public function __construct()
	{
		parent::__construct();
	}

	public function itemPenyedia()
	{
		$itemPenyedia = array();
		$itemPenyediaQuery = mysqli_query($this->conn, "SELECT * FROM 
																	master_penyedia_jasa
														");
		while ($itemPenyediaQueryFetch = mysqli_fetch_assoc($itemPenyediaQuery)) {
			$itemPenyedia[] = $itemPenyediaQueryFetch;
		}
		return $itemPenyedia;
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
