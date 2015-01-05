<h1 class="admin">All finalized orders</h1>
<?php

    if(sizeof($order_items)) {
        $attr = array(
            "table_open" => "<table class='admin orders'>"
        );
        $this->table->set_template($attr);

        $th = array("Order ID", "Product ID", "Quantity", "");
        $this->table->set_heading($th);
        foreach ($order_items as $order_item) {
            $order_id = $order_item->get_order_id();    // id of the order
            $item_id = $order_item->id; // id of order_item
            $view = anchor("orders/read/$order_id",'View');
            $delete = anchor("orders/delete/$item_id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'");
            $action = "<span>" . $view . "</br>" . $delete . "</span>";
            $this->table->add_row($order_id, $order_item->get_product_id(), $order_item->get_quantity(), $action);
        }
        echo $this->table->generate();
        $this->table->clear();  // clear table heading and row data to generate more tables in the future
    } else {
?>
<h2 class="admin orders">There are currently no customer purchases. Check back later.</h2>
<?php
    }
?>