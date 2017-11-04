<?php
namespace Operation;

class ChargeStub {
	
	private $accountNumber,$chargeType;
	
	public function __construct(string $accountNumber,string $chargeType){
        $this->accountNumber = $accountNumber;
        $this->chargeType = $chargeType;
    }

	public function getBill(){
        $WATER_BILLING = 0;
		$ELECTRIC_BILLING = 0;
		$PHONE_BILLING = 0;
		
		if($this->accountNumber == '0123444667'){
				$WATER_BILLING = 10000;
				$ELECTRIC_BILLING = 53000;
				//$ELECTRIC_BILLING = 0;
				$PHONE_BILLING = 400000;
		 }else if($this->accountNumber == '4235750021'){
				$WATER_BILLING = 410000;
				$ELECTRIC_BILLING = 3500000;
				$PHONE_BILLING = 200000;
		 }else if($this->accountNumber == '5902150431'){
				$WATER_BILLING = 5004000;
				$ELECTRIC_BILLING = 0;
				$PHONE_BILLING = 1150250;
		 }else if($this->accountNumber == '9835602413'){
				$WATER_BILLING = 0;
				$ELECTRIC_BILLING = 300000;
				$PHONE_BILLING = 240000;
		 }else if($this->accountNumber == '7840125312'){
				$WATER_BILLING = 10000;
				$ELECTRIC_BILLING = 10000;
				$PHONE_BILLING = 0;
		 }else if($this->accountNumber == '1924356780'){
				$WATER_BILLING = 10000;
				$ELECTRIC_BILLING = 700000;
				$PHONE_BILLING = 100000;
		 }else if($this->accountNumber == '2476492431'){
				$WATER_BILLING = 100000;
				$ELECTRIC_BILLING = 50000;
				$PHONE_BILLING = 50000;
		 }else if($this->accountNumber == '2476492431'){
				$WATER_BILLING = 10000;
				$ELECTRIC_BILLING = 5010;
				$PHONE_BILLING = 5001;
		 }else if($this->accountNumber == '2476492431'){
				$WATER_BILLING = -1;
				$ELECTRIC_BILLING = -30;
				$PHONE_BILLING = -1000;
		 }
		 
		 if($this->chargeType == 'WATER_BILLING'){
			 
			$chargeAmount = $WATER_BILLING;
			
		 }else if ($this->chargeType == 'ELECTRIC_BILLING'){
			 
			 $chargeAmount =  $ELECTRIC_BILLING;
			 
		 }else if ($this->chargeType == 'PHONE_BILLING'){
			 
			 $chargeAmount =  $PHONE_BILLING;
			 
		 }else{
			 
			$chargeAmount = 0 ;
			
		 }
		
		return $chargeAmount;
   }
}

?>