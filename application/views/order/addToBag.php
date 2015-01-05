<?php
    echo "<p class='customerSel'>" . anchor('inventory/index','Back') . "</p>";

    echo "<p class='customerSel'> NAME = " . $product->name . "</p>";
    echo "<p class='customerSel'> Description = " . $product->description . "</p>";
    echo "<p class='customerSel'> Price = $" . $product->price . "</p>";
    echo "<p class='customerSel'><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='200px'/></p>";

    echo form_open_multipart("admin/pAdd/$product->id");
    echo form_submit("customerSel", "Add to cart");
    echo form_close();
?>