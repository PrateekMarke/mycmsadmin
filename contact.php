<?php include "includes/db.php"; ?>
<?php include "includes/header.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'sendmail/src/Exception.php';
require 'sendmail/src/PHPMailer.php';
require 'sendmail/src/SMTP.php';

if(isset($_POST['submit'])){
    // $mail = new PHPMailer(true);

    // $mail->isSMTP();
    // $mail->Host = 'smtp.gmail.com';
    // $mail->SMTPAuth= true;
    // $mail->Username = 'mailserver80085@gmail.com';
    // $mail->Password = 'xmrbusruutfffnqp';
    // $mail->SMTPSecure='ssl';
    // $mail->Port = 465;
    $mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = 'sandbox.smtp.mailtrap.io';
$mail->SMTPAuth = true;
$mail->Port = 2525;
$mail->Username = '7952d7aa36ffb6';
$mail->Password = '62ad193f42abcf';
   
    $senderEmail = $_POST["email"]; // Get the sender's email address
    echo $senderEmail;
    // $mail->AddReplyTo($FromEmail, $FromName);
    $mail->SetFrom($senderEmail);
    $mail->addAddress('mailserver80085@gmail.com');

    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];

    // Add sender's email address in the body of the email
    $mail->Body= "Sender's Email: $senderEmail <br> " . $_POST["body"];

    if($mail->send()) {
        echo "<script>alert('Sent Successfully');
        document.location.href = 'contact.php';</script>";
    } else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>


<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                            <!-- <h6 class="text-center"><?php // echo $message ?></h6>
                             -->
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                            </div>
                            <div class="form-group">
                               <textarea class="form-control" name="body" id="body" cols="50" rows="10"></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>