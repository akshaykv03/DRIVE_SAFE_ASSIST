<?php
include 'connection.php';

// Get booking_id from query string
if (!isset($_GET['id'])) {
    die("Invalid booking request.");
}
$booking_id = intval($_GET['id']);

// Fetch booking details (amount)
$qry = "SELECT amount FROM booking WHERE id = '$booking_id'";
$res = $conn->query($qry);
if ($res->num_rows == 0) {
    die("Booking not found.");
}
$row = $res->fetch_assoc();
$amount = $row['amount'];

// Handle payment form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Here you can save payment details (dummy for now)
    $card_number = $_POST['card_number'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];

    // Update booking as "Booked"
    $update = "UPDATE booking SET status='Payment Completed' WHERE id='$booking_id'";
    $updateslot = "UPDATE serviceregistration SET status='available' WHERE id=(SELECT service_id FROM booking WHERE id='$booking_id')";
    if ($conn->query($update) && $conn->query($updateslot)) {
        echo "<script>alert('Payment successful!'); window.location.href='userviewBookings.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error processing payment.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarServ - Secure Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300 flex items-center justify-center h-screen">
    <div class="bg-gray-800 text-white p-8 rounded-2xl shadow-xl w-96 space-y-6">
        <h2 class="text-2xl font-semibold text-center">Secure Payment</h2>
        
        <form method="POST">
            <div>
                <label class="block text-sm">Amount</label>
                <input type="text" name="amount" value="₹<?php echo htmlspecialchars($amount); ?>" 
                    class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" readonly>
            </div>
            
            <div>
                <label class="block text-sm">Card Number</label>
                <input type="text" name="card_number" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" placeholder="1234 5678 9012 3456" required maxlength="16">
            </div>
            
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label class="block text-sm">Expiry</label>
                    <input type="text" name="expiry" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" placeholder="MM/YY" maxlength="4" required>
                </div>
                <div class="w-1/2">
                    <label class="block text-sm">CVV</label>
                    <input type="password" name="cvv" class="w-full p-3 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-cyan-400" placeholder="•••" maxlength="3" required>
                </div>
            </div>
        
            <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-400 text-white py-3 rounded-lg font-semibold text-lg shadow-lg transition">Pay Now</button>
        </form>
    </div>
</body>
</html>

<?php 
// include('commonfooter.php');
 ?>
