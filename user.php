<?php
class user {

  private $fname,$lname,$address,$email,$username,$password,$letter;

  public function register($username,$password,$fname,$lname,$address,$email,$letter) {
    $userdb = new userdb;
    $this->fname = $fname;
    $this->lname = $lname;
    $this->address = $address;
    $this->email = $email;
    $this->username = $username;
    $this->password = $password;
    $this->letter = $letter;
    return $userdb->register($this);
  }

  public function login($username,$password) {
    $userdb = new userdb;
    if ($userdb->check_login($username,$password)) {
      $temp = $userdb->getCustomer($username,$password);
      $this->fname = $temp['CustFName'];
      $this->lname = $temp['CustLName'];
      $this->address = $temp['CustAddress'];
      $this->email = $temp['CustEmail'];
      $this->letter = $temp['sendpromotion'];
      $this->username = $username;
      $this->password = $password;
      return true;
    } else {
      return false;
    }

  }

  public function selectUser($user) {
    $userdb = new userdb;
    $temp = $userdb->getCustomer($user);
    $this->fname = $temp['CustFName'];
    $this->lname = $temp['CustLName'];
    $this->address = $temp['CustAddress'];
    $this->email = $temp['CustEmail'];
    $this->username = $user;
    $this->password = $temp['password'];
    $this->letter = $temp['sendpromotion'];
  }

  public function getEmail() {
    return $this->email;
  }

  public function getUsername() {
    return $this->username;
  }

  public function getPassword() {
    return $this->password;
  }

  public function getAddress() {
    return $this->address;
  }

  public function getFName() {
    return $this->fname;
  }

  public function getLname() {
    return $this->lname;
  }

  public function getLetter() {
    return $this->letter;
  }



}

 ?>
