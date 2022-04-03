<?php
require "data/config.php";

if (isset($_POST['submit'])) {

  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "UPDATE Teams SET name = :tname WHERE tid = :tnum";

    $name = $_POST['name'];
    $id = $_POST['id'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':tname', $name, PDO::PARAM_STR);
    $statement->bindParam(':tnum', $id, PDO::PARAM_INT);
    $statement->execute();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>
    <h2>UPDATE</h2><br>
    <h2>Teams:</h2>

    <table>
      <thead>
        <tr>
        <th>tid</th>
        <th>Name</th>
        <th>Wins</th>
        <th>Losses</th>
        <th>City</th>
        </tr>
      </thead>
      <tbody>
  <?php
  try {
  
    $connection = new PDO($dsn, $username, $password, $options);
    $sql2 = "SELECT * FROM Teams";
  
    $prep = $connection->prepare($sql2);
    $prep->execute();
    $result = $prep->fetchAll();
  } catch(PDOException $error) {
    echo "<br>" . $error->getMessage();
  }

  foreach ($result as $row) { ?>
      <tr>
        <td><?php echo $row["tid"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["num_wins"]; ?></td>
        <td><?php echo $row["num_losses"]; ?></td>
        <td><?php echo $row["city"]; ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>

<h2>Rename a Team</h2>

<form method="post">
  <label for="ID">tid</label>
  <input type="number" id="id" name="id">
  <label for="Name">Name</label>
  <input type="text" id="name" name="name">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>