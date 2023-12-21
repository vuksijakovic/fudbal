 <?php
    require 'glava.php';
    $sql = "SELECT * FROM klub";
    $query = mysqli_query($db, $sql);
    $result = mysqli_fetch_all($query,MYSQLI_ASSOC);
  ?>

  <?php
    if(isset($_POST['domaciTim']) && isset($_POST['gostujuciTim']) && isset($_POST['datum']) && $_POST['gostujuciTim']!=$_POST['domaciTim']) {
      $sql = "SELECT * FROM utakmica";
      $query = mysqli_query($db, $sql);
      $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
      $uslov = 0;
      $id1 = $_POST['domaciTim'];
      $id2 = $_POST['gostujuciTim'];
      foreach($result as $utakmica) {
        if($utakmica['time']==$_POST['datum']) {
          if($utakmica['id_tim1']==$id1 || $utakmica['id_tim1']==$id2 || $utakmica['id_tim2']==$id1 || $utakmica['id_tim2']==$id2) {
            $uslov=1;
            break;
          }
        }
      }
      if($uslov==0) {
      echo 1;
        $id1 = $_POST['domaciTim'];
        $id2 = $_POST['gostujuciTim'];
        $datum = $_POST['datum'];
        $sql = "INSERT INTO utakmica (`id`, `id_tim1`, `id_tim2`, `time`, `gotova`) VALUES (NULL,'$id1','$id2','$datum','0')";
        $query = mysqli_query($db, $sql);
      }
    }
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-xl-2 col-sm-6" style="background-color:#D3649F;">Datum</div>';
    echo '<div class="col-xl-2 col-sm-6" style="background-color:#D3649F;">Domaćin</div>';
    echo '<div class="col-xl-1 col-sm-6" style="background-color:#D3649F;">Rezultat</div>';
    echo '<div class="col-xl-2 col-sm-6" style="background-color:#D3649F;">Gost</div>';
    echo '<div class="col-xl-2 col-sm-6" style="background-color:#D3649F;">Statistika</div>';
    echo '<div class="col-xl-2 col-sm-6" style="background-color:#D3649F;"">Status utakmice</div>';
    echo '</div></div>';
    $sql = "SELECT * FROM utakmica ORDER BY time";
    $query = mysqli_query($db, $sql);
    $result = mysqli_fetch_all($query,MYSQLI_ASSOC);
  //  echo '<table>';
  //  echo '<tr><th>Datum</th><th>Domaćin</th><th>Gost</th><th>Rezultat</th><th></th><th></th><th></th></tr>';
    foreach($result as $utakmica) {
      $id1 = $utakmica['id_tim1'];
      $id2 = $utakmica['id_tim2'];
      $sql1 = "SELECT * FROM klub WHERE id=$id1";
      $sql2 = "SELECT * FROM klub WHERE id=$id2";
      $query1 = mysqli_query($db, $sql1);
      $query2 = mysqli_query($db, $sql2);
      $result1 = mysqli_fetch_assoc($query1);
      $result2 = mysqli_fetch_assoc($query2);
      $prvi =0 ;
      $drugi = 0;
      $id3 = $utakmica['id'];
      $sql3 = "SELECT * FROM gol WHERE id_utakmice = $id3";
      $query3 = mysqli_query($db, $sql3);
      $result3 = mysqli_fetch_all($query3, MYSQLI_ASSOC);
      foreach($result3 as $gol) {
        $id4 = $gol['id_igraca'];
        $sql4 = "SELECT * FROM igrac WHERE id = $id4";
        $query4 = mysqli_query($db, $sql4);
        $result4 = mysqli_fetch_assoc($query4);
        if($result4['id_kluba']==$utakmica['id_tim1']) $prvi++;
        if($result4['id_kluba']==$utakmica['id_tim2']) $drugi++;
      }
      echo '<div class="container">';
      echo '<div class="row">';
      $phpdate = strtotime( $utakmica['time'] );
      $mysqldate = date( 'd.m.Y', $phpdate );
      echo '<div class="col-xl-2 col-sm-6">'.$mysqldate.'</div>';
      echo '<div class="col-xl-2 col-sm-6">'.$result1['name'].'</div>';
      echo '<div class="col-xl-1 col-sm-6">'.$prvi." : ". $drugi.'</div>';
      echo '<div class="col-xl-2 col-sm-6">'.$result2['name'].'</div>';
  //    echo '<td>'.$mysqldate.'</td>';
    //  echo '<td>'.$result1['name'].'</td>';
  //    echo '<td>'.$result2['name'].'</td>';
    //  echo '<td>'.$prvi." : ". $drugi.'</td>';
    echo '<div class="col-xl-2 col-sm-6">';
   echo '<form action = "statistika.php">';
      echo '<input type = "hidden" name="utakmica" value="'.$utakmica['id'].'"/>';
    //  echo '<td><input type="submit" value="Statistika"/></td>';
    echo   '<input class="btn btn-dark" style="background-color:#D3649F" type="submit" value="Statistika"/>';
    echo '</form>';
    echo '</div>';
      $date = date('d.m.Y', time());
      $broj=0;
      if($mysqldate<$date) {
        $id5= $utakmica['id'];
        $sql5 = "UPDATE utakmica SET gotova='1' WHERE id =$id5";
        $query = mysqli_query($db, $sql5);
        $broj=1;
      }
      echo '<div class="col-xl-2 col-sm-6">';
      if($utakmica['gotova']==0 && $broj==0) {
        echo '<form action = "dodajgol.php" style="display:inline-block; margin-right:5px">';
        echo '<input type="hidden" name = "utakmica" value="'.$utakmica['id'].'"/>';
    //    echo '<td><input type="submit" value="Dodaj gol"/></td>';
        echo '<input class="btn btn-dark" style="background-color:#D3649F; display: inline-block" type="submit" value="Gol"/>';
        echo '</form>';
        echo '<form action="zavrsiutakmicu.php" style="display:inline-block; margin-left:5px">';
        echo '<input type="hidden" name="utakmica" value="'.$utakmica['id'].'"/>';
          echo '<input class="btn btn-dark" style="background-color:#D3649F; display: inline-block" type="submit" value="Kraj"/>';

    //  echo '<td><input type="submit" value="Završi utakmicu"/></td>';
        echo '</form>';
      }
      else {
        echo 'Utakmica završena';
      //  echo '<td>Utakmica završena</td><td></td>';
      }
      echo '</div></div></div>';

    }

    $sql = "SELECT * FROM klub";
    $query = mysqli_query($db, $sql);
    $result = mysqli_fetch_all($query,MYSQLI_ASSOC);
    ?>
    <form action="" method = "post" style="text-align: center">
      <div class="container">
      <div class="row">
        <div class="col-xl-2 col-sm-6"><input class="btn btn-dark" style="background-color:#D3649F"  type="date" id="start" name="datum" value=""  min="<?php echo date("Y-m-d", time()) ?>" max="2030-12-31" required></div>
        <div class="col-xl-2 col-sm-6">
      <select class="btn btn-dark" style="background-color:#D3649F; width:100%" name="domaciTim" id="dt">
      <?php
          foreach($result as $tim) {
              echo '<option value='.$tim['id'].'>'.$tim['name'].'</option>';
          }
       ?>
      </select>
    </div>
    <div class="col-xl-1 col-sm-6">
      VS
    </div>
      <div class="col-xl-2 col-sm-6">
      <select class="btn btn-dark" style="background-color:#D3649F; width:100%" name="gostujuciTim" id="gt">
      <?php
          foreach($result as $tim) {
              echo '<option value='.$tim['id'].'>'.$tim['name'].'</option>';
          }
       ?>
      </select>
    </div>

      <div class="col-xl-2 col-sm-6"><input class="btn btn-dark" style="background-color:#D3649F; display: inline-block" type="submit" value="Dodaj utakmicu" /></div>
<div class="col-xl-2 col-sm-6"></div>

    </div></div>
</form>
<?php
    require 'dno.php';
 ?>
