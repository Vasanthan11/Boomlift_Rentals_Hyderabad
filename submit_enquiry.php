<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form fields
    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $email     = htmlspecialchars(trim($_POST['email']));
    $phone     = htmlspecialchars(trim($_POST['phone']));
    $location  = htmlspecialchars(trim($_POST['location']));
    $equipment = htmlspecialchars(trim($_POST['equipment']));

    // Validate required fields
    if (empty($full_name) || empty($phone) || empty($equipment)) {
        echo "<script>alert('Please fill all required fields'); window.history.back();</script>";
        exit;
    }

    // Email details
    $to = "info@boomliftrentalspune.com";  // CHANGE to your admin email
    $subject = "New Lift Rental Enquiry - Website";

    $message = "
    <h2>New Rental Enquiry Received</h2>
    <p><strong>Name:</strong> $full_name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Location:</strong> $location</p>
    <p><strong>Equipment Requested:</strong> $equipment</p>
    <hr>
    <p>Submitted from Website Contact Form.</p>
    ";

    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: Website Enquiry <no-reply@boomliftrentalspune.com>" . "\r\n";

    // Send mail
    if (mail($to, $subject, $message, $headers)) {
        echo "<script>alert('Thank you! Your enquiry has been sent successfully.'); window.location.href='thankyou.html';</script>";
    } else {
        echo "<script>alert('Error sending message. Please try again.'); window.history.back();</script>";
    }

    /* --- OPTIONAL: Save to database --------
    include 'db.php';
    $query = "INSERT INTO enquiries (full_name, email, phone, location, equipment)
              VALUES ('$full_name', '$email', '$phone', '$location', '$equipment')";
    mysqli_query($conn, $query);
    ---------------------------------------- */
} else {
    echo "<script>window.location.href='index.php';</script>";
}
