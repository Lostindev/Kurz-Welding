
     window.onload = function() {
            // Create an instance of the Stripe object with your publishable API key
            var stripe = Stripe('pk_test_51J0Z2pGou0fkx6yr2E3R0YAErGzBubxzQYFkJpwq773XTZyNW1IiWSVXBeMg2s7gw1LfkKLDEmilwkO6BTqvzEE200dZGY9L7v');
            var sSession = "<?php echo $sSession['id']; ?>";
            console.log(sSession);
         
              // Create a new Checkout Session using the server-side endpoint you
              // created in step 3.
      
      
            
              return stripe.redirectToCheckout({ sessionId: sSession })
      
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
  }

    
    

 
