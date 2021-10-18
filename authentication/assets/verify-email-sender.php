<?php
session_start();
if (isset($_SESSION['user']['verify_code'])) {
    try {
        $verify_url = $_SERVER['HTTP_HOST'] . '/assets/verify-email-handler?' . $_SESSION['user']['verify_code'];
//        unset($_SESSION['user']['verify_code']); // Delete from session

        $to = $_SESSION['user']['email'];
        $subject = 'Confirmation of registration';
        $message = "Activate your account <br>" . "<a href='" . $verify_url . "'> → Click ← </a>";
        $headers = "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=utf-8\r\n" .
            "From: webmaster@your-site.com\r\n" . "Reply-To: webmaster@your-site.com\r\n";
        $mail_result = mail($to, $subject, $message, iconv('utf-8', 'windows-1251', $headers));
    } catch (Exception $e) {
        echo 'EMAIL VERIFICATION ERROR: (verify-email-sender.php) ' . $e->getMessage();
    }

// Email sending check
    if ($mail_result) {
        header('Location: user?message=mail_send');
        echo 'E-mail was send.';
    } else echo 'Email sending error.';
}
header('Location: /index.php');