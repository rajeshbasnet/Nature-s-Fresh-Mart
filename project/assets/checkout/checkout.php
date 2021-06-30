<?php

session_start();
include_once '../../connection/connect.php';
$connection = getConnection();

include_once '../../includes/html-skeleton/skeleton.php';
include_once '../../includes/cdn-links/fontawesome-cdn.php';
include_once '../../includes/cdn-links/bootstrap-cdn.php';


if(isset($_SESSION['user'])) {
    include_once '../trader-types/functions.php';

    $user_id = $_SESSION['user'];
    $customer_id = get_user_type_id($user_id, $connection, "CUSTOMERS");
    $basket_id = get_basket_id_from_baskets($customer_id, $connection);
    $total_sum = fetch_total_sum_from_baskets($basket_id, $connection);
?>
<link rel="stylesheet" href="checkout.css">

<div class="custom-container d-flex align-items-center justify-content-center">
    <div class="payment-container">
        <h3 class="font-rale mb-5">Choose a collection slot suitable for you.</h3>
          <?php
              if(isset($_POST['select_slot'])){
                echo "<p style='border-width:1px; font-size: 1.1rem;'  class='text-success border border-success mt-4 text-center p-2'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;&nbsp;Your collection slot preferrence has been saved</p>";
                $collection_slot_id = $_POST['collection_slot'];
              }
          ?>
          <form action="" method="POST">
            <label for="collection_slot" class="from-label">I would like my order to be delivered coming :</label>
            <div class="d-flex align-items-center mt-2 mb-4">
              <select name="collection_slot" class="form-control mr-2">
                <?php
                  $collectionID = 110;
                  while ($collectionID < 113) {
                    echo "<option value = '$collectionID'>".get_all_collection_slots($collectionID, $connection)."</option>";
                    $collectionID++;
                  }
                ?>
              </select>
              <button class = "btn coll_btn btn-outline-success ml-2" type="submit" name="select_slot">SAVE</button>
            </div>
          </form>



        <h3 class="font-rale mb-5">Click below button to pay for purchased order.</h3>
        <div id="paypal-button-container"></div>
    </div>
</div>
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
                    value: '<?php echo $total_sum; ?>'
                  }
                }]
              });
            },
            onApprove: function(data, actions) {
              // This function captures the funds from the transaction.
              return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Transaction completed by ' + details.payer.name.given_name);
                location.href='payment_success.php?user_id=<?php echo $user_id; ?>&basket_id=<?php echo $basket_id; ?>&total_sum=<?php echo $total_sum;?>&collection_slot_id=<?php echo $collection_slot_id;?>';
              });
            }
          }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.
    </script>

<?php }else {
    header('Location: /website/project/assets/form/signin/signin.php?message=login');
}
