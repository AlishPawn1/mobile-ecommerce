<?php

include 'lib/Database.php';
$db = new Database();

// Retrieve verification code from URL parameters
$verification_code = $_GET['code'];

// Ensure the code is sanitized before using it in the query
$verification_code = mysqli_real_escape_string($db->link, $verification_code);

// Verify the code against the database
$query = "SELECT * FROM tbl_customer WHERE verification_code = '$verification_code'";
$result = $db->select($query);

if ($result && mysqli_num_rows($result) == 1) {
    // Update user's email verification status
    $update_query = "UPDATE tbl_customer SET is_verified = 1 WHERE verification_code = '$verification_code'";
    $update_result = $db->update($update_query);

    if ($update_result) {
        echo "Your email has been successfully verified.";
    } else {
        echo "There was an issue updating the verification status.";
    }
} else {
    echo "Invalid or expired verification code.";
}
?>
