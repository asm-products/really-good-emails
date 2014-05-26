<?php

require('../../../wp-blog-header.php');

// Get the id of the page that sent the request
$id = $_GET['set'];

// Make sure all variables exist
$to = get_post_meta($id,'vk_contact_email',true);
if (!isset($to) || ($to == '') ){
	$to = get_option('admin_email');
}

$subject = get_post_meta($id,'vk_contact_subject',true);
if (!isset($subject) || ($subject == '') ){
	$subject = 'Website Contact Form';
}

if(isset($_POST['email'])) {
   $email = $_POST['email'];
} else { $email=''; }

if(isset($_POST['author'])) {
   $author = $_POST['author'];
} else {$author=''; }

if(isset($_POST['url'])) {
   $url = $_POST['url'];
} else {$url=''; }

if(isset($_POST['comment'])) {
   $comment = $_POST['comment'];
} else {$comment=''; }

if(isset($_POST['validator'])) {
   $validator = $_POST['validator'];
} else { $validator='fail'; }


$headers = "From: " . strip_tags($email) . "\r\n";
$headers .= "Reply-To: ". strip_tags($email) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body style="background: #f2f2f2; font-size: 16px; line-height: 22px; padding: 60px;">';
$message .= "<h2 style='color: #222; margin-bottom: 30px;'><strong>" . strip_tags($subject) . "</strong></h2>";
$message .= '<table cellspacing="30" width="400px" style="background: #ffffff; border-bottom:1px solid #ccc;">';
$message .= "<tr><td style='font-size: 14px;'><strong>Name </strong></br>" . strip_tags($author) . "</td></tr>";
$message .= "<tr><td style='font-size: 14px;'><strong>Email </strong></br>" . strip_tags($email) . "</td></tr>";
$message .= "<tr><td style='font-size: 14px;'><strong>Website </strong></br>" . strip_tags($url) . "</td></tr>";
$message .= "<tr><td style='font-size: 14px;'>" . strip_tags($comment) . "</td></tr>";
$message .= "</table><p style='color:#222; font-size: 12px; margin-top: 20px;'>This email was sent from your website.</p>";
$message .= "</body></html>";

// Only send if has information and validator is empty
if($comment!='' && $validator=='') { mail($to, $subject, $message, $headers); } ?>

</body>
</html>