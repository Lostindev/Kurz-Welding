<?php
    
        $ciSession = \Config\Services::session();

        if(isset($_SESSION['varPrice'])) {
          $sum = array_sum($_SESSION['varPrice']);
          $stripeCharge = $sum.'00';
        };

        \Stripe\Stripe::setApiKey('sk_test_hI7hDHpEKvi0AxBTs76xQIFg');
        

        
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
        [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                'name' => 'Test 6/9',
                ],
                'unit_amount' => $stripeCharge,
            ],
            'quantity' => 1,
            ]
        ],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
        ]);
 ?>


<!-- Stripe Intergration-->
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
            // Create an instance of the Stripe object with your publishable API key
            var stripe = Stripe('pk_test_H0K7qzFR7eOZtiqp0Ul2y6PI');

            var session = "<?php echo $session['id']; ?>";
            console.log(session);
         
              // Create a new Checkout Session using the server-side endpoint you
              // created in step 3.
      
              stripe.redirectToCheckout({ sessionId: session })
      
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
