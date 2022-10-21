<?php
$filename = '2019-Solar-PriMeg-Service-Letter.pdf';
$path = '/usr/www/users/solarsjkyr/upload';
$file      = $path . $filename;
$file_size = filesize($file);
$handle    = fopen($file, "r");
$content   = fread($handle, $file_size);
fclose($handle);

$content = chunk_split(base64_encode($content));
$uid     = md5(uniqid(time()));
$name    = basename($file);

$eol     = PHP_EOL;
$subject = "Mail Out Certificate";
$message = '<h1>Hi i m mashpy</h1>';

$from_name = "mail@example.com";
$from_mail = "mail@example.com";
$replyto   = "mail@example.com";
$mailto    = "archirayan75@gmail.com";
$header    = "From: " . $from_name . " <" . $from_mail . ">\n";
$header .= "Reply-To: " . $replyto . "\n";
$header .= "MIME-Version: 1.0\n";
$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
$emessage = "--" . $uid . "\n";
$emessage .= "Content-type:text/html; charset=iso-8859-1\n";
$emessage .= "Content-Transfer-Encoding: 7bit\n\n";
$emessage .= $message . "\n\n";
$emessage .= "--" . $uid . "\n";
$emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
$emessage .= "Content-Transfer-Encoding: base64\n";
$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
$emessage .= $content . "\n\n";
$emessage .= "--" . $uid . "--";
mail($mailto, $subject, $emessage, $header);
?>