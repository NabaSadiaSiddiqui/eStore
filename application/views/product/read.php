<h1 class="product read">Product Entry</h1>

<?php
    echo "<p class='product read back'>" . anchor('inventory/index','Back') . "</p>";
?>

<div class="product read">
<?php
    echo "<p class='product read'> ID = " . $product->id . "</p>";
    echo "<p class='product read'> NAME = " . $product->name . "</p>";
    echo "<p class='product read'> Description = " . $product->description . "</p>";
    echo "<p class='product read'> Price = $" . $product->price . "</p>";
    echo "<p class='product read'><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='200px'/></p>";
?>
</div>

