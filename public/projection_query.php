<?php require "templates/header.php"; ?>

<form method="post">
  <label for="column">Column</label>
  <select name="column">
    <option value="address">Address</option>
    <option value="name">Name</option>
    <option value="capacity">Capacity</option>
    <option value="city">City</option>
  </select>
  <input type="submit" name="submit" value="View Results">
</form>

<?php

require "data/config.php";

function TestInsertRow ($str) {
    echo '<th>';
    echo $str;
    echo '</th>';
}

if (isset($_POST['submit'])) {
    try {
        // Create connection
        $connection = new PDO($dsn, $username, $password, $options);

        $col = $_POST['column'];
        $sql = "SELECT $col FROM Venues";

        $result = $connection->prepare($sql);
        $result->execute();

        $data = $result->fetchAll();

        if ($data && $result->rowCount() > 0) { ?>
            <h2>Results</h2>
        
            <table>
              <thead>
                <tr><th> <?php echo $col; ?> </th></tr>
              </thead>
              <tbody>
          <?php foreach ($data as $row) { ?>
              <tr>
                <td><?php echo $row[$col]; ?></td>
              </tr>
            <?php } ?>
              </tbody>
          </table>
          <?php } else { ?>
            No results found for <?php echo $col; ?>.
          <?php }

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/footer.php"; ?>