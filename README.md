# E-Commerce [![Build Status](https://travis-ci.org/Al-Cross/E-Commerce.svg?branch=master)](https://travis-ci.org/Al-Cross/E-Commerce)

This is an open-source flexible e-commerce application with customizable features making it useful for many types of products.

## Installation

### Step 1

> To run this project, you must have a PHP 7 or higher installed.

First, clone this repository and install all Composer dependencies.

```bash
git clone https://github.com/Al-Cross/E-Commerce.git
cd e-commerce && composer install
mv .env.example .env
php artisan key:generate
```

### Step 2
Create a new database and reference its name and username/password within the project's .env file.

### Step 3
Stripe is a suite of payment APIs that powers commerce for online businesses of all sizes.

https://www.stripe.com

After you create a developer account, reference the provided test API keys in your `.env` file.

```bash
STRIPE_KEY=YOUR_KEY_HERE
STRIPE_SECRET=YOUR_KEY_HERE
```

### Step 4

Create a sandbox personal and business accounts on https://developer.paypal.com/home/.

Then, create a testing app on https://developer.paypal.com/home/.

To checkout with PayPal, use the Braintree Sandbox.

https://www.braintreepayments.com/sandbox

After the sandbox account is set up, you can reference the test API keys in your `.env` file.

```bash
BT_ENVIRONMENT=sandbox
BT_MERCHANT_ID=YOUR_KEY_HERE
BT_PUBLIC_KEY=YOUR_KEY_HERE
BT_PRIVATE_KEY=YOUR_KEY_HERE
```

Next, link the test business paypal account to the Braintree sandbox. Get the secret key from the testing app.

### Step 5
Run `php artisan ecommerce:install` to populate the database.

### Step 6
Now you are ready to use the platform at `http://e-commerce.test`. An administrative account has been created for you.

Credentials:
Username: johndoe@example.com     Password: password

 If you want to use a different administrative account, add its email address in `config/e-commerce.php/administrators`.
