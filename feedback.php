<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the form data
    if (empty($name) || empty($email) || empty($message)) {
        // Display an error message if any of the fields are empty
        $error_message = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Display an error message if the email address is invalid
        $error_message = 'Please enter a valid email address.';
    } else {
        // Send an email with the feedback message
        $to = 'dsuborno0@gmail.com';
        $subject = 'Feedback from '.$name;
        $headers = 'From: '.$email;
        
        mail($to, $subject, $message, $headers);

        // Display a confirmation message to the user
        $confirmation_message = 'Thank you for your feedback!';
    }
}
?>

<!-- Display the feedback form -->
<form method="post" action="feedback.php">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name">
    <br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email">
    <br>

    <label for="message">Message:</label>
    <textarea name="message" id="message" rows="5"></textarea>
    <br>

    <input type="submit" value="Submit">
</form>

<?php if (isset($error_message)) { ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
<?php } ?>
