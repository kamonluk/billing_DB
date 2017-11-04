<?php
namespace Operation;

class ServiceAuthenticationStub {
	
	private $accountNumber;
	
	public function __construct(string $accountNumber){
        $this->accountNumber = $accountNumber;
    }

         public function acauProvider(): array{ 
			if ($this->accountNumber == '0123444667' ) {   
					$answer = array('AccNo' => '0123444667','AccName'=> 'Kritsada Kancha','AccBalance'=> 2000000,'Message'=> null);

				}else if($this->accountNumber == '4235850021') {
					$answer = array('AccNo' => '4235850021','AccName'=> 'Tony Stark','AccBalance'=> 4000000,'Message'=> null);
			
				}else if($this->accountNumber == '5902150431') {
					$answer = array('AccNo' => '5902150431','AccName'=> 'Bruce Wayne','AccBalance'=> 9555000,'Message'=> null);

				}else if($this->accountNumber == '9835602413' ) {
					$answer = array('AccNo' => '9835602413','AccName'=> 'Martin Flower','AccBalance'=> 400000,'Message'=> null);

				}else if($this->accountNumber == '7840125312' ) {
					$answer = array('AccNo' => '7840125312','AccName'=> 'SpearMan PicSun','AccBalance'=> 50001,'Message'=> null);

				}else if($this->accountNumber == '1924356780' ) {
					$answer = array('AccNo' => '1924356780','AccName'=> 'Johny Walker','AccBalance'=> 890200,'Message'=> null);

				}else if($this->accountNumber == '2476492431' ) {
					$answer = array('AccNo' => '2476492431','AccName'=> 'Jark Sparrow','AccBalance'=> 1000000,'Message'=> null);

				}else if($this->accountNumber == '9178906629' ) {
					$answer = array('AccNo' => '9178906629','AccName'=> 'Clara Oswald','AccBalance'=> 5000,'Message'=> null);

				}else if($this->accountNumber == '3430368497' ) {
					$answer = array('AccNo' => '3430368497','AccName'=> 'River Song','AccBalance'=> 10000,'Message'=> null);

				}else {
					$answer = array('AccNo' => '0000000000','AccName'=> 'xxxxxx','AccBalance'=> 0,'Message'=> 'Account Number not found');
				}
					return $answer;
	}
   
}

?>