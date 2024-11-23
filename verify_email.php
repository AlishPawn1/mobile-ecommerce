<?php
include 'inc/header.php';
$db = new Database();

if (isset($_POST['verify'])) {
    $user_email = mysqli_real_escape_string($db->link, $_POST['email']);
    $verification_code = mysqli_real_escape_string($db->link, $_POST['verification_code']);

    // Verify the code against the database
    $query = "SELECT * FROM tbl_customer WHERE email = '$user_email' AND verification_code = '$verification_code'";
    $result = $db->select($query);

    if ($result && $result->num_rows == 1) {
        // Update user's email verification status
        $update_query = "UPDATE tbl_customer SET is_verified = 1 WHERE email = '$user_email'";
        $update_result = $db->update($update_query);

        if ($update_result) {
            echo "<script>alert('Your email has been successfully verified.');</script>";
            echo "<script>window.open('login.php', '_self')</script>";
        } else {
            echo "<script>alert('Failed to update verification status. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Invalid verification code. Please try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="loginstyle.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    padding: 20px;
}

h4.heading {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    color: #555;
}

.form-input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 5px;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

button.btn {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button.btn:hover {
    background-color: #0056b3;
}

a.btn {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    border: 1px solid #007bff;
    border-radius: 5px;
    color: #007bff;
    margin-top: 10px;
}

a.btn:hover {
    background-color: #007bff;
    color: white;
}

    </style>
</head>

<body>
    <section class="single-banner bg-light-white margin-top-header">
        <div class="container">
            <div class="content">
                <h1 class="heading">My Account</h1>
                <div class="breadcrumb m-0">
                    <a href="../index.php">Home</a>
                    <span>/</span>
                    <span>My Account</span>
                </div>
            </div>
        </div>
    </section>

    <section class="login-user padding-top-section">
        <div class="container">
            <h4 class="heading">Verify Your Email</h4>
            <form action="verify_email.php" method="post">
                <div class="row pb-5">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text/email" placeholder="Email" name="email" class="form-input" required>
                        </div>
                        <div class="input form-group">
                            <label class="textlabel" for="verification_code">Verification Code</label>
                            <input type="text" class="form-input" placeholder="Code" id="verification_code" name="verification_code"
                                autocomplete="off" required />
                        </div>
                        <div class="form-row d-flex gap-2 align-items-center">
                            <button type="submit" class="btn white-btn checkout-btn" name="verify">Verify</button>
                            <br>
                            <a href="login.php" class="btn read-more checkout-btn">Login</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <?php include 'inc/footer.php';?>