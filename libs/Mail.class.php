<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'Validate.class.php';
require_once 'PHPMailer-master/src/Exception.php';
require_once 'PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/src/SMTP.php';
class Mail{
    private $email;
    public function __construct(){
            $this->email = new PHPMailer(true);
            $this->email-> SMTPDebug = 2;                     // Enable verbose debug output
            $this->email->isSMTP();                                            // Set mailer to use SMTP
            $this->email->Host       = 'smtp.gmail.com';  // Corrected SMTP server
            $this->email->SMTPAuth   = true;
            $this->email->Username   = 'unidsalt@gmail.com';  // Your Gmail address
            $this->email->Password   = 'jefo mfaw cdle mnpd';      // Your password or app-specific password if using 2FA
            $this->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->email->Port       = 587;
            $this->email->Charset    ='UTF-8';       // TCP port to connect to

            $this->email->isHTML = true;

    }
    public function sendMail($arrParam, $option=null){
        $result= true;
        if($option['task']=='sendmail-to-admin'){
            try{
                $this->email->setFrom($arrParam['email'], $arrParam['name']);
                $this->email->addAddress('unidsalt@gmail.com');     // Add a recipient
                $this->email->Subject = $arrParam['title'];
                $this->email->Body    = $arrParam['message'];
                $this->email->send();
                echo 'Message has been sent';
            }catch(Exception $e){
                $result= false;
            }
}
if($option['task']=='sendmail-to-user'){
try{
    $this->email->setFrom('unidsalt@gmail.com', 'UyenTun');
    $this->email->addAddress($arrParam['email']);     // Add a recipient
    $this->email->Subject = $arrParam['Thong bao tu UyenTun'];
    $this->email->Body    = 'Xin chao'.$arrParam['name'].'Toi da nhan duoc mail cua ban';
    $this->email->send();
}catch(Exception $e){
    $result= false;
}
}
return $result;
}
}