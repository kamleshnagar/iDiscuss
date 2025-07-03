
<?php ob_start(); ?>
<?php
$title = "Contact-us";
include('./partials/_dbconnect.php');
include('./partials/_header.php');

$showAlert = false;
$showError = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $subject = htmlspecialchars(trim($_POST['subject']));
        $message = htmlspecialchars(trim($_POST['message']));
        $user_id = $_SESSION['sno'];

        if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
            $sql = "INSERT INTO contact_messages (user_id, name, email, subject, message, date)
                    VALUES ('$user_id', '$name', '$email', '$subject', '$message', NOW())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: " . $_SERVER['PHP_SELF'] . "?submitted=true");
                exit;
            } else {
                $showError = "Something went wrong. Please try again.";
            }
        } else {
            $showError = "All fields are required.";
        }
    } else {
        $showError = "Please login to send a message.";
    }
}
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Contact Us</h1>

    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success">✅ Message sent successfully!</div>';
    }
    if ($showError) {
        echo '<div class="alert alert-danger">❌ ' . $showError . '</div>';
    }
    ?>

    <div class="row">
        <!-- Contact Form -->
        <div class="col-md-6">
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message" required></textarea>
                </div>

                <button type="submit" class="btn btn-success">Send Message</button>
            </form>
        </div>

        <!-- Optional Google Map -->
        <div class="col-md-6 mt-4 mt-md-0">
            <h5 class="mb-3">Our Location</h5>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!..."
                width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>
</div>

<?php include('_footer.php'); ?>


<?php ob_end_flush(); ?>