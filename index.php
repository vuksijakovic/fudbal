<?php
  require 'glava.php';
  $sql1 = "SELECT klub.id, klub.name, IFNULL(COUNT(gol.id), 0) AS dati_golovi
  FROM klub
  LEFT JOIN (igrac , gol) ON (gol.id_igraca = igrac.id AND igrac.id_kluba=klub.id)
  GROUP BY klub.id, klub.name";
  $query1 = mysqli_query($db, $sql1);
  $result1 = mysqli_fetch_all($query1, MYSQLI_ASSOC);
  $sql = "SELECT * FROM utakmica";
  $query = mysqli_query($db, $sql);
  $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

  echo '<div class="container" >';
  echo '<div class="row align-items-center">';
  echo '<div class="col-xl-2 col-sm-2" style="background-color:#D3649F;">Ime tima</div>';
  echo '<div class="col-lg-1 col-sm-2" style="background-color:#D3649F;">Bodovi</div>';
  echo '<div class="col-lg-1 col-sm-2" style="background-color:#D3649F;">Postignuti</div>';
  echo '<div class="col-lg-1 col-sm-2" style="background-color:#D3649F;">Primljeni</div>';
  echo '<div class="col-lg-1 col-sm-2" style="background-color:#D3649F;">Razlika</div>';

  echo '</div>';
  foreach($result1 as $tim) {
    $tim['points']=0;
    foreach($result as $utakmica) {
      if($tim['id']==$utakmica['id_tim1']) {
        $idk1 = $tim['id'];
        $idk2 = $utakmica['id_tim2'];
        $id = $utakmica['id'];
        $sql3 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND igrac.id_kluba=$idk1) GROUP BY 1";
        $query3 = mysqli_query($db,$sql3);
        $golDomaci = mysqli_fetch_all($query3, MYSQLI_ASSOC);
        $sql4 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND  igrac.id_kluba=$idk2) GROUP BY 1";
        $query4 = mysqli_query($db,$sql4);
        $golGost = mysqli_fetch_all($query4, MYSQLI_ASSOC);
        if($golDomaci>$golGost) {
          $tim['points']+=3;
        }
        else if ($golDomaci==$golGost) {
          $tim['points']++;
        }
      }
      if($tim['id']==$utakmica['id_tim2']) {
        $idk1 = $utakmica['id_tim1'];
        $idk2 = $tim['id'];
        $id = $utakmica['id'];
        $sql3 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND igrac.id_kluba=$idk1) GROUP BY 1";
        $query3 = mysqli_query($db,$sql3);
        $golDomaci = mysqli_fetch_all($query3, MYSQLI_ASSOC);
        $sql4 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND  igrac.id_kluba=$idk2) GROUP BY 1";
        $query4 = mysqli_query($db,$sql4);
        $golGost = mysqli_fetch_all($query4, MYSQLI_ASSOC);
        if($golDomaci<$golGost) {
          $tim['points']+=3;
        }
        else if ($golDomaci==$golGost) {
          $tim['points']++;
        }
      }
    }

    $id = $tim['id'];
    $sql2 = "SELECT klub.id, klub.name, IFNULL(COUNT(*), 0) AS primljeni_golovi
    FROM klub
    JOIN (igrac , gol, utakmica) ON (((utakmica.id_tim1= klub.id AND igrac.id_kluba=utakmica.id_tim2 AND gol.id_utakmice=utakmica.id AND gol.id_igraca=igrac.id AND klub.id=$id) OR (utakmica.id_tim2=klub.id AND igrac.id_kluba=utakmica.id_tim1 AND gol.id_utakmice=utakmica.id AND gol.id_igraca=igrac.id AND klub.id=$id)))
    GROUP BY klub.id, klub.name";
    $query2 = mysqli_query($db, $sql2);
    $result2 = mysqli_fetch_assoc($query2);
    if(isset($result2['primljeni_golovi'])) {
      echo '<div class="row"><div class="col-xl-2 col-sm-2">'.$tim['name']. '</div><div class="col-lg-1 col-sm-2">'.$tim['points'].'</div><div class="col-lg-1 col-sm-2">'. $tim['dati_golovi'].'</div><div class="col-lg-1 col-sm-2">'.$result2['primljeni_golovi'] .'</div><div class="col-lg-1 col-sm-2">'.$tim['dati_golovi']-$result2['primljeni_golovi'] .'</div></div>';
    }
    else {
      echo '<div class="row"><div class="col-xl-2 col-sm-2">'.$tim['name']. '</div><div class="col-lg-1 col-sm-2">'.$tim['points'].'</div><div class="col-lg-1 col-sm-2">'. $tim['dati_golovi'].'</div><div class="col-lg-1 col-sm-2"> 0</div><div class="col-lg-1 col-sm-2">'.$tim['dati_golovi'] .'</div></div>';
    }

  }
  echo '</div>';
  ?>


  <?php
  require 'dno.php';

 ?>
