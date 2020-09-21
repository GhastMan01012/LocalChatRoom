<?php
session_start();
$needle = $_GET['id'];
if(key_exists($needle, $_SESSION['cart'][$_GET['category']])) {
  echo $_SESSION['cart'][$_GET["category"]][$_GET['id']];
  //$_SESSION['cart'][$_GET["category"]][$_GET['id']] += 1;
  echo "aaa";
} else {
  $_SESSION['cart'][$_GET["category"]][] = Array($_GET['id'] => 1);
  echo "Added to cart";
}
unset($_SESSION['cart']);
?>
