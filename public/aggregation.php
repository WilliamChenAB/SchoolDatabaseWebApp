<?php require "templates/header.php"; ?>
<h2>AGGREGATION</h2><br>

<?php require "data/config.php";

if (isset($_POST['submit'])) {

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT P.name, W.salary, T.name AS tname
            FROM Players P, Plays_With W, Teams T
            WHERE P.pid = W.pid
            AND W.tid = :ntid
            AND T.tid = W.tid
            AND W.salary = (SELECT MIN(salary) FROM Plays_With WHERE tid = :ntid)";

    $tid = $_POST['tid'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':ntid', $tid, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

if ($result) {
?>
    <h2>Result:</h2>

    <ul>
        <li>Player Name: <?php echo $result["name"]; ?></li>
        <li>Salary: <?php echo $result["salary"]; ?></li>
        <li>Team Name: <?php echo $result["tname"]; ?></li>
    </ul>

<?php 

} else  {
    echo "No results!" ;
}

} ?>

<h2>Find the salaried player with the lowest salary from the given team</h2>

<form method="post">
  <label for="tid">Team ID</label>
  <input type="number" id="tid" name="tid">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>