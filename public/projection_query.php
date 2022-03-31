<?php require "templates/header.php"; ?>

<form method="post">
  <label for="column">Column</label>
  <input type="text" name="column" value="column">
  <input type="submit" name="submit" value="Submit">
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

        $sql = "SELECT :column FROM Venues";
        $col = $_POST['column'];

        $result = $connection->prepare($sql);
        $result->bindParam(':column', $col, PDO::PARAM_STR);
        $result->execute();

        $data = $result->fetchAll();

        echo $col;

        if ($data && $result->rowCount() > 0) { ?>
            <h2>Results</h2>
        
            <table>
              <thead>
                <tr>
                <?php TestInsertRow($col); ?>
                </tr>
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
            > No results found for <?php echo $col; ?>.
          
          <?php }

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/footer.php"; ?>