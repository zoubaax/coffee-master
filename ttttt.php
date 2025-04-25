<?php
include 'config.php';

// Handle Add User
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $conn->query("INSERT INTO users (name, last_name) VALUES ('$name', '$last_name')");
    header("Location: index.php");
}

// Handle Edit User
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $conn->query("UPDATE users SET name='$name', last_name='$last_name' WHERE id=$id");
    header("Location: index.php");
}

// Handle Delete User
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: index.php");
}

// Fetch Users
$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD - Users</title>
</head>
<body>
    <h2>Users List</h2>
    <form method="POST">
        <input type="hidden" name="id" id="user_id">
        <input type="text" name="name" id="name" placeholder="Name" required>
        <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
        <button type="submit" name="add">Add</button>
        <button type="submit" name="edit">Update</button>
    </form>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Last Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['last_name'] ?></td>
                <td>
                    <a href="javascript:void(0);" onclick="editUser(<?= $row['id'] ?>, '<?= $row['name'] ?>', '<?= $row['last_name'] ?>')">Edit</a>
                    <a href="index.php?delete=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <script>
        function editUser(id, name, lastName) {
            document.getElementById('user_id').value = id;
            document.getElementById('name').value = name;
            document.getElementById('last_name').value = lastName;
        }
    </script>
</body>
</html>