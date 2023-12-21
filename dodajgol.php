<?php
  require 'glava.php';
echo '<form value="dodajgol2" action = "dodajgol1.php" method = "get" style="text-align: center; ">';
  echo '<div class="container"><div class="row">';
  $id = $_GET['utakmica'];
  $sql = "SELECT * FROM utakmica WHERE id=$id";
  $query = mysqli_query($db, $sql);
  $result = mysqli_fetch_assoc($query);
  $id1 = $result['id_tim1'];
  $id2 = $result['id_tim2'];
  $sql1 = "SELECT * FROM klub WHERE id = $id1";
  $query1 = mysqli_query($db, $sql1);
  $result2 = mysqli_fetch_assoc($query1);
  echo '<div class="col-xl-1 col-sm-6"></div>';
  echo '<div class="col-xl-3 col-sm-6">'.$result2['name'].'</div>';
  $sql1 = "SELECT * FROM klub WHERE id = $id2";
  $query1 = mysqli_query($db, $sql1);
  $result2 = mysqli_fetch_assoc($query1);
  echo '<div class="col-xl-3 col-sm-6">'.$result2['name'].'</div><div class="col-xl-2 col-sm-6"></div></div><div class="row">';
  $sql1 = "SELECT * FROM igrac WHERE id_kluba = $id1 OR id_kluba = $id2 ";
  $query1 = mysqli_query($db, $sql1);
  $result1 = mysqli_fetch_all($query1, MYSQLI_ASSOC);

  echo '<div class="col-xl-1 col-sm-6">Strijelac</div>';
  ?>

  <?php

      echo '<div class="col-xl-3 col-sm-6"><select class="btn btn-dark" style="background-color:#D3649F; height:40px;" name="strijelac" id="st">';
      foreach($result1 as $igrac) {
        $id3= $igrac['id_kluba'];
        $sql1 = "SELECT * FROM klub WHERE id = $id3";
        $query1 = mysqli_query($db, $sql1);
        $result2 = mysqli_fetch_assoc($query1);
        echo '<option value='.$igrac['id'].'>'.$igrac['ime']." - ".$result2['name']. " - ". $igrac['id'].'</option>';
    }
    echo '</select></div>';
  echo '<div class="col-xl-3 col-sm-6">Minut gola <input class="btn btn-dark" type="number" id="quantity" name="minut" min="1" max="90" style="background-color:#D3649F;width:60px;margin-left: 10px;margin-right:10px;" required></div  >';
    echo '<div class="col-xl-2 col-sm-6"><input class="btn btn-dark" style="background-color:#D3649F" type="submit" value="Sačuvaj"/></div>';
  echo '<input type="hidden" name="utakmica" value="'.$id.'">';

  echo '</div></div>';
  echo '</form>';
  require 'dno.php';
 ?>
