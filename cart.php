<?php

Class cart {

  private $cart = array();
  private $customer;

  public function __construct($CustID) {
    $this->customer = $CustID;
  }

  public function addItem($p_id,$quantity) {
    array_push($this->cart,array('id'=>$p_id,'quantity'=>$quantity));
  }

  public function removeItem($p_id) {
    for ($i=0;$i<count($this->cart);$i++) {
      if ($this->cart[$i]['id'] === $p_id) {
        $index = $i;
      }
    }
    unset($this->cart[$index]);
    $temp = array();
    foreach ($this->cart as $value) {
      array_push($this->cart,$value);
    }
    $this->cart = $temp;
    unset($temp);
  }

  public function removeAllItem() {
    unset($this->cart);
    $this->cart = array();
  }

  public function getCustomerID() {
    return $this->customer;
  }

  public function getCart() {
    return $this->cart;
  }

}

?>
