<?php

// Product.php

class Product {
    public $product_id;
    public $product_name;
    public $unit_price;

    public function __construct($id, $name, $price) {
        $this->product_id = $id;
        $this->product_name = $name;
        $this->unit_price = $price;
    }
}


?>
