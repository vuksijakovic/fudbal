<?php
  require 'glava.php';
  $idu = $_GET['utakmica'];
  $idi = $_GET['strijelac'];
  $idm = $_GET['minut'];
  $sql = "INSERT INTO gol(`id`, `id_utakmice`, `id_igraca`, `minut`) VALUES (NULL,'$idu','$idi','$idm')";
  $query = mysqli_query($db, $sql);
  header('Location: utakmice.php');
  require 'dno.php';
 ?>
