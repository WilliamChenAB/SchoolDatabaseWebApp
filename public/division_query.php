<!-- Get a list of sponsor names who sponsor all teams with donation >= $N$ -->

<?php require "templates/header.php"; ?>
<h2>DIVISION</h2><br>

<?php

require "data/config.php";

function sponsorsTable ($result, $tableName) {
    $data = $result->fetchAll();
    if ($data && $result->rowCount() > 0) { ?>
        <h2><?php echo $tableName; ?></h2>
    
        <table>
          <thead>
            <tr>
            <th>Name</th>
            </tr>
          </thead>
          <tbody>
      <?php foreach ($data as $row) { ?>
          <tr>
            <td><?php echo $row["name"]; ?></td>
          </tr>
        <?php } ?>
          </tbody>
      </table>
      <?php } else { ?>
        No results found!
      <?php }
}

if (isset($_POST['submit'])) {
    try {
        // Create connection
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT name FROM Sponsors S WHERE NOT EXISTS (SELECT T.tid FROM Teams T WHERE NOT EXISTS (SELECT R.tid FROM Sponsorships R WHERE R.tid = T.tid AND R.sid = S.sid AND R.donation >= :amt))";

        $amt = $_POST['donation'];

        $result = $connection->prepare($sql);
        $result->bindParam(':amt', $amt, PDO::PARAM_INT);
        $result->execute();

        sponsorsTable ($result, "Result:");

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<h2>Find the names of all sponsors who donated $N or more to all teams:</h2>

<form method="post">
  <label for="donation">Donation Amount ($)</label>
  <input type="number" name="donation" value="donation">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>