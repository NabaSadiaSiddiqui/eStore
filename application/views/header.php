<header>
    <nav>
        <?php
        $attr = array("class" => "nav");
        echo form_open_multipart('store/processNavBar', $attr);
        $attr = array(
            "name" => "home",
            "value" => "Home",
            "class" => "nav"
        );
        echo form_submit($attr);
        if(!isset($_SESSION['items'])) {
            $num = 0;
        } else {
            $num = $_SESSION['items'];
        }
        $attr = array(
            "name" => "shoppingCart",
            "value" => "My Bag ($num)",
            "class" => "nav"
        );
        echo form_submit($attr);
        //if(!isset($_SESSION['loggingIn'])) {
            if(!isset($_SESSION["name"])) {
                $attr = array(
                    "name" => "login",
                    "value" => "LOG IN",
                    "class" => "nav"
                );
                echo form_submit($attr);
            }else {
                $attr = array(
                    "name" => "logout",
                    "value" => "LOG OUT",
                    "class" => "nav"
                );
                echo form_submit($attr);
                echo "<span id='welcomeMsg'>Welcome, " . $_SESSION['name'] . "</span>";
            }
        //}
        echo form_close();
        ?>
    </nav>
</header>