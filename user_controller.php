<?php
// user_controller.php
class user_controller {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function get_user_transactions($user_id) {
        // Fetch user transactions from the database
        $query = "SELECT * FROM transactions WHERE user_id = $user_id";
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function update_laptop_status($laptop_id, $status) {
        // Update the status of a laptop
        $query = "UPDATE laptops SET status = '$status' WHERE laptop_id = $laptop_id";
        mysqli_query($this->conn, $query);
    }
}
?>