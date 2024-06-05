<?php
try {
    $dsn = "mysql:host=localhost;dbname=testdb";
    $username = "root";
    $password = "";
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    $pdo = new PDO($dsn, $username, $password, $options);

    // SELECT
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', 1, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch();
    echo "SELECT result:\n";
    print_r($user);

    // SELECT with multiple parameters
    $sql = "SELECT * FROM users WHERE age > :age AND city = :city";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':age', 21, PDO::PARAM_INT);
    $stmt->bindValue(':city', 'New York', PDO::PARAM_STR);
    $stmt->execute();
    $users = $stmt->fetchAll();
    echo "SELECT with multiple parameters result:\n";
    print_r($users);

    // INSERT
    $sql = "INSERT INTO users (name, email, age) VALUES (:name, :email, :age)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', 'John Doe', PDO::PARAM_STR);
    $stmt->bindValue(':email', 'john@example.com', PDO::PARAM_STR);
    $stmt->bindValue(':age', 25, PDO::PARAM_INT);
    $stmt->execute();
    echo "User inserted with ID: " . $pdo->lastInsertId() . "\n";

    // INSERT multiple records
    $sql = "INSERT INTO users (name, email, age) VALUES (:name, :email, :age)";
    $stmt = $pdo->prepare($sql);
    $users = [
        ['name' => 'Alice', 'email' => 'alice@example.com', 'age' => 30],
        ['name' => 'Bob', 'email' => 'bob@example.com', 'age' => 22],
        ['name' => 'Charlie', 'email' => 'charlie@example.com', 'age' => 35]
    ];

    foreach ($users as $user) {
        $stmt->bindValue(':name', $user['name'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $user['email'], PDO::PARAM_STR);
        $stmt->bindValue(':age', $user['age'], PDO::PARAM_INT);
        $stmt->execute();
    }
    echo "Multiple users inserted\n";

    // UPDATE
    $sql = "UPDATE users SET email = :email WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', 'newemail@example.com', PDO::PARAM_STR);
    $stmt->bindValue(':id', 1, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "Record updated successfully\n";
    } else {
        echo "No record updated\n";
    }

    // DELETE
    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', 2, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo "Record deleted successfully\n";
    } else {
        echo "No record deleted\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>