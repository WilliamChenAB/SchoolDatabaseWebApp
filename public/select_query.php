<?php require "templates/header.php"; ?>

<form method="post">
  <label for="total_goals">Total Goals</label>
  <input type="number" name="total_goals" id="total_goals">
  <input type="number" name="ngoals" value="ngoals">
</form>

<?php

require "data/config.php";

try {
    // Create connection
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT P.firstname, P.lastname FROM Players P WHERE P.total_goals >= " . $_POST["ngoals"];
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br>". $row["firstname"] . " " . $row["lastname"] . "<br>";
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