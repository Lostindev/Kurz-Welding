<?php 

require '/var/www/html/public/vendor/init.php';
        
\Stripe\Stripe::setApiKey('sk_test_51J0Z2pGou0fkx6yrG69qBHLG7NeP7Sa0wTBZrosjFvX4cSsr7NHAJWk9992PQqNe8tqkXwg4j6y857BOZesTGPEy00uhyVVe2i');

  header('Content-Type: application/json');
  
  $YOUR_DOMAIN = 'https://3.15.181.4/';
  
  $checkout_session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'usd',
        'unit_amount' => 2000,
        'product_data' => [
          'name' => 'Stubborn Attachments',
          'images' => ["https://i.imgur.com/EHyR2nP.png"],
        ],
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/shop/success',
    'cancel_url' => $YOUR_DOMAIN . '/shop/cancel',
  ]);
  
  echo json_encode(['id' => $checkout_session->id]);

?>