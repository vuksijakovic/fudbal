<?php
  require 'glava.php';
  $id=$_GET['utakmica'];
  $sql1 = "SELECT * FROM utakmica WHERE id=$id";
  $query1 = mysqli_query($db, $sql1);
  $utakmica = mysqli_fetch_assoc($query1);
  $sql2 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND gol.minut<=45) GROUP BY clubid";
  $query2 = mysqli_query($db,$sql2);
  $gg = mysqli_fetch_all($query2, MYSQLI_ASSOC);

  $idk1 = $utakmica['id_tim1'];
  $idk2 = $utakmica['id_tim2'];
  $sql3 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND gol.minut<=45 AND igrac.id_kluba=$idk1) GROUP BY 1";
  $query3 = mysqli_query($db,$sql3);
  $golDomaci = mysqli_fetch_all($query3, MYSQLI_ASSOC);
  $sql4 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND gol.minut<=45 AND igrac.id_kluba=$idk2) GROUP BY 1";
  $query4 = mysqli_query($db,$sql4);
  $golGost = mysqli_fetch_all($query4, MYSQLI_ASSOC);
  $sql = "SELECT * FROM gol WHERE (id_utakmice=$id AND minut<=45)";
  $query = mysqli_query($db, $sql);
  $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
  echo  '<div class="card" style="width: 18rem;float:left; margin-left:25px;margin-bottom:10px;">';
  echo '<div class="card-body" style="background-color:#D3649F;">';
  echo  '<h5 class="card-title">Prvo poluvrijeme</h5>';
  echo  '<p class="card-text">Statistika</p>';
echo '</div>';
  echo '<ul class="list-group list-group-flush" style="background-color: #000000">';
  if(sizeof($result)>=3) {
    echo   '<li class="list-group-item" style="background-color: #666666; color:#FFFFFF">3+: Da</li>';
  }
  else {
    echo   '<li class="list-group-item" style="background-color: #666666; color:#FFFFFF">3+: Ne</li>';
  }
  echo   '<li class="list-group-item" style="background-color: #666666; color:#FFFFFF">Golovi domaćina: '.sizeof($golDomaci).'</li>';
  echo   '<li class="list-group-item" style="background-color: #666666; color:#FFFFFF">Golovi gosta: '.sizeof($golGost).'</li>';

  if(sizeof($gg)==2) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Oba tima postigla gol: Da</li>';
  }
  else {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Oba tima postigla gol: Ne</li>';
  }
  if(sizeof($golDomaci)>sizeof($golGost)) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod poluvremena: Pobjeda domaćina</li>';
  }
  else if(sizeof($golDomaci)==sizeof($golGost)) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod poluvremena: Neriješeno</li>';
  }
  else {
echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod poluvremena: Pobjeda gosta</li>';
  }
  echo '</ul>';
  echo '<div class="card-body" style="background-color:#D3649F;">';
  echo   '<a href="utakmice.php" style="color:#FFF" class="card-link">Prikaži sve utakmice</a>';
  echo '</div>';

  echo '</div>';
  $sql2 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND gol.minut>45) GROUP BY clubid";
  $query2 = mysqli_query($db,$sql2);
  $gg = mysqli_fetch_all($query2, MYSQLI_ASSOC);
  $idk1 = $utakmica['id_tim1'];
  $idk2 = $utakmica['id_tim2'];
  $sql3 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND gol.minut>45 AND igrac.id_kluba=$idk1) GROUP BY 1";
  $query3 = mysqli_query($db,$sql3);
  $golDomaci = mysqli_fetch_all($query3, MYSQLI_ASSOC);
  $sql4 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND gol.minut>45 AND igrac.id_kluba=$idk2) GROUP BY 1";
  $query4 = mysqli_query($db,$sql4);
  $golGost = mysqli_fetch_all($query4, MYSQLI_ASSOC);
  $sql = "SELECT * FROM gol WHERE (id_utakmice=$id AND minut>45)";
  $query = mysqli_query($db, $sql);
  $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
  echo  '<div class="card" style="width: 18rem;float:left; margin-left:25px;margin-bottom:10px;">';
  echo '<div class="card-body" style="background-color:#D3649F;">';
  echo  '<h5 class="card-title">Drugo poluvrijeme</h5>';
  echo  '<p class="card-text">Statistika</p>';
echo '</div>';
  echo '<ul class="list-group list-group-flush" style="background-color: #000000">';
  if(sizeof($result)>=3) {
    echo   '<li class="list-group-item" style="background-color: #666666; color:#FFFFFF">3+: Da</li>';
  }
  else {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">3+: Ne</li>';
  }
  echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Golovi domaćina: '.sizeof($golDomaci).'</li>';
  echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Golovi gosta: '.sizeof($golGost).'</li>';

  if(sizeof($gg)==2) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Oba tima postigla gol: Da</li>';
  }
  else {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Oba tima postigla gol: Ne</li>';
  }
  if(sizeof($golDomaci)>sizeof($golGost)) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod poluvremena: Pobjeda domaćina</li>';
  }
  else if(sizeof($golDomaci)==sizeof($golGost)) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod poluvremena: Neriješeno</li>';
  }
  else {
echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod poluvremena: Pobjeda gosta</li>';
  }
  echo '</ul>';
  echo '<div class="card-body"style="background-color:#D3649F;">';
  echo   '<a href="utakmice.php" style="color:#FFF" class="card-link">Prikaži sve utakmice</a>';
  echo '</div>';

  echo '</div>';
  $sql2 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id ) GROUP BY clubid";
  $query2 = mysqli_query($db,$sql2);
  $gg = mysqli_fetch_all($query2, MYSQLI_ASSOC);
  $idk1 = $utakmica['id_tim1'];
  $idk2 = $utakmica['id_tim2'];
  $sql3 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND igrac.id_kluba=$idk1) GROUP BY 1";
  $query3 = mysqli_query($db,$sql3);
  $golDomaci = mysqli_fetch_all($query3, MYSQLI_ASSOC);
  $sql4 = "SELECT gol.id,gol.id_utakmice, igrac.id_kluba AS clubid FROM gol JOIN igrac ON (gol.id_igraca = igrac.id AND gol.id_utakmice=$id AND  igrac.id_kluba=$idk2) GROUP BY 1";
  $query4 = mysqli_query($db,$sql4);
  $golGost = mysqli_fetch_all($query4, MYSQLI_ASSOC);
  $sql = "SELECT * FROM gol WHERE (id_utakmice=$id)";
  $query = mysqli_query($db, $sql);
  $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
  echo  '<div class="card" style="width: 18rem;float:left; margin-left:25px;margin-bottom:10px;">';
  echo '<div class="card-body" style="background-color:#D3649F;">';
  if($utakmica['gotova']==1) {
    echo  '<h5 class="card-title">Kraj</h5>';
    echo  '<p class="card-text">Statistika</p>';
  }
  else {
    echo  '<h5 class="card-title">Utakmica u toku</h5>';
    echo  '<p class="card-text">Trenutna statistika</p>';
  }

echo '</div>';
  echo '<ul class="list-group list-group-flush" style="background-color: #000000">';
  if(sizeof($result)>=3) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">3+: Da</li>';
  }
  else {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">3+: Ne</li>';
  }
  echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Golovi domaćina: '.sizeof($golDomaci).'</li>';
  echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Golovi gosta: '.sizeof($golGost).'</li>';

  if(sizeof($gg)==2) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Oba tima postigla gol: Da</li>';
  }
  else {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Oba tima daju gol: Ne</li>';
  }
  if(sizeof($golDomaci)>sizeof($golGost)) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod: Pobjeda domaćina</li>';
  }
  else if(sizeof($golDomaci)==sizeof($golGost)) {
    echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod: Neriješeno</li>';
  }
  else {
echo   '<li class="list-group-item"style="background-color: #666666; color:#FFFFFF">Ishod: Pobjeda gosta</li>';
  }
  echo '</ul>';
  echo '<div class="card-body" style="background-color:#D3649F;">';
  echo   '<a href="utakmice.php" style="color:#FFF" class="card-link">Prikaži sve utakmice</a>';
  echo '</div>';

  echo '</div>';
  require 'dno.php';
 ?>
