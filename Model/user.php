<?php
class user {

  private $uid,$fname,$lname,$address,$email,$username,$password;

  public function __construct($uid,$fname,$lname,$address,$email,$username,$password) {
    $this->uid = $uid;
    $this->fname = $fname;
    $this->lname = $lname;
    $this->address = $address
    $this->email = $email;
    $this->username = $username;
    $this->password = $password;
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

  public function getEmail($email) {
    $this->email = $email;
  }

  public function getUsername($username) {
    $this->username = $username;
  }

  public function getPassword($password) {
    $this->password = $password;
  }

  public function getAddress($address) {
    $this->address = $address;
  }

  public function getFName() {
    $this->fname = $fname;
  }

  public function getLname() {
    $this->lname = $lname;
  }


}

 ?>
