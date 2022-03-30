<?php
if (isset($_POST['submit'])) {
  require "../config.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_player = array(
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age'],
      "location"  => $_POST['location']
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

<h2>Add a user</h2>

<form method="post">
  <label for="firstname">First Name</label>
  <input type="text" name="firstname" id="firstname">
  <label for="lastname">Last Name</label>
  <input type="text" name="lastname" id="lastname">
  <label for="email">Email Address</label>
  <input type="text" name="email" id="email">
  <label for="age">Age</label>
  <input type="text" name="age" id="age">
  <label for="location">Location</label>
  <input type="text" name="location" id="location">
  <input type="submit" name="submit" value="Submit">
</form>

<?php require "templates/footer.php"; ?>