<?php

require_once "../classes/product.php";
$productObj = new Product();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $pid = htmlspecialchars(trim($_GET["id"]));
        $productObj->deleteProduct($pid);
        header("Location: /project/product/viewproduct.php");
        exit();
    } else {
        echo "<a href='viewproduct.php'>View Product</a>";
        exit("product not found");
    }
} else {
    header("Location: /project/product/viewproduct.php");
    exit();
}
