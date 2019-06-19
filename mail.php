<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$mail_sent = mail("palvaibhav89@gmail.com","My subject",$msg);
echo $mail_sent ? "Mail sent" : "Mail failed";
?>