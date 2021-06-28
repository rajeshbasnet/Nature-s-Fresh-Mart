<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Ensures optimal rendering on mobile devices. -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" /> <!-- Optimal Internet Explorer compatibility -->
    <title>paypal</title>
</head>
<body>
  <!--TODO : cart bata tannu parcha-->
  <?php
    $cartTotal = $_SESSION['cartTotal'];
    $cartID = $_SESSION['cartID'];
    $collectionID = $_SESSION['collectionID'];
  ?>

    <div id="paypal-button-container"></div>

    <script
        src="https://www.paypal.com/sdk/js?client-id=AWmp5U1QZ3zCa3GpPbxNZ_tfFnbQNp2v1-7Cqhcga82O1fEGRtnqo-p6BhCDFM6WxnX7kqHIgx91aYZi&currency=GBP"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
    </script>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
              // This function sets up the details of the transaction, including the amount and line item details.
              return actions.order.create({
                purchase_units: [{
                  amount: {
                    currency_code: "GBP",
                    //ya amount render garnu parcha session bata
                    value: '<?php echo $total; ?>'
                  }
                }]
              });
            },
            onApprove: function(data, actions) {
              // This function captures the funds from the transaction.
              return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Transaction completed by ' + details.payer.name.given_name);
                location.href='payment_sucess.php?basketID=<?php echo $cartID; ?>&collectionID=<?php echo $collectionID; ?>';
              });
            }
          }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.
    </script>
</body>
</html>
