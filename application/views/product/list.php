<?php
    if(isset($_SESSION) and isset($_SESSION['name']) and $_SESSION['name'] == 'admin') {
        $heading = 'Inventory';
        $admin = TRUE;
    } else {
        $heading = "In store now";
        $admin = FALSE;
    }
?>
<h1 class="admin"><?=$heading?></h1>
<?php
    if($admin) {
        echo "<p class='admin products'>" . anchor('inventory/newForm', 'Add New'). "</p>";

        if(sizeof($products)) {
            $attr = array(
                "table_open" => "<table class='admin products'>"
            );
            $this->table->set_template($attr);

            $th = array("Name", "Description", "Price", "Photo", "");
            $this->table->set_heading($th);
            foreach ($products as $product) {
                $photo = "<img src='" . base_url() . "images/product/" . $product->photo_url . "'width=100%;/>";
                $delete = anchor("inventory/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'");
                $edit = anchor("inventory/editForm/$product->id",'Edit');
                $view = anchor("inventory/read/$product->id",'View');
                $action = "<span>" . $delete . "</br>" . $edit . "</br>" . $view . "</span>";
                $this->table->add_row($product->name, $product->description, "$$product->price", $photo, $action);
            }

            echo $this->table->generate();
            $this->table->clear();  // clear table heading and row data to generate more tables in the future
        } else {
?>

<h2 class="products">Inventory is empty. Restock.</h2>

<?php
        }
    } else {
        if(sizeof($products)) {
            $attr = array(
                "table_open" => "<table class='products'>"
            );
            $this->table->set_template($attr);

            foreach ($products as $product) {
                $photo = "<img src='" . base_url() . "images/product/" . $product->photo_url . "' class='products' width='300px'/>";
                $attr = array(
                    "title" => $product->description
                );
                $photoLink = anchor("admin/pDetails/$product->id", $photo, $attr);
                $item = "<figure><figcaption style='font-size:25px; font-weight:bold; text-align:center;'>" . $product->name . "</figcaption>" . $photoLink . "<figcaption style='font-size:23px; margin-top: 2%; text-align:center; font-weight: bold;'>Price: $" . $product->price . "</figcaption></figure>";
                $this->table->add_row($item);
            }
            echo $this->table->generate();
            $this->table->clear();  // clear table heading and row data to generate more tables in the future
        } else {
?>
<h2 class="products">Store is currently out of stock. Please come back later.</h2>
<?php
        }
    }

?>