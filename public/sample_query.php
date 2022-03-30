<?php require "templates/header.php"; ?>

<?php
require "data/config.php";

try {
    // Create connection
    $connection = new PDO($dsn, $username, $password, $options);


    $sql = "SELECT id, firstname, lastname FROM Players";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br>". $row["firstname"]. " " . $row["lastname"] . "<br>";
        }
    } else {
        echo "No results found.";
    }

$connection->close();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/footer.php"; ?>