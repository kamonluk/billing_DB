<?php 
namespace Operation;

require_once 'DBConnection.php';

use DBConnection;
 
class Charge{
	
	private $accountNumber,$chargeType;
	
	public function __construct(string $accountNumber,string $chargeType){
        $this->accountNumber = $accountNumber;
        $this->chargeType = $chargeType;
    }
	
    public  function getCharge()
	{		
		if($this->chargeType == 'WATER_BILLING'){
			$TYPE = 1;
		 }else if($this->chargeType == 'ELECTRIC_BILLING'){
			 $TYPE = 2;
		 }else{
			 $TYPE = 0;
		 }
		
		$amount = DBConnection::getCharge($this->accountNumber, $TYPE);	
		return $amount;
	}
	
	/* public  static function clearCharge($accountNumber,$chargeType)
	{
		DBConnection::clearCharge($accountNumber, $chargeType);
	} */
	
}

?>
