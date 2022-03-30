<?php require "templates/header.php"; ?>

<form method="post">
  <label for="column">Column</label>
  <input type="text" name="column" id="column">
  <input type="text" name="column" value="column">
</form>

<?php

require "data/config.php";

try {
    // Create connection
    $connection = new PDO($dsn, $username, $password, $options);
    
    $col = $_POST["column"];

    $sql = "SELECT " . $_POST["column"] . " FROM Venues";
    $result = $connection->query($sql);

    if ($col != "address" and $col != "name" and $col != "capacity") {
        echo "Invalid column.";
    } else if ($_POST["column"] == "name") {

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<br>". $row[$col] . "<br>";
            }
        } else {
            echo "No results found.";
        }

    }
    $connection->close();

} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/footer.php"; ?>