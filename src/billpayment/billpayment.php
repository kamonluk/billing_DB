<?php namespace Operation;
	
require_once 'AccountInformationException.php';
require_once 'BillingException.php';
require_once 'ServiceAuthentication.php';
require_once 'ServiceAuthenticationStub.php';
require_once 'Charge.php';
require_once 'ChargeStub.php';
require_once 'DBConnection.php';

require_once(__DIR__.'../../outputs/Outputs.php');

use DBConnection;
use Output\Outputs;
use Charge;
use serviceauthentication;

class BillPayment
{
	private $accountNumber,$chargeType;
	
	public function __construct(string $accountNumber,string $chargeType){
        $this->accountNumber = $accountNumber;
        $this->chargeType = $chargeType;
    }
	
    //public static function pay( $serviceType, $accNo )
	public function pay(): Outputs
	{
		$canPay = true;
        $result = new Outputs();
			
		try
			{
					if($this->chargeType == 'WATER_BILLING'){
						$TYPE = 1;
					 }else if($this->chargeType == 'ELECTRIC_BILLING'){
						 $TYPE = 2;
					 }else{
						 $TYPE = 0;
					 }
					
					//	It's stub.
					//$account = ServiceAuthenticationStub::accountAuthenticationProvider( $this->accountNumber );
					$account = ServiceAuthentication::accountAuthenticationProvider( $this->accountNumber );
							
					if(count($account)==1)
					{
					    $result->errorMessage = 'ไม่พบบัญชีนี้ในระบบ';
						$canPay = false;
						//throw new AccountInformationException("Account number : {$this->accountNumber} not found.");
					}
					
					// // It's real
					//$amount = DBConnection::getCharge($this->accountNumber, $TYPE);
					
					// It's stub.
					//$amount = ChargeStub::getCharge( $this->accountNumber, $TYPE );
					
					//$amount = Charge::getCharge( $this->accountNumber, $TYPE );
					$amount = DBConnection::getCharge($this->accountNumber, $TYPE);	
							
							
					if( $account['accBalance'] < $amount )
					{
						$result->errorMessage = 'ยอดเงินในบัญชีไม่เพียงพอ';
						$canPay = false;
						//throw new BillingException("Balance is not enough");
					}
					if($amount<0)
					{
						$result->errorMessage = 'ยอดเงินที่ต้องชำระผิดพลาด';
						$canPay = false;
						//throw new BillingException("Charge invalid");
					}
					if($amount==0)
					{
						$result->errorMessage = 'ไม่มียอดที่ต้องชำระ';
						$canPay = false;
						//throw new BillingException("You don't have a bill to pay");
					}
					
					
					if ($canPay)
					{
						DBConnection::saveTransaction($this->accountNumber, ($account['accBalance']-$amount));
						$this->clearCharge($this->accountNumber, $TYPE);
						$account = ServiceAuthentication::accountAuthenticationProvider($this->accountNumber); 
						
						$result->accountNumber = $account['accNo'];
						$result->accountName = $account['accName'];
						$result->accountBalance = $account['accBalance'];
						
						
						//DBConnection::restore();
					}
					
					
			}catch(AccountInformationException $e) 
            {
                $result->errorMessage = $e->getMessage();
            }
			return $result;
    }
			
	
	 protected function clearCharge(string $accountNumber, int $chargeType)
        {
            return DBConnection::clearCharge($accountNumber, $chargeType);
        }
	
    public function resetDatabase()
    {
        DBConnection::restore();           
    }
}
?>
