<?php
$host = getenv('database.c1w8084u6kqu.ap-south-1.rds.amazonaws.com');      // RDS endpoint
$user = getenv('admin');      // DB username
$pass = getenv('m8?O)0QU[3m!sPidEzz8u>D_cuj)');      // DB password
$dbname = getenv('dynamic');    // Database name

// Connect to DB
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("DB Connection failed: " . $conn->connect_error);
}

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $stmt = $conn->prepare("INSERT INTO demo_users (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP + RDS Demo</title>
</head>
<body>
    <h1>PHP + RDS (MySQL) Demo 🚀</h1>

    <form method="POST">
        <input type="text" name="name" placeholder="Enter Name" required>
        <button type="submit">Save</button>
    </form>

    <h2>Stored Names:</h2>
    <ul>
        <?php
        $result = $conn->query("SELECT id, name FROM demo_users ORDER BY id DESC");
        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row['id'] . ": " . htmlspecialchars($row['name']) . "</li>";
        }
        ?>
    </ul>
</body>
</html>
