<?php
$submit=false;
$name = strip_tags(trim($_POST['name']));
$email = strip_tags(trim($_POST['email']));
$phone = strip_tags(trim($_POST['phone']));
$msg = strip_tags(trim($_POST['msg']));
if($name && strlen($msg)>19&&($phone || $email)) $submit=true;

?>

<script>
var submitted = <?php echo $submit; ?>;
if (submitted == 1){	
	$("#hello").dialog({});
	$("input[type=text], textarea").val("");	
}
</script>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'localhost';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
	    //$mail->Username = 'goletiani_timur';                 // SMTP username
    //$mail->Password = 'T1mur123!';                           // SMTP password
    //$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@konsulgrup.ru', 'konsulgrup');
    $mail->addAddress('hierro.flexible@gmail.com');     // Add a recipient
   // $mail->addAddress('ellen@example.com','Jone Doe');               // Name is optional
   // $mail->addReplyTo('info@example.com', 'Information');
   // $mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->setLanguage('ru', 'PHPMailer-master/language/');
	$mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'ZAYAVKA';
    $mail->Body    = "Имя: ".$name."<br />Почта: ".$email."<br />Телефон: ".$phone."<br />Вопрос: ".$msg;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
if ($submit)    
	$mail->send();

	// echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>
