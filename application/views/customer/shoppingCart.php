<h1 class="cart">Your shopping cart</h1>

<?php
    if(!isset($_SESSION['products']) or !sizeof($_SESSION['products'])) {
?>
<h2 class="cart">You have not selected any items for purchase</h2>
<h3 class="cart"><?php echo anchor("store/index", "Add items to cart") ?></h3>

<?php
    } else {
        /*
         * keys of $items are product->id
         * values are arrays of product per id
         */
        $items = $_SESSION['products'];
        /*
         * $uProd is the number of unique products selected by the user
         * Each of the value pointed by $_SESSION['products'][$uProd] is an array of items per product
         */
        $uProd = sizeof($items);

        $attr = array(
            "table_open" => "<table class='cart'>"
        );
        $this->table->set_template($attr);

        $keys = array_keys($items);    // keys are the product id of each product
        $total = 0;
        foreach($keys as $id) {
            $products = $items[$id];    // an array of products with product id == id. they are all identical!
            $quantity = sizeof($products);  // number of items selected of that product
            $product = $products[0];    // first element of the array (all are really the same)
            $total += $product->price * $quantity;

            $photo = "<img src='" . base_url() . "images/product/" . $product->photo_url . "' class='cart'/>";
            $item = "<figure class='cart'>" . $photo . "<figcaption>" . $product->name . "</figcaption></figure>";
            $attr = array(
                "name" => $product->id,
                "value" => $quantity,
                "id" => $product->price,
                "class" => "prodInCart",
                "type" => "number",
                "min" => 0,
                "max" => 100000000000000000000000000000000000,
                "form" => 'submitOrdersForm'
            );
            $meta = "<span>Price: $" . $product->price . "</span></br><span>Quantity: " . form_input($attr) . "</span><br/>" . anchor("admin/pDelete/$product->id", 'Remove', "onClick='return confirm(\"Do you really want to remove this item from your cart?\");'");
            $this->table->add_row($item, $meta);
        }
        echo $this->table->generate();
        $this->table->clear();  // clear table heading and row data to generate more tables in the future

        echo "<p class='cart total'>Total = $<span id='total'>" . $total ."</span></p>";
        $attr = array(
            "id" => "submitOrdersForm",
            "class" => "cart");
        echo form_open_multipart("admin/goToCheckout", $attr);
        $attr = array(
            "name" => "submit",
            "value" => "Proceed to checkout",
            "type" => "submit",
            "class" => "cart submitOrders",
        );
        echo form_submit($attr);
        echo form_close();
    }
?>