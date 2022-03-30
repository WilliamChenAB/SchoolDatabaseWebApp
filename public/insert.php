<?php
if (isset($_POST['submit'])) {
  require "../config.php";

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

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['firstname']; ?> successfully added.
<?php } ?>

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