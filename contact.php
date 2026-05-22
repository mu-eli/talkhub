<?php
$to          = "eliud@eliud-muwowo.com";
$site_name   = "TalkHub";
$from_domain = "eliud-muwowo.com";
$redirect_ok  = "contact.html?status=success";
$redirect_err = "contact.html?status=error";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Method Not Allowed");
}

function clean(string $value): string {
    return htmlspecialchars(strip_tags(trim(str_replace("\0", "", $value))));
}

function valid_email(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

$errors = [];

$first_name = clean($_POST["firstName"] ?? "");
$last_name  = clean($_POST["lastName"]  ?? "");
$email      = clean($_POST["email"]     ?? "");
$message    = clean($_POST["message"]   ?? "");

if ($first_name === "") $errors[] = "First name is required.";
if ($last_name  === "") $errors[] = "Last name is required.";
if ($email === "" || !valid_email($email)) $errors[] = "A valid email is required.";
if ($message    === "") $errors[] = "Message is required.";
if (strlen($message) > 5000) $errors[] = "Message must be under 5,000 characters.";

if (!empty($errors)) {
    header("Location: $redirect_err");
    exit;
}

if (preg_match('/[\r\n]/', $first_name . $last_name . $email)) {
    header("Location: $redirect_err");
    exit;
}

$full_name = "$first_name $last_name";
$subject   = "New contact message from $full_name – $site_name";

$body  = "You have received a new message via the $site_name contact form.\n\n";
$body .= "Name    : $full_name\n";
$body .= "Email   : $email\n\n";
$body .= "Message:\n$message\n\n";
$body .= "Sent on : " . date("Y-m-d H:i:s T") . "\n";
$body .= "IP      : " . ($_SERVER["REMOTE_ADDR"] ?? "unknown") . "\n";

$headers  = "From: $site_name <noreply@$from_domain>\r\n";
$headers .= "Reply-To: $full_name <$email>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$sent = mail($to, $subject, $body, $headers);

if ($sent) {
    $auto_subject = "We received your message – $site_name";
    $auto_body    = "Hi $first_name,\n\n";
    $auto_body   .= "Thank you for contacting $site_name! We'll get back to you as soon as possible.\n\n";
    $auto_body   .= "Your message:\n$message\n\n";
    $auto_body   .= "Best regards,\nThe $site_name Team";

    $auto_headers  = "From: $site_name <noreply@$from_domain>\r\n";
    $auto_headers .= "MIME-Version: 1.0\r\n";
    $auto_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    mail($email, $auto_subject, $auto_body, $auto_headers);

    header("Location: $redirect_ok");
    exit;
}

header("Location: $redirect_err");
exit;