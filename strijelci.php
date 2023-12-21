<?php
  require 'glava0.php';
  $sql = "SELECT igrac.id , COUNT(*) AS goal_count FROM igrac JOIN gol ON gol.id_igraca = igrac.id GROUP BY 1 ORDER BY goal_count desc";
  $query = mysqli_query($db, $sql);
  $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
  $brojac=1;
  $prethodni = 1;
  $gol=0;
  $sql1 = "SELECT klub.id AS id, klub.name AS name, COUNT(gol.id) AS goal_count
  FROM klub
  JOIN (igrac , gol) ON (gol.id_igraca = igrac.id AND igrac.id_kluba=klub.id)
  GROUP BY klub.id, klub.name ORDER BY goal_count desc";
  $query1 = mysqli_query($db, $sql1);
  $result1 = mysqli_fetch_all($query1, MYSQLI_ASSOC);
?>

<?php
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<table class="table" style="width:30%; margin-left:10%; margin-right:10%;"><thead style="background-color: #D3649F; color: #fff">';
  echo '<tr height = "20px">';
  echo '<th scope="col">Pozicija</th>';
  echo '<th scope="col">Igrač</th>';
  echo '<th scope="col">Golovi</th>';
  echo '</tr></thead><tbody style ="background-color: #666666; color: #fff ">';
  foreach($result as $igrac) {
    echo '<tr height = "20px">';
    $id = $igrac['id'];
    $sql = "SELECT * FROM igrac WHERE id=$id";
    $query = mysqli_query($db, $sql);
    $result2 = mysqli_fetch_assoc($query);
    if($gol==$igrac['goal_count']) {
      echo '<th scope="row">'.$prethodni.'</th>';
    }
    else {
      $gol = $igrac['goal_count'];
      $prethodni = $brojac;
      echo '<th scope="row">'.$brojac.'</th>';
    }
    $brojac++;
    echo '<td>'.$result2['ime'].'</td>';
    echo '<td>'.$igrac['goal_count'].'</td>';
    echo '</tr>';
  }
  echo '</tbody></table>';
  $brojac=1;
  $prethodni =1 ;
  $gol = 0;
  echo '<table class="table" style="width:30%;  margin-right:10%; margin-left:10%" ><thead style="background-color: #D3649F; color: #fff">';
  echo '<tr height = "20px">';
  echo '<th scope="row">Pozicija</th>';
  echo '<th scope="row">Klub</th>';
  echo '<th scope="row">Golovi</th>';
  echo '</tr></thead><tbody style ="background-color: #666666; color: #fff ">';
  foreach($result1 as $tim) {
    echo '<tr height = "20px">';
    if($gol==$tim['goal_count']) {
      echo '<th scope="row">'.$prethodni.'</th>';
    }
    else {
      $gol = $tim['goal_count'];
      $prethodni = $brojac;
      echo '<th scope="row">'.$brojac.'</th>';
    }
    $brojac++;
    echo '<td>'.$tim['name'].'</td>';
    echo '<td>'.$tim['goal_count'].'</td>';
    echo '</tr>';
  }
  echo '</tbody></table></div></div>';
  require 'dno.php';
 ?>
