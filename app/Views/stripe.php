<?php

$ciSession = \Config\Services::session();

if (isset($_SESSION['varPrice'])) {
  $sum = array_sum($_SESSION['varPrice']);
  $stripeCharge = $sum . '00';
};

 \Stripe\Stripe::setApiKey('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');
//\Stripe\Stripe::setApiKey('sk_test_51J0Z2pGou0fkx6yrG69qBHLG7NeP7Sa0wTBZrosjFvX4cSsr7NHAJWk9992PQqNe8tqkXwg4j6y857BOZesTGPEy00uhyVVe2i');

$session = \Stripe\Checkout\Session::create(
  [
    'payment_method_types' => ['card'],
    'line_items' => [
      [
        'price_data' => [
          'currency' => 'usd',
          'product_data' => [
            'name' => 'Kurz Metal Art Order',
          ],
          'unit_amount' => $stripeCharge,
        ],
        'quantity' => 1,
      ]
    ],
    'mode' => 'payment',
    'success_url' => base_url().'/shop/order_success',
    'cancel_url' => 'http://kurzmetalart.com/shop/order-cancel',
  ]

);



?>


<!-- Stripe Intergration-->
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  // Create an instance of the Stripe object with your publishable API key
  // var stripe = Stripe('pk_live_51J0Z2pGou0fkx6yr4XiCqwHWrIwOPbFurDBK9hvr6pDVSQ4RybphjDWJ9NRrmEEktPGUEB7jElM83Ut3lXkD6gQ7004r31BPPI');
  var stripe = Stripe('pk_live_51J0Z2pGou0fkx6yr4XiCqwHWrIwOPbFurDBK9hvr6pDVSQ4RybphjDWJ9NRrmEEktPGUEB7jElM83Ut3lXkD6gQ7004r31BPPI');

  var session = "<?php echo $session['id']; ?>";
  console.log(session);

  // Create a new Checkout Session using the server-side endpoint you
  // created in step 3.

  stripe.redirectToCheckout({
      sessionId: session
    })

    .then(function(result) {
      // If `redirectToCheckout` fails due to a browser or network
      // error, you should display the localized error message to your
      // customer using `error.message`.
      if (result.error) {
        alert(result.error.message);
      }
    })
    .catch(function(error) {
      console.error('Error:', error);
    });
</script>