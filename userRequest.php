<?php
include("userheader.php");

$user_id = $_SESSION['user_id'];
// echo $user_id;

if (isset($_GET['id'])){
    $servicer_id=$_GET['id'];
}


?>

<!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>CONFIRM YOUR REQUEST</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          

          <center>
            <div class="col-lg-6">
            <form action="" method="post" class="" data-aos="fade-up" data-aos-delay="500">
              <div class="row gy-4">

                

                <div class="col-md-12">
                  <textarea class="form-control" name="issue" rows="4" placeholder="Describe Your Issue" required=""></textarea>
                </div>


                  <button type="submit" class="btn btn-primary" name="register">Send Request</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->
          </center>

        </div>

      </div>

    </section><!-- /Contact Section -->




<?php include("commonfooter.php"); ?>



<?php
if (isset($_REQUEST['register'])){
  $issue=$_REQUEST['issue'];



    $qry="INSERT INTO booking(issue, user_id, service_id, `status`) VALUES ('$issue', '$user_id', '$servicer_id', 'requested')";
    echo $qry;
    $res=mysqli_query($conn,$qry);
    if($res){
        echo "<script>alert('Request Sent successfully')</script>";
        echo '<script>location.href="user_viewservice.php"</script>';
    }
    else
    {
        echo "<script>alert('Error Occured')</script>"; 
    }

}
?>

