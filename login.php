<?php include 'inc/header.php'; ?>

<?php
// Check if user is already logged in
if (Session::get("cuslogin") == true) {
    header("Location: order.php");
    exit;  // Always use exit after a redirect
}
?>

<?php
// Handle customer login
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $custLogin = $cmr->customerLogin($_POST);
}
?>

<div class="main">
    <div class="content">
        <!-- Login Panel -->
        <div class="login_panel">
            <?php
            // Display login message if exists
            if (isset($custLogin)) {
                echo $custLogin;
            }
            ?>
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <form action="" method="post">
                <input name="email" placeholder="Email" type="text" required />
                <input name="pass" placeholder="Password" type="password" required />
                <div class="buttons">
                    <div><button class="grey" name="login">Sign In</button></div>
                    <br>
                    <div><a href="verify_email.php"><button class="grey" type="button">Verify Email</button></a></div>
                </div>
            </form>
        </div>

        <?php
        // Handle customer registration
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
            $customerReg = $cmr->customerRegistration($_POST);
        }
        ?>

        <!-- Register Account -->
        <div class="register_account">
            <?php
            // Display registration message if exists
            if (isset($customerReg)) {
                echo $customerReg;
            }
            ?>
            <h3>Register New Account</h3>
            <form action="" method="post">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div><input type="text" name="name" placeholder="Name" required /></div>
                                <div><input type="text" name="city" placeholder="City" required /></div>
                                <div><input type="text" name="zip" placeholder="Zip-Code" required /></div>
                                <div><input type="email" name="email" placeholder="Email" required /></div>
                            </td>
                            <td>
                                <div><input type="text" name="address" placeholder="Address" required /></div>
                                <div><input type="text" name="country" placeholder="Country" required /></div>
                                <div><input type="text" name="phone" placeholder="Phone" required /></div>
                                <div><input type="password" name="pass" placeholder="Password" required /></div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search">
                    <button class="grey" name="register">Create Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
