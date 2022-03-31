<?php
require "data/config.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_player = array(
      "pid"          => $_POST['pid'],
      "name"         => $_POST['name'],
      "birthday"     => $_POST['birthday'],
      "total_goals"  => $_POST['total_goals'],
      "position"     => $_POST['position']
    );

    $sql = sprintf(
        "INSERT INTO Players (%s) values (%s)",
        implode(", ", array_keys($new_player)),
        ":" . implode(", :", array_keys($new_player))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_player);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>
    <h2>Extant Players</h2>

    <table>
      <thead>
        <tr>
        <th>Player Id</th>
        <th>Name</th>
        <th>Birthday</th>
        <th>Total Goals</th>
        <th>Position</th>
        </tr>
      </thead>
      <tbody>
  <?php
  try {
  
    $connection = new PDO($dsn, $username, $password, $options);
    $sql2 = "SELECT * FROM Players";
  
    $prep = $connection->prepare($sql2);
    $prep->execute();
    $result = $prep->fetchAll();
  } catch(PDOException $error) {
    echo "<br>" . $error->getMessage();
  }

  foreach ($result as $row) { ?>
      <tr>
        <td><?php echo $row["pid"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["birthday"]; ?></td>
        <td><?php echo $row["total_goals"]; ?></td>
        <td><?php echo $row["position"]; ?></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
<h2>Add a player</h2>

<form method="post">
  <label for="pid">Player Id</label>
  <input type="number" name="pid" id="pid">
  <label for="name">Name</label>
  <input type="text" name="name" id="name">
  <label for="birthday">Birthday</label>
  <input type="text" name="birthday" id="birthday">
  <label for="total_goals">Total Goals</label>
  <input type="text" name="total_goals" id="total_goals">
  <label for="position">Position</label>
  <input type="text" name="position" id="position">
  <input type="submit" name="submit" value="Submit">
</form>

<?php require "templates/footer.php"; ?>