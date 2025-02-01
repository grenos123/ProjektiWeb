<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: login.html');
    exit();
}
if ($_SESSION['user_role'] !== 'admin') {
    die("<h1>Access Denied</h1><p>Only admins are allowed to access this page</p>");
    header('Location: login.html');
    
}
class Database {
    private $conn;

    public function __construct($host, $user, $password, $dbname) {
        $this->conn = new mysqli($host, $user, $password, $dbname);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function close() {
        $this->conn->close();
    }
}

$db = new Database('localhost', 'root', '', 'contact');

$feedbackData = $db->query("SELECT name, email, phone, message FROM contact");
if ($feedbackData->num_rows === 0) {
    echo "No feedback data found";
    $db->close();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $feedbackData->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
<?php
$db->close();
?>