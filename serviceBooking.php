<?php
include("serviceheader.php");

$user_id = $_SESSION['user_id'];
?>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container" data-aos="fade-up">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>APPROVED BOOKINGS</h2>
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
            WHERE booking.service_id = '$user_id' AND (booking.status != 'requested' AND booking.status != 'rejected') ORDER BY booking.id DESC";
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
                    <?php echo $row['status']; ?> <br>
                     <?php if($row['amount'] != NULL) { ?>
                        Amount: ₹<?php echo $row['amount']; ?><br>
                    <?php } ?>


                    <?php 
                    if($row['status'] == 'approved') { ?>
                      <a href="serviceBooking.php?id=<?php echo $row['id']; ?>&status=completed" class="btn btn-success">Mark as Completed</a>
                    <?php 
                    } elseif($row['status'] == 'completed') { ?>
                        <form action="serviceAddPayment.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input type="number" min='1'  name="amount" required placeholder="Enter Amount">
                            <input type="hidden" name="status" value="payment pending">
                            <button type="submit" name="register" class="btn btn-danger">Add Amount</button>
                        </form>
                    <?php } ?>
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
    $exx=mysqli_query($conn,$u);
    echo '<script>location.href="serviceBooking.php"</script>';
}
?>
