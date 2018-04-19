<?php

require "cart.php";
require "order.php";
require "user.php";
require "product.php";

//$user = new user("Tempesta","kwankang","จิรัชญา","ยี่โต๊ะ","36/20 ถนนมลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000","tempesta-psyzeoul@Hotmail.com");
//$user = new user;
//$user->login("tempesta","kwankang");
//echo $user->getUsername();
//echo "<br><br>";
//echo $user->getEmail();
//echo $user->getCustomerbyUsername("Tempesta");

////$obj->addItem("Nendoroid Saitama",1400,array("Product_image\Saitama01.jpg","Product_image\Saitama02.jpg"),"Nendoroid",10,"โล้นซ่า");
//$obj->addItem("Nendoroid Midoriya",1690,array("Product_image\Midoriya01.jpg","Product_image\Midoriya02.jpg","Product_image\Midoriya03.jpg"),"Nendoroid",10,"เดกุคุง");
//$obj->addItem("Funko Pop Newt Scamender 10",690,array("Product_image/FunkoNewt01.jpg"),"Funko",10,"นิวท์");
//$obj->selectProduct(34);
//echo $obj->getStock();
//echo "<br><br>";
//echo $obj->setStock(20);
//echo $obj->getStock();

//$obj->getProductFromCategory("Nendoroid");
//$obj = new product;
//print_r($obj->getProductFromCategory("Nendoroid"));
//echo "<br><br>";
//print_r($obj->getAllProduct());

$cart = new cart("Tempesta");
$cart->addItem(34,2);
$cart->addItem(35,3);
$cart->addItem(36,5);
$o = new order();
$o->checkOut($cart);
$cart = new cart("admin");
$cart->addItem(34,4);
$o = new order();
$o->checkOut($cart);



 ?>
