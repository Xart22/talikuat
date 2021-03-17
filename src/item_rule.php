<?php
	include_once('Model.php');
	
	Class ItemRule  extends Database
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function itemRule()
		{
			$itemRule = array();
			$itemRuleQuery = mysqli_query($this->conn,"SELECT * FROM 
																	rule_user order by rule
														");
			while($itemRuleQueryFetch = mysqli_fetch_assoc($itemRuleQuery))
			{
				$itemRule[] = $itemRuleQueryFetch;
			}
			return $itemRule;
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
