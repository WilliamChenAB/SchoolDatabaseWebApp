<!-- Join teams and venues (both have cities in common?)-->
<?php

require "templates/header.php";
require "data/config.php";

function rinksTable ($result, $tableName, $extraDetail) {
    $data = $result->fetchAll();
    if ($data && $result->rowCount() > 0) { ?>
        <h2><?php echo $tableName; ?></h2>
    
        <table>
          <thead>
            <tr>
            <th>Address</th>
            <th>RNum</th>
            <th>City</th>
            <th>Rink Standard</th>
            <th>Rink Width</th>
            <th>Rink Length</th>
            </tr>
          </thead>
          <tbody>
      <?php foreach ($data as $row) { ?>
          <tr>
            <td><?php echo $row["address"]; ?></td>
            <td><?php echo $row["rnum"]; ?></td>
            <td><?php echo $row["city"]; ?></td>
            <?php if($extraDetail) { ?>
            <td><?php echo $row["rink_standard"]; ?></td>
            <td><?php echo $row["rink_width"]; ?></td>
            <td><?php echo $row["rink_length"]; ?></td>
            <?php } ?>
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

        $sql = "SELECT * FROM Rinks R, Rink_sizes S WHERE R.rink_standard = S.rink_standard AND R.address = :address";

        $address = $_POST['address'];

        $result = $connection->prepare($sql);
        $result->bindParam(':address', $address, PDO::PARAM_STR);
        $result->execute();

        rinksTable ($result, "Result:", true);

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php
  try {
  
    $connection = new PDO($dsn, $username, $password, $options);
    $sql2 = "SELECT * FROM Rinks";
  
    $result = $connection->prepare($sql2);
    $result->execute();

    rinksTable ($result, "Existing Rinks:", false);
  } catch(PDOException $error) {
    echo "<br>" . $error->getMessage();
  }
?>

<h2>Find rink dimensions for rinks with address:</h2>

<form method="post">
  <label for="address">Address</label>
  <input type="text" id="address" name="address">
  <input type="submit" name="submit" value="View Results">
</form>

<?php require "templates/footer.php"; ?>
