<?php

Class wishlist {

  private $wishlist = array();
  private $customer;

  public function __construct($uid) {
    $wishlistdb = new wishlistdb;
    $this->customer = $uid;
    $this->wishlist = $wishlistdb->getItemList($this->customer);
  }

  public function addItem($p_id) {
    $wishlistdb = new wishlistdb;
    $wishlistdb->addItem($this->customer,$p_id);
  }

  public function removeItem($p_id) {
    $wishlistdb = new wishlistdb;
    $wishlistdb->removeItem($this->customer,$p_id);
  }

  public function getWishlist() {
    return $this->wishlist;
  }

  public function getCustomer() {
    return $this->customer;
  }

  public function getWishlistCount() {
    return count($this->wishlist);
  }

  public function checkItem($pid) {
    return array_search($pid,array_column($this->wishlist,'ProductID'));
  }




}



 ?>
