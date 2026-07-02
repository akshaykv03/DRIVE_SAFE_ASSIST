<?php
include("userheader.php");

$user_id = $_SESSION['user_id'];
?>

<!-- Contact Section -->
<section id="contact" class="contact section">
  <div class="container" data-aos="fade-up">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>YOUR ACCEPTED BOOKINGS</h2>
      <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Issue</th>
              <th scope="col">Servicer Name</th>
              <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // fetch all requests made by the user from the booking table
            $sql = "SELECT booking.*, serviceregistration.name, serviceregistration.email, serviceregistration.phone_no 
            FROM booking INNER JOIN serviceregistration ON booking.service_id = serviceregistration.id 
            WHERE booking.user_id = '$user_id' AND (booking.status != 'requested' AND booking.status != 'rejected') ORDER BY booking.id DESC";
// echo $sql; // Debugging line to check the SQL query
            $result = $conn->query($sql);
            if ($result) {
                while($row = mysqli_fetch_assoc($result)) {
                    $i=1;
                    ?>
            <tr>
                <th scope="row"><?php echo $i++; ?></th>
                <td><?php echo $row['issue']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone_no']; ?></td>
                <td><?php echo $row['status']; ?> <br>
                <?php if($row['amount'] != NULL) { ?>
                        Amount: ₹<?php echo $row['amount']; ?><br>
                    <?php } ?>
                <?php
                if($row['status'] == 'payment pending') {
                    echo "<p class='text-success'>Amount: " . $row['amount'] . " RS/-</p>";
                    echo "<a href='userpay.php?id=".$row['id']."' class='btn btn-primary'>Pay Now</a>";
                }
                elseif($row['status'] == 'Payment Completed') {
                    echo "<a href='userfeedback.php?id=".$row['id']."' class='btn btn-primary'>Add Feedback</a>";
                }

                ?>
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
