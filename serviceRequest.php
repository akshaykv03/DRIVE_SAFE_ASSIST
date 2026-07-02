<?php
include("serviceheader.php");

$user_id = $_SESSION['user_id'];
?>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container" data-aos="fade-up">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>VIEW REQUESTS</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Issue</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // fetch all requests made by the user from the booking table
            $sql = "SELECT booking.*, userregistration.name, userregistration.email, userregistration.phoneno 
            FROM booking INNER JOIN userregistration ON booking.user_id = userregistration.id 
            WHERE booking.service_id = '$user_id' AND booking.status = 'requested' ORDER BY booking.id DESC";
// echo $sql; // Debugging line to check the SQL query
            $result = $conn->query($sql);
            if ($result) {
                $i=1;
                while($row = mysqli_fetch_assoc($result)) {
                    
                    ?>
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $row['issue']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phoneno']; ?></td>
                <td>
                    <a href="serviceRequest.php?id=<?php echo $row['id']; ?>&status=approved" class="btn btn-success">Approve</a>
                    <a href="serviceRequest.php?id=<?php echo $row['id']; ?>&status=rejected" class="btn btn-danger">Reject</a>
                    </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No requests found.</td></tr>";    
            }
            ?>
          </tbody>
        </table> <!-- ✅ closed table properly -->
      </div>
    </div>
  </div>
</section><!-- /Contact Section -->

<?php
include("commonfooter.php");
?>

<?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    // echo $id;
    $status=$_GET['status'];
    $u="update booking set status = '$status' where id= $id ";
    echo $u;
    $q="update serviceregistration set status = 'unavailable' where id= (select service_id from booking where id= $id )";
    echo $q;
    $exx=mysqli_query($conn,$u);
    $exx=mysqli_query($conn,$q);
    echo '<script>location.href="serviceRequest.php"</script>';
}
?>
