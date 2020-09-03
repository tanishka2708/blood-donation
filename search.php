<style type="text/css">
.sub-head{
            text-align: center;
            color: #393b44;
            padding-top: 50px;
            padding-bottom: 20px;
            font-size: 1.9rem;
            font-weight: 400;
            font-family: 'Open Sans', sans-serif;

        }
        .search{
          width: 350px;

        }

</style>

<?php include('header.php'); ?>
 <?php  include('config/db_connect.php');

if(isset($_POST['search'])){
    $bgrp = mysqli_real_escape_string($conn, $_POST['q']);
    $bgrp= strtoupper("$bgrp");
    if($bgrp == " " ||  empty($_POST['q']))
    {
            header('Location: index.php');
    }
      else {
          // code...
          $data=mysqli_query($conn,"SELECT * FROM donations WHERE bloodgroup LIKE '$bgrp' " );
          $bgdonars = mysqli_fetch_all($data , MYSQLI_ASSOC);
            if(!empty($bgdonars))
            {
                  foreach($bgdonars as $a){  ?>
                  <div class="col s6 md3 search">
                    <div class="card z-depth-0">
                      <div class="card-content center">
                        <h6><?php echo htmlspecialchars($a['name_of_donor']); ?></h6>
                        <div><?php echo htmlspecialchars($a['bloodgroup']); ?></div>
                      </div>
                      <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $a['id'] ?>">more info</a>
                      </div>
                    </div>
                  </div>

              <?php }
            }
            else {
              ?>


                <h4 class="sub-head">Blood Group Not Available</h4>
                <?php
              // code...
            }

        }
      }

    ?>



	<?php include('footer.php'); ?>
