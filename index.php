<?php
$host = getenv('DB_HOST');      // RDS endpoint
$user = getenv('DB_USER');      // DB username
$pass = getenv('DB_PASS');      // DB password
$dbname = getenv('DB_NAME');    // Database name

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
