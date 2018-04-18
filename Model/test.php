<?php

require "cart.php";
require "order.php";

//$user = new customer;
//$user->register("Tempesta","kwankang","36/20 ถนนมลิวรรณ ตำบล กุดป่อง","อำเภอ เมือง จังหวัด เลย 42000","tempesta-psyzeoul@Hotmail.com","จิรัชญา","ยี่โต๊ะ");
//echo $user->getCustomerbyUsername("Tempesta");

//$obj = new action;
//$obj->addProduct("Nendoroid Saitama",1400,array("Product_image\Saitama01.jpg","Product_image\Saitama02.jpg"),"Nendoroid",10,"โล้นซ่า");
//$obj->addProduct("Nendoroid Midoriya",1690,array("Product_image\Midoriya01.jpg","Product_image\Midoriya02.jpg","Product_image\Midoriya03.jpg"),"Nendoroid",10,"เดกุคุง");
//$obj->addProduct("Funko Pop Newt Scamender 10",690,array("Product_image/FunkoNewt01.jpg"),"Funko",10,"นิวท์");
//$obj->getProductFromCategory("Nendoroid");
//$obj = new product;
//print_r($obj->getProductFromCategory("Nendoroid"));
//echo "<br><br>";
//print_r($obj->getAllProduct());

$cart = new cart(1);
$cart->addItem(20,2);
$cart->addItem(30,4);
$o = new order();
$o->checkOut($cart);



 ?>
