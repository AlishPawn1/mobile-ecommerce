<?php

include_once 'lib/Database.php';
require_once('vendor/autoload.php');
$db = new Database();

// Set up your Stripe secret key
\Stripe\Stripe::setApiKey('sk_test_51PhZNfRqbIai3bkj3wSIoLzsLBorzOA2ICDy6hckrO936PKz26Lsu4hEqudTwlFwU6c0Tz1do7ZN7kd5jEg8pi4M00Y0Lap67P');

// Get customer_id dynamically (for example, from session or request)
$customer_id = $_GET['id'];  // Replace with dynamic customer ID (session or request-based)

// Fetch all items in the customer's cart from the database
$query = "SELECT price, quantity FROM tbl_cart WHERE customer_id = $customer_id";
$result = $db->select($query);

// Check if the query returned any results
if (!$result || empty($result)) {
    die("No items found in the cart.");
}

// Initialize total amount
$total_amount = 0;

// Calculate the total price of all items in the cart
foreach ($result as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

// Convert total amount to cents (Stripe expects the smallest currency unit, e.g., cents for USD)
$amount_in_cents = $total_amount * 100;  // Assuming price is in the main currency unit

// Ensure that the amount is greater than Stripe's minimum charge
if ($amount_in_cents < 50) {  // Example minimum amount (this depends on your Stripe account's currency)
    die("The total amount is too small to process the payment.");
}

try {
    // Create the PaymentIntent
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => $amount_in_cents, // Amount in the smallest unit
        'currency' => 'usd', // Use the appropriate currency (change 'usd' to your currency)
    ]);

    // Retrieve the client secret to use in the frontend for confirming the payment
    $clientSecret = $paymentIntent->client_secret;

    // Print client secret for use in the frontend
    echo "PaymentIntent created successfully! Client Secret: " . $clientSecret;

} catch (\Stripe\Exception\ApiErrorException $e) {
    echo "Error creating PaymentIntent: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: white;
        }
        #submit {
            margin-top: 20px;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Stripe Payment</h2>
        <form id="payment-form">
            <div class="form-group">
                <label for="card-element">Credit or debit card</label>
                <div id="card-element">
                    <!-- Stripe Elements will create input elements here -->
                </div>
            </div>
            <div id="error-message" class="error-message" role="alert"></div>
            <button id="submit" class="btn btn-primary btn-block">Pay</button>
        </form>
    </div>

    <script>
        // Initialize Stripe
        var stripe = Stripe('pk_test_51PhZNfRqbIai3bkjE0q5aoFLz1EqrFtsea3VmYFT4DUnvEcxGOd6u2MiGzxxxLRXbNDVj27u3E0nPxT8nFj1LhCj00SDjGNrdO');
        var elements = stripe.elements();

        // Style for card input field
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create the card input element
        var cardElement = elements.create('card', { style: style });
        cardElement.mount('#card-element');

        // Handle the form submission
        var form = document.getElementById('payment-form');
        var errorMessage = document.getElementById('error-message');

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Confirm the payment using the PaymentIntent client secret
            stripe.confirmCardPayment('<?php echo $clientSecret; ?>', {
                payment_method: {
                    card: cardElement
                }
            }).then(function(result) {
                if (result.error) {
                    // Display error message
                    errorMessage.textContent = result.error.message;
                } else {
                    // Payment succeeded
                    if (result.paymentIntent.status === 'succeeded') {
                        alert("Payment Successful!");
                        // Redirect or handle success
                        window.location.href = 'success.php';
                    }
                }
            });
        });
    </script>
</body>
</html>

