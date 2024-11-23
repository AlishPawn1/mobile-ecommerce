<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/Database.php');
include_once($filepath . '/../helpers/Formate.php');

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Customer
{
	private $db;
	private $fm;

	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

	// Customer Registration
	public function customerRegistration($data)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));

		if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone) || empty($email) || empty($pass)) {
			return "<span class='error'>Fields must not be empty!</span>";
		}

		$mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
		$mailchk = $this->db->select($mailquery);
		if ($mailchk) {
			return "<span class='error'>Email already exists!</span>";
		}

		$verification_code = rand(100000, 999999);

		$query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass, verification_code, is_verified) 
              VALUES('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$pass', '$verification_code', 0)";
		$inserted_row = $this->db->insert($query);

		if ($inserted_row) {
			// Check if email was sent successfully
			if ($this->sendVerificationEmail($email, $name, $verification_code)) {
				// Return JavaScript for alert and redirection
				echo "<script>
                    alert('Registration successful. Please check your email to verify your account.');
                    window.location.href = 'verify_email.php'; // Use location.href for redirection
                  </script>";
				exit();  // Ensure no further processing occurs after the alert and redirection
			} else {
				return "<span class='error'>Failed to send verification email. Please try again later.</span>";
			}
		} else {
			return "<span class='error'>Customer data not inserted.</span>";
		}
	}

	// Send Verification Email
	private function sendVerificationEmail($email, $name, $verification_code)
	{
		$mail = new PHPMailer();
		try {
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'alishpawn00@gmail.com'; // Replace with your email
			$mail->Password = 'lupfmoliqmhqwumu';    // Replace with your app password
			$mail->SMTPSecure = 'tls';
			$mail->Port = 587;

			$mail->setFrom('alishpawn00@gmail.com', 'Mobile Shop'); // Replace with your email
			$mail->addAddress($email, $name);

			$mail->Subject = 'Verify Your Email Address';
			$mail->isHTML(true);
			$mail->Body = "Dear $name,<br><br>
                           Thank you for registering. Please use the following verification code to verify your email:<br>
                           <strong>$verification_code</strong><br><br>
                           Alternatively, click <a href='http://localhost/mobile-ecommerce/verify_email_click.php?code=$verification_code'>here</a> to verify your account.<br><br>
                           Regards,<br>Mobile Team";

			return $mail->send();
		} catch (Exception $e) {
			return false;
		}
	}

	// Customer Login
	public function customerLogin($data)
	{
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$pass = mysqli_real_escape_string($this->db->link, md5($data['pass']));

		if (empty($email) || empty($pass)) {
			return "<span class='error'>Fields must not be empty!</span>";
		}

		$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass'";
		$result = $this->db->select($query);

		if ($result) {
			$value = $result->fetch_assoc();
			if ($value['is_verified'] == 1) {
				Session::set("cuslogin", true);
				Session::set("cmrId", $value['id']);
				Session::set("cmrName", $value['name']);
				header("Location: cart.php");
			} else {
				return "<span class='error'>Please verify your email before logging in.</span>";
			}
		} else {
			return "<span class='error'>Email or Password not matched!</span>";
		}
	}

	// Get Customer Data
	public function getCustomerData($id)
	{
		$query = "SELECT * FROM tbl_customer WHERE id = '$id'";
		return $this->db->select($query);
	}

	// Update Customer Data
	public function customerUpdate($data, $cmrId)
	{
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$country = mysqli_real_escape_string($this->db->link, $data['country']);
		$zip = mysqli_real_escape_string($this->db->link, $data['zip']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);

		if (empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone) || empty($email)) {
			return "<span class='error'>Fields must not be empty!</span>";
		}

		$query = "UPDATE tbl_customer
                  SET
                  name = '$name',
                  address = '$address',
                  city = '$city',
                  country = '$country',
                  zip = '$zip',
                  phone = '$phone',
                  email = '$email'
                  WHERE id = '$cmrId'";

		$updated_row = $this->db->update($query);
		if ($updated_row) {
			return "<span class='success'>Customer Data Updated Successfully.</span>";
		} else {
			return "<span class='error'>Customer Data Not Updated!</span>";
		}
	}
}
?>