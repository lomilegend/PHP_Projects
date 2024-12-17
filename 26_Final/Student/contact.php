<?php
define('TITLE', "Contact | The Waakye's Spot");
include('includes/header.php');
?>

<div id="contact">
    <h1>Get in touch with us!</h1>

    <?php
    // Check for Header Injections
    function has_header_injection($str) {
        return preg_match("/[\r\n]/", $str);
    }

    if (isset($_POST['contact_submit'])) {

        // Assign and sanitize form data
        $name  = trim($_POST['name']);
        $email = trim($_POST['email']);
        $msg   = $_POST['message']; // No trim needed for multiline input

        // Check for header injections and email format
        if (has_header_injection($name) || has_header_injection($email)) {
            die(); // Stop the script if header injection is detected
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<h4 class="error">Invalid email address.</h4>';
            exit;
        }

        if (!$name || !$email || !$msg) {
            echo '<h4 class="error">All fields required.</h4><a href="contact.php" class="button block">Go back and try again</a>';
            exit;
        }

        // Construct email
        $to      = "kingmick498@gmail.com";
        $subject = "$name sent a message via your contact form";

        $message = ""; // Initialize message
        $message .= "Name: $name\r\n";
        $message .= "Email: $email\r\n\r\n";
        $message .= "Message:\r\n$msg";

        if (isset($_POST['subscribe']) && $_POST['subscribe'] == 'Subscribe') {
            $message .= "\r\n\r\nPlease add $email to the mailing list.\r\n";
        }

        $message = wordwrap($message, 72);

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "X-Priority: 1\r\n";
        $headers .= "X-MSMail-Priority: High\r\n\r\n";

        // Send the email and check if successful
        if (mail($to, $subject, $message, $headers)) {
            echo '<h5>Thanks for contacting The Waakye\'s Spot!</h5>';
            echo '<p>Please allow 24 hours for a response.</p>';
            echo '<p><a href="/final" class="button block">&laquo; Go to Home Page</a></p>';
        } else {
            echo '<h4 class="error">Sorry, something went wrong. Please try again later.</h4>';
        }

    } else {
    ?>

        <form method="post" action="contact.php" id="contact-form">
            <label for="name">Your name</label>
            <input type="text" id="name" name="name">

            <label for="email">Your email</label>
            <input type="email" id="email" name="email">

            <label for="message">and your message</label>
            <textarea id="message" name="message"></textarea>

            <input type="checkbox" id="subscribe" value="Subscribe" name="subscribe">
            <label for="subscribe">Subscribe to newsletter</label>

            <input type="submit" class="button next" name="contact_submit" value="Send Message">
        </form>

    <?php
    }
    ?>

</div><!-- contact -->

<?php include('includes/footer.php'); ?>
