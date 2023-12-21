<?php
  require 'glava0.php';
?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
  <section class="gallery min-vh-100">
     <div class="container-lg">
        <div class="row gy-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
           <?php
           $sql = "SELECT * FROM klub";
           $query = mysqli_query($db, $sql);
           $result = mysqli_fetch_all($query, MYSQLI_ASSOC);

            foreach($result as $tim) {
            echo   '<div class="col">';
            echo     '<img src="img/'.$tim['name'].'.jpg" class="gallery-item" style="width:100%; height:100%" alt="'.$tim['name'].'">';
              echo '</div>';
            }

            ?>
        </div>
     </div>
  </section>

<!-- Modal -->
<div class="modal fade" id="gallery-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <!-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <img src="img/Arsenal.jpg" class="modal-img" alt="modal img">
      </div>
    </div>
  </div>
</div>


<script src="js/bootstrap.bundle.min.js"></script>
<script src="main.js"></script>
<?php
  require 'dno.php';
 ?>
