<?php
//Send the email

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

      //Load Composer's autoloader
  include_once(__DIR__.'/phpmailer/src/Exception.php');
  include_once(__DIR__.'/phpmailer/src/PHPMailer.php');
  include_once(__DIR__.'/phpmailer/src/SMTP.php');

  Class Phpmailers {

     public function send_mail($data) {

       $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP

      $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
     );

      $mail->Host = "smtp.gmail.com";  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = "cloudnigesh@gmail.com";                 // SMTP username
      $mail->Password = "openmyaccount";                           // SMTP password
      $mail->SMTPSecure = "tls";                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      $mail->From = "cloudnigesh@gmail.com";
      $mail->FromName = "Nigesh";
      $mail->addAddress("nigesh111@gmail.com", "Nigesh");     // Add a recipient
      // $mail->addAddress("YOUR_EMAIL_ADDRESS", "YOUR_NAME");     // Add a recipient

      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'You recovery password is';
      $mail->Body    = "$data";
      $mail->AltBody = 'Anything you\'d like the mail body to have in it.';


      if(!$mail->send()) {
          echo 'There was an error sending the contact form email. <br>';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      } 

    }    
}
$phpMails = new Phpmailers();

   

    