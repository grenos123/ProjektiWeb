<?php
session_start();
if ($_SESSION['user_role'] !== 'admin') {
    header('Location: login.html');
    exit();
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

    public function prepare($query) {
        return $this->conn->prepare($query);
    }

    public function close() {
        $this->conn->close();
    }
}

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        return $this->db->query("SELECT username, email, role FROM registrationfinal");
    }

    public function updateRole($email, $role) {
        $stmt = $this->db->prepare("UPDATE registrationfinal SET role = ? WHERE email = ?");
        $stmt->bind_param("ss", $role, $email);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
}

$db = new Database('localhost', 'root', '', 'registrationfinal');
$userManager = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['role'])) {
    $email = $_POST['email'];
    $role = $_POST['role'];

    if ($userManager->updateRole($email, $role)) {
        echo "<script>alert('Role updated successfully!'); window.location.href='assign.php';</script>";
    } else {
        echo "<script>alert('Failed to update role.');</script>";
    }
}

$users = $userManager->getAllUsers();
$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Role</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Current Role</th>
                <th>Assign Role</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <form action="assign.php" method="POST">
                            <input type="hidden" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                            <select name="role">
                                <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                                <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <br>
    <a href="dashboard.php">Back to Admin Dashboard</a>
</body>
</html>
