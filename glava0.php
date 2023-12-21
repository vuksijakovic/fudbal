

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <script src="jquery-3.6.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css"></link>
    <link rel="stylesheet" href="style.css"></link>
  <?php
        $db = mysqli_connect('localhost','root','','fudbal2.0') or die ("Connection error");
   ?>
    <title></title>
  </head>
  <!-- <style>
    [class*="col"] {
      padding-left : 1rem;
      padding-right: 1rem;
      padding-top: 5px;
      padding-bottom: 5px;
      margin-top: 0.2rem;
      background-color: #666666;
      border: 1px solid #fff;
      color: #fff;
      text-align: center;
    }
  </style> -->
  <body style = "background-color:#E1D9D1">
    <div class = "meni">
      <nav class = "navbar navbar-expand navbar-dark" style="background-color:#D3649F">
        <a href="index.php"><img   src="premier-league-2-logo.png" alt="Premier League logo" width="30" height="50" style="margin-right:10px;margin-left:10px" ></a>
        <a href="index.php" style="padding:5px" class = "navbar-brand">Početna</a>
        <a href="utakmice.php" style="padding:5px" class = "navbar-brand">Utakmice</a>
        <a href="strijelci.php" style="padding:5px" class = "navbar-brand">Najbolji strijelci</a>
        <a href="stadioni.php" style="padding:5px" class = "navbar-brand">Stadioni</a>
      </nav>
    </div>
     <br>
