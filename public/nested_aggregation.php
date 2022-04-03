<?php require "templates/header.php"; ?>
<h2>NESTED AGGREGATION</h2><br>

<?php require "data/config.php";

if (isset($_POST['submit'])) {

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT position, AVG(total_goals) FROM Players WHERE total_goals >= :min GROUP BY position";

    $min = $_POST['min'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':min', $min, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetchAll();
} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}?>

    <h2>Results:</h2>

    <table>
      <thead>
        <tr>
        <th>Position</th>
        <th>Average Goals</th>
        </tr>
      </thead>
      <tbody>

    <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo $row["position"]; ?></td>
        <td><?php echo $row["AVG(total_goals)"]; ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
<?php } ?>

<h2>View average goals per position, where considered players have at least Min goals</h2>

<form method="post">
  <label for="min">Min</label>
  <input type="number" id="min" name="min">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>