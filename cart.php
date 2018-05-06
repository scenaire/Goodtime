<?php

Class cart {

  private $cart = array();
  private $customer;



  public function __construct($CustID) {
    $cartdb = new cartdb;
    $this->customer = $CustID;
    $this->cart = $cartdb->getItemList($this->customer);
  }

  public function addItem($p_id,$quantity) {
    $cartdb = new cartdb;
    $cartdb->addItem($this->customer,$p_id,$quantity);

    //array_push($this->cart,array('id'=>$p_id,'quantity'=>$quantity));
  }

  public function updateItem($p_id,$quantity) {
    $cartdb = new cartdb;
    $cartdb->updateItem($this->customer,$p_id,$quantity);

    /*for ($i=0;$i<count($this->cart);$i++) {
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
    unset($temp);*/
  }

  public function removeAllItem() {
    $cartdb = new cartdb;
    foreach ($this->cart as $key) {
      $pid = $key['ProductID'];
      echo $cartdb->removeItem($this->customer,$pid);
    }
  }

  public function getCustomerID() {
    return $this->customer;
  }

  public function getCart() {
    return $this->cart;
  }

  public function getCartCount() {
    return count($this->cart);
  }

}

?>
