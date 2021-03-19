<?php


header('Content-Type: text/html; charset=utf-8');



error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);


$user = 'admin';
$password = 'KyCKIVFAcmyVmwzji5uO';
$server = 'cockpit.c7yft9tue2sa.us-east-2.rds.amazonaws.com:3306';
$database = 'fspider';

$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
 



$date1 = new DateTime("now", new DateTimeZone('America/Sao_Paulo') );
echo $date1= $date1->format('Y-m-d H:i:s');



// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'vendor/autoload.php';

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$sender = 'suporte.sistemas@qualidoc.com.br';
$senderName = 'Qualibrain';

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
$recipient = 'suporte.sistemas@qualidoc.com.br';

// Replace smtp_username with your Amazon SES SMTP user name.
$usernameSmtp = 'AKIAVPH4STJGQXRMCKVZ';

// Replace smtp_password with your Amazon SES SMTP password.
$passwordSmtp = 'BBYBJMZPPqXgyT4TnKV6MC56KtNjtMqIFmKnVHcDEkxd';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
//$configurationSet = 'ConfigSet';

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$host = 'email-smtp.us-west-2.amazonaws.com';
$port = 587;

// The subject line of the email
$subject = 'ESTOQUE OCC X RMS';

// The plain-text body of the email
$bodyText =  "Qualibrain - Estoque OCC X RMS";





$get_keywords = $pdo -> prepare ("SELECT sku, qty_stock, qty_stock_rms, active FROM Products where qty_stock_rms <> qty_stock");
    $get_keywords -> execute();

$bodyHtml2='';
while ($row = $get_keywords -> fetch(PDO::FETCH_ASSOC)) {
    $bodyHtml2 .='<tr>';
 $bodyHtml2 .='<td>' .$row['sku'].'</td> ';
$bodyHtml2 .= '<td>'.$row['qty_stock'].'</td> ';        
$bodyHtml2 .= '<td>'.$row['qty_stock_rms'].'</td> ';
$bodyHtml2 .= '<td>'.$row['active'].'</td> ';
 $bodyHtml2 .='</tr>';
 $bodyHtml2 .='<br>';
}
$bodyHtml='<b><p>STOCK REPORT QUALIBRAIN-'.$date1.'</p></b><br>';

 $bodyHtml.='<br><table border=1><thead><th>SKU</th><th>ESTOQUE OCC</th><th>ESTOQUE RMS</th><th>ATIVO</th></thead>';
$bodyHtml .= $bodyHtml2;
$bodyHtml .='</table>';
$mail = new PHPMailer(true);

try {
    // Specify the SMTP settings.
    $mail->isSMTP();
    $mail->setFrom($sender);
    $mail->Username   = $usernameSmtp;
    $mail->Password   = $passwordSmtp;
    $mail->Host       = $host;
    $mail->Port       = $port;
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = 'tls';
    $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);

    // Specify the message recipients.
    $mail->addAddress($recipient);
    // You can also add CC, BCC, and additional To recipients here.

    // Specify the content of the message.
    $mail->isHTML(true);
    $mail->Subject    = $subject;
    $mail->Body       = $bodyHtml;
    $mail->AltBody    = $bodyText;
    $mail->Send();
    echo "Email sent!" , PHP_EOL;
} catch (phpmailerException $e) {
    echo "An error occurred. {$e->errorMessage()}", PHP_EOL; //Catch errors from PHPMailer.
} catch (Exception $e) {
    echo "Email not sent. {$mail->ErrorInfo}", PHP_EOL; //Catch errors from Amazon SES.
}

?>
