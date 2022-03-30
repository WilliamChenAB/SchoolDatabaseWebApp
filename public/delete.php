<?php
if (isset($_POST['submit'])) {
  try {
    require "data/config.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "DELETE *
    FROM Rinks
    WHERE address = :address";

    $address = $_POST['address'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':address', $address, PDO::PARAM_STR);
    $statement->execute();

  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
  try {
    require "data/config.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM Rinks";

    $prep = $connection->prepare($sql);
    $prep->execute();
    $result = $prep->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>
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
  <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo escape($row["address"]); ?></td>
        <td><?php echo escape($row["rnum"]); ?></td>
        <td><?php echo escape($row["rink_standard"]); ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>

<h2>Delete Rink with Address</h2>

<form method="post">
  <label for="address">Address</label>
  <input type="text" id="address" name="laddress">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>