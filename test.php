<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require "cart.php";
require "cartdb.php";
require "order.php";
require "orderdb.php";
require "user.php";
require "userdb.php";
require "product.php";
require "productdb.php";
require "wishlist.php";
require "wishlistdb.php";
require "shipping.php";
require "promotiondb.php";

//$user = new user("Tempesta","kwankang","จิรัชญา","ยี่โต๊ะ","36/20 ถนนมลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000","tempesta-psyzeoul@Hotmail.com");
/*$user = new user;
$aa = $user->register("Tempesta","kwankang","จิรัชญา","ยี่โต๊ะ","36/20 ถนนมลิวรรณ ตำบล กุดป่อง อำเภอ เมือง จังหวัด เลย 42000","tempesta-psyzeoul@Hotmail.com");

if ($aa == false) {
  echo "false";
}
if ($aa == true) {
  echo "true";
}*/
//$user->login("tempesta","kwankang");
//echo $user->getUsername();
//echo "<br><br>";
//echo $user->getEmail();
//echo $user->getCustomerbyUsername("Tempesta");

/**
 *
 */

 /*$order = new order;
 print_r($order->getOrderbyTrxID(8));
 echo "<br><br>".$order->getPayment();*/

 /*$orderdb = new orderdb();
 print_r($orderdb->getAllSuccessPaymentOrder());*/

//$order = new order;
//print_r($order->getOrderbyUsername("scenaire"));

/*$user = new user;
$user->selectUser("yoyo");
$e = $user->getEmail();

 $mail = new PHPMailer;
 $mail->setFrom('tempesta-psyzeoul@hotmail.com', 'Erianecs');
 $mail->addAddress($e, 'Scenaire');
 $mail->Subject  = 'First PHPMailer Message';
 $mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
 if(!$mail->send()) {
   echo 'Message was not sent.';
   echo 'Mailer error: ' . $mail->ErrorInfo;
 } else {
   echo 'Message has been sent.';
 }*/



//$obj = new product;
//$product = new product;
//$product->selectProduct(4);
//$imgall = $product->getImage();
//foreach ($imgall as $img ) {
//  $img = $img['ProductImage'];
//  print_r($img);
//  echo "<br><br>";
//}

//$p = new productdb;
//echo $p->removeItem(23);


//$to = "tempesta-psyzeoul@hotmail.com";
//$subject = "Test 1";
//$txt = "Hello world!";
//$headers = "From: webmaster@example.com";

//mail($to,$subject,$txt,$headers);

/*$wishlist = new wishlist("scenaire");
print_r($wishlist->getWishlist());
echo "<br><br>";
echo $wishlist->getWishlistCount();
echo "<br><br>";

$wishlistdb = new wishlistdb;
print_r($wishlistdb->getItemList("scenaire"));*/


/*$productList = new productdb;
$arr = $productList->getAllProduct();
$arr2 = $productList->custom_shuffle($arr);
foreach ($arr2 as $a) {
  $pname = $a["ProductName"];
  echo $pname."<br>";

  }

echo "<br>after slice<br><br>";

$arr3 = $productList->slice_ar($arr2,0,4);
foreach ($arr3 as $a) {

  $pname = $a["ProductName"];
  echo $pname."<br>";

}*/

//$cart = new cart("scenaire");
//print_r($cart->getCart());
//echo "<br><br>";

//echo $key = array_search(50,array_column($cart->getCart(),'ProductID'));

//if ($key === false) {
//  echo "<br><br>false";
//}


//$cart = new cartdb;
//echo $cart->updateItem("scenaire",22,3);;


/*$product = new product();
$product->selectProduct(11);
$pimg = $product->getImage();
$pimg = $pimg[0];
print_r($pimg);*/


//$obj->selectProduct(34);
//echo $obj->getStock();
//echo "<br><br>";
//echo $obj->setStock(20);
//echo $obj->getStock();

//$p = new productdb;
//print_r($p->getAllCategory());

//$obj->getProductFromCategory("Nendoroid");
//$obj = new product;
//print_r($obj->getProductFromCategory("Nendoroid"));
//echo "<br><br>";
//print_r($obj->getAllProduct());

//$cart = new cart("Tempesta");
//$cart->addItem(34,2);
//$cart->addItem(35,3);
//$cart->addItem(36,5);
//$o = new order();
//$o->newOrder($cart);




 ?>
