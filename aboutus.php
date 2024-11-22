
<?php include 'inc/header.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Mobile Shop</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #0073e6;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
        .about-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        p {
            line-height: 1.6;
            color: #666;
            margin: 0.5rem 0;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 2rem;
        }
        .feature {
            flex: 1 1 45%;
            margin: 1rem;
            padding: 1rem;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .feature img {
            max-width: 100px;
            margin-bottom: 1rem;
        }
        .cta {
            text-align: center;
            margin-top: 2rem;
        }
        .cta a {
            text-decoration: none;
            background: #0073e6;
            color: white;
            padding: 0.8rem 1.2rem;
            border-radius: 4px;
            font-weight: bold;
        }
        .cta a:hover {
            background: #005bb5;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to MobileShop</h1>
    </header>
    <main>
        <div class="about-container">
            <h2>Who We Are</h2>
            <p>At MobileShop, we bring you the latest and greatest in mobile technology. Our mission is to provide high-quality smartphones, accessories, and unbeatable deals, ensuring you stay connected in style.</p>
            <p>With a passion for innovation and customer satisfaction, MobileShop has become a trusted destination for tech enthusiasts. From flagship devices to budget-friendly options, we have something for everyone.</p>

            <h2>Why Choose Us?</h2>
            <div class="features">
                <div class="feature">
                    <img src="images\quality.png" alt="High Quality">
                    <h3>High-Quality Products</h3>
                    <p>We only offer products from trusted brands and manufacturers to ensure quality and reliability.</p>
                </div>
                <div class="feature">
                    <img src="images\best deal.png" alt="Best Deals">
                    <h3>Best Deals</h3>
                    <p>Enjoy unbeatable prices, seasonal discounts, and exclusive offers every day.</p>
                </div>
                <div class="feature">
                    <img src="images\CustomerSupport.jpg" alt="Customer Support">
                    <h3>24/7 Support</h3>
                    <p>Our friendly support team is here to help you every step of the way.</p>
                </div>
                <div class="feature">
                    <img src="images\R.jpeg" alt="Fast Shipping">
                    <h3>Fast Shipping</h3>
                    <p>Get your orders delivered quickly with our efficient shipping service.</p>
                </div>
            </div>
            <div class="cta">
                <p>Discover the perfect mobile device for you at MobileShop today!</p>
                <a href="shop.php">Explore Our Shop</a>
            </div>
        </div>
    </main>
</body>
</html>


<?php include 'inc/footer.php';?>