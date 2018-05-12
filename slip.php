<?php

if (!isset($_SESSION)) {
  session_start();
}
require_once('product.php');
require_once('productdb.php');
require_once('order.php');
require_once('orderdb.php');
require_once('user.php');
require_once('userdb.php');
require_once('shipping.php');
require_once('promotiondb.php');

/**
 *
 */
class slip
{

  private $trxID;

  function __construct($trxID)
  {
    $this->trxID = $trxID;

  }

  public function getBody() {
    $one = "<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
  </head>
  <body>

  <h4> ใบเสร็จรับเงินหมายเลขใบสั่งซื้อที่ # $this->trxID </h4>

    <p><span style='font-size: 18pt; color: #ff6600;'>Your<span style='color: #000000;'> Cart</span></span></p>
    <table width='633' height='122'>
      <tbody>
        <tr>
        <th>No.</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th>Total Price</th>
        </tr>";

        $order = new order;
        $order->getOrderbyTrxID($this->trxID);
        $promotion = $order->getPromotion();
        $num = 0;

        $two = "";

        foreach ($order->getProduct() as $key) {
          $product = new product();
          $product->selectProduct($key['ProductID']);
          $pname = $product->getName();
          $pprice = $product->getPrice();
          $qty = $key['Quantity'];
          $ttl = $qty*$pprice;
          $num += 1;

          $temp = "<tr>
          <td>$num</td>
          <td>$pname</td>
          <td>$qty</td>
          <td>$pprice THB</td>
          <td>$ttl THB</td>
          </tr>";

          $two = $two.$temp;
        }

        $two = $two."</tbody></table><br>";

        $total = $order->getPrice();
        $vat = ($total*7)/100;
        $net = $order->getNetPrice();

        if(!empty($promotion)) {
          $promotiondb = new promotiondb;
          $pr = $promotiondb->getPromotionfromID($promotion);
          $type = $pr['PromotionType'];
          $discount = $pr['PromotionDiscount'];
          if ($type == "fix") {
            $pd = $discount;
          } elseif ($type == "percent") {
            $pd = $total * ($discount/100);
          }
        } else {
          $pd = 0;
        }


        $three = "<p><span style='font-size: 10pt;'>Sub-Total : $total THB</span></p>
        <p><span style='font-size: 10pt;'>VAT (7%) : $vat THB</span></p>
        <p><span style='font-size: 10pt;'>Promotion Discount : $pd THB</span></p>
        <p><span style='font-size: 10pt;'>Total : $net THB</span></p><br><br>";

        switch ($order->getPayment()) {
          case "bank": $p = "โอนผ่านธนาคาร"; break;
          case "paypal": $p = "ชำระผ่าน Paypal"; break;
          case "credit": $p = "ชำระผ่านบัตรเครดิต"; break;
        }

        $four = "<p><span style='font-size: 18pt;'><span style='color: #ff6600;'>Payment</span> Method</span></p>
        <p><span style='font-size: 10pt;'>การชำระเงิน : $p</span></p>
        <p><span style='font-size: 10pt;'>สถานะการชำระเงิน : ชำระเงินเรียบร้อยแล้ว</span></p><br><br>";

        $shipping = new shipping($this->trxID);
        $first = $shipping->getName();
        $address = $shipping->getAddress();

        $five = "<p><span style='font-size: 18pt;'><span style='color: #ff6600;'>Your</span> Address </span></p>
        <p><span style='font-size: 10pt;'>ชื่อ : $first </span></p>
        <p><span style='font-size: 10pt;'>ที่อยู่ : $address </span></p><br><br></body></html>";


        return $one.$two.$three.$four.$five;

  }


}


 ?>
