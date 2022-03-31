<?php
require "templates/header.php";
require "data/config.php";

if (isset($_POST['submit'])) {

try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT position, AVG(total_goals) FROM Players GROUP BY position";

    $statement = $connection->prepare($sql);
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

<h2>View average goals per position</h2>

<form method="post">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>