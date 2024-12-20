<? 
session_start();
$member_id = $_SESSION['member_id'];
$name = $_SESSION['name'];


if (isset($_SESSION['member_id'])) {
    echo "Session already exist for member with ID:".$member_id;
} else {
    header('Location: ../login.php');
}

?>