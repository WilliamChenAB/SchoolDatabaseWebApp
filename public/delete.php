<?php
require "data/config.php";

if (isset($_POST['submit'])) {

  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "DELETE FROM Rinks WHERE address =  '" . $_POST['address'] ."'";

    $statement = $connection->prepare($sql);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
    <h2>Avaliable Rinks To DELETE</h2>

    <table>
      <thead>
        <tr>
        <th>Address</th>
        <th>#</th>
        <th>Standard</th>
        </tr>
      </thead>
      <tbody>
  <?php
  try {
  
    $connection = new PDO($dsn, $username, $password, $options);
    $sql2 = "SELECT * FROM Rinks";
  
    $prep = $connection->prepare($sql2);
    $prep->execute();
    $result = $prep->fetchAll();
  } catch(PDOException $error) {
    echo "<br>" . $error->getMessage();
  }

  foreach ($result as $row) { ?>
      <tr>
        <td><?php echo $row["address"]; ?></td>
        <td><?php echo $row["rnum"]; ?></td>
        <td><?php echo $row["rink_standard"]; ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>

<h2>Delete Rink with Address</h2>

<form method="post">
  <label for="address">Address</label>
  <input type="text" id="address" name="address">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>