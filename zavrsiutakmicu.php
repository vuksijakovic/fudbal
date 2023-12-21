<?php
  require 'glava.php';
  $id = $_GET['utakmica'];
  $sql = "UPDATE utakmica SET gotova = '1' WHERE id=$id";
  $query = mysqli_query($db,$sql);
  header("Location: utakmice.php");
  require 'dno.php';
 ?>
