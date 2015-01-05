<h1 class="orders read">Order Details</h1>

<?php
echo "<p class='orders read back'>" . anchor('orders/index','Back') . "</p>";
?>

<div class="orders read">
<?php
echo "<p class='orders read'> Customer ID = " . $order_detail->get_customer_id() . "</p>";
echo "<p class='orders read'> Order date = " . $order_detail->get_order_date() . "</p>";
echo "<p class='orders read'> Order time = " . $order_detail->get_order_time() . "</p>";
echo "<p class='orders read'> Total = $" . $order_detail->get_total() . "</p>";
echo "<p class='orders read'> Credit card number = " . $order_detail->get_creditcard_number() . "</p>";
echo "<p class='orders read'> Credit card expiration date = " . $order_detail->get_creditcard_month() . "/" . $order_detail->get_creditcard_year() . "</p>";
?>
</div>