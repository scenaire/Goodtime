<?php

class shipping
{

  private $trxID, $address, $status, $posttrack, $name;

  public function __construct($trxID) {
    include "db.php";
    $this->trxID = $trxID;
    $orderdb = new orderdb;
    if (!empty($orderdb->getShipping($trxID))) {
      $temp = $orderdb->getShipping($trxID);
      if (!empty($temp['Posttrack'])) {
        $this->posttrack = $temp['Posttrack'];
      }
      if (!empty($temp['Address'])) {
        $this->address = $temp['Address'];
      }
      if (!empty($temp['Name'])) {
        $this->name = $temp['Name'];
      }
      if (!empty($temp['ShippingStatus'])) {
        $this->status = $temp['ShippingStatus'];
      }
    }
  }

  public function addNewShipping($name,$address) {
    include "db.php";
    $orderdb = new orderdb;
    $this->address = $address;
    $this->status = false;
    $this->name = $name;
    $orderdb->addNewShipping($this->trxID,$name,$address);
  }

  public function updateShippingStatus($posttrack) {
    include "db.php";
    $orderdb = new orderdb;
    $this->status = true;
    $this->posttrack = $posttrack;
    $orderdb->updateShippingStatus($this->trxID,$posttrack);
  }

  public function getTrxID() {
    return $this->trxID;
  }

  public function getAddress() {
    return $this->address;
  }

  public function getPosttrack() {
    return $this->posttrack;
  }

  public function getStatus() {
    return $this->status;
  }

  public function getName() {
    return $this->name;
  }




}




 ?>
