<?php

Class order {

  private $trxID,$customer,$date,$status,$netprice,$price,$payment,$paymentdate,$promotion;
  private $product = array();

  public function newOrder(cart $cart) {
    $orderdb = new orderdb;
    echo $orderdb->newOrder($cart);
    $this->trxID = $orderdb->findLasttrx();
    $this->getOrderbyTrxID($this->trxID);
  }

  public function getOrderbyTrxID($trxid) {
    $orderdb = new orderdb;
    $temp = $orderdb->getOrderbyTrxID($trxid);
    $this->trxID = $trxid;
    $this->customer = $temp['username'];
    $this->date = $temp['OrderDate'];
    $this->status = $temp['Status'];
    $this->price = $temp['TotalPrice'];
    $this->netprice = $temp['TotalNetPrice'];
    if (!empty($temp['Payment'])) {
      $this->payment = $temp['Payment'];
    }
    if (!empty($temp['PaymentDate'])) {
      $this->paymentdate = $temp['PaymentDate'];
    }
    if (!empty($temp['PromotionID'])) {
      $this->promotion = $temp['PromotionID'];
    }
    $this->product = $orderdb->getProductbyTrxID($trxid);
    return $temp;
  }

  public function getOrderbyUsername($customer) {
    $orderdb = new orderdb;
    return $orderdb->getOrderbyUsername($customer);
  }

  public function setPaymentMethod($payment) {
    $orderdb = new orderdb;
    $this->payment = $payment;
    $orderdb->setPaymentMethod($this->trxID,$payment);
  }

  public function updatePaymentStatus(){
    $orderdb = new orderdb;
    $this->status = true;
    $orderdb->updatePaymentStatus($this->trxID);
  }

  public function getPayment(){
    return $this->payment;
  }

  public function getCustomer(){
    return $this->customer;
  }

  public function getTrxID() {
    return $this->trxID;
  }

  public function getDate() {
    return $this->date;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getProduct() {
    return $this->product;
  }

  public function getNetPrice() {
    return $this->netprice;
  }

  public function getPrice() {
    return $this->price;
  }

  public function getPromotion() {
    return $this->promotion;
  }




}

 ?>
