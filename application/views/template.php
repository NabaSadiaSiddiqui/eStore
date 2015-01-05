<?php
if(!session_id()) {
    session_start();
}
header("Cache-Control: no-cache, must-revalidate"); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.
?>
<html>
<head>
    <title>eStore</title>
    <link href="<?php echo base_url(); ?>css/global.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/login.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/signup.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/cart.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/admin.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/checkout.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/receipt.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/orders.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/customers.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/product.css" type="text/css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Wellfleet' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>application/scripts/misc.js"></script>
</head>
<body>
    <?php
    $this->load->view('header');
    $this->load->view($main, $secondary);
    ?>
</body>
</html>