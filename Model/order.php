<?php

Class order {

  private $cart,$trxID,$customer;

  public function newOrder(cart $cart) {
    require_once('orderdb.php');
    $this->cart = $cart;
    $this->customer = $cart->getCustomerID();
    $orderdb = new orderdb;
    $orderdb->newOrder($this->cart);
  }

  public function getOrderbyTrxID($trxid) {
    $orderdb = new orderdb;
    $orderArr = $orderdb->getOrderbyTrxID($trxID);
  }

  public function getOrderbyUsername() {
    $orderdb = new orderdb;
    $orderArr = $orderdb->getOrderbyUsername($customer);
  }


}

 ?>
