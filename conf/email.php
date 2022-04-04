<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


<?php
include "../conf/connect.php";
header("Content-Type: text/html; charset=utf-8");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST["submit"])) {

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


$mail = new PHPMailer(TRUE);                           // Passing `true` enables exceptions
try {
$mail->SMTPDebug = 0;

$mail -> charSet = "utf-8";
$mail->isSMTP(); 
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;                           
$mail->SMTPSecure = "tls";                         

$mail->Username = "vysokypepa@gmail.com";                 // SMTP username
$mail->Password = "FeGrHtJz";                           // SMTP password
$mail->Port = 587;           

$mail->isHTML(true);
$mail->setFrom($email, $name);
$mail->Subject = $subject;
$mail->Body = $message . ' : ' . $email;
$mail->addAddress('vysokypepa@gmail.com');
$mail->send();        //odeslani prvniho mailu


$mail->ClearAllRecipients();   // priprava na druhy mail
$mail->FromName = "vysokypepa@gmail.com";
$mail->Body ='Zpráva byla doručena na helpdesk, v nejblišší době se Vám ozveme.';
$mail->addAddress($email);
$mail->Send(); //odeslani druheho mailu

//vložení zprávy do databaze
    $dotaz = "INSERT INTO zprava VALUES ('','$name','$email','$subject','$message')";

    $proved = mysqli_query($spojeni,$dotaz);
 }
catch (\PHPMailer\PHPMailer\Exception $e) {
    echo 'Zpráva nemohla být odeslána. Chyba: ', $mail->ErrorInfo;
}    ?>


<script>
window.location.href="emailOK.html";
</script>  
<?php
}
else{
echo("Zpráva nebyla odeslána! ");
}
?>