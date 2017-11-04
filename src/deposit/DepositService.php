<?php namespace Operation;
    //require_once "helper/MySQL.php";
    //include dirname(__FILE__).'/../../helper/MySQL.php';
    //require_once(__DIR__.'../../database/MySQL.php');
    //require_once('stub/ServiceAuthenticationStub.php');
    require_once(__DIR__.'../../outputs/Outputs.php');
    require_once(__DIR__.'../../serviceauthentication/serviceauthentication.php');
    require_once(__DIR__.'../../serviceauthentication/DBConnection.php');

    use Database\MySQL;
    use Output\Outputs;
    use ServiceAuthenticationStub;
    use Exception;
    use AccountInformationException;
    use serviceauthentication;
    use DBConnection;

    class DepositService{
        private $accNo;

        // constructors
        function __construct(string $accNo) {
            $this->accNo = $accNo;
        }

        public function deposit($depositAmount): Outputs
        {
            $canDeposit = true;
            $result = new Outputs();

            #บริการฝากเงินเข้าบัญชีโดยต้องตรวจสอบหมายเลขบัญชีและจำนวนเงินฝาก คือ
            # จำนวนเงินฝากต้องเป็นตัวเลขเท่านั้น
            if (!is_numeric($depositAmount))
            {
                $result->errorMessage = 'จำนวนเงินฝากต้องเป็นตัวเลขเท่านั้น';
                $canDeposit = false;
            }
            else
            {
                $depositAmount = (int)$depositAmount;
            }

            # จำนวนเงินฝากต้องมากกว่า 0
            if (($depositAmount <= 0) && $canDeposit)
            {
                $result->errorMessage = 'จำนวนเงินฝากต้องมากกว่า 0 บาท';
                $canDeposit = false;
            }

            # จำนวนเงินฝากต้องไม่เกิน 100,000 บาท
            if (($depositAmount > 100000) && $canDeposit)
            {
                $result->errorMessage = 'จำนวนเงินฝากในแต่ละครั้งต้องไม่เกิน 100,000 บาท';
                $canDeposit = false;
            }

            try
            {
                # หมายเลขบัญชีมีในฐานข้อมูลระบบหรือไม่ผ่านบริการServiceAuthentication + ดึงยอดล่าสุด
                //$serviceAuth = new ServiceAuthenticationStub();
                $serviceAuth = new ServiceAuthentication();
                $seviceAuthData = $serviceAuth->accountAuthenticationProvider($this->accNo);

                /*
                var_dump($seviceAuthData);
                var_dump(count($seviceAuthData));
                var_dump($seviceAuthData['accountNum']== $accountNum);
                */

                if ($canDeposit)
                {
                    # ปรับปรุงยอด
                    $result->accountNumber = $seviceAuthData['accNo'];
                    $result->accountName = $seviceAuthData['accName'];
                    $result->accountBalance = $seviceAuthData['accBalance'] + $depositAmount;

                    # เรียก Method DBConnection::saveTransaction ของพี่ TA
                    DBConnection::saveTransaction($result->accountNumber, $result->accountBalance);
                }
            }
            catch(AccountInformationException $e) 
            {
                $result->errorMessage = $e->getMessage();
            }
            # 6. Return ผลลัพธ์
            return $result;
        }

        
    }

?>
