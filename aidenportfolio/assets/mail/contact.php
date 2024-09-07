<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect post data from the form
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // Specify your email address
    $to = 'aidenkiettran@gmail.com'; // Change this to your email address

    // Set the email subject.
    $email_subject = "New contact from $name: $subject";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Phone: $phone\n";
    $email_content .= "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if(mail($to, $email_subject, $email_content, $email_headers)) {
        echo "Thank you for your message. It has been sent.";
    } else {
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
