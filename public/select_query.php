<?php require "templates/header.php"; ?>

<form method="post">
  <label for="total_goals">Select players with at least the following number of goals:</label>
  <input type="number" name="ngoals" value="ngoals">
  <input type="submit" name="submit" value="Submit">
</form>

<?php
require "data/config.php";

if (isset($_POST['submit'])) {
    try {
        // Create connection
        $connection = new PDO($dsn, $username, $password, $options);

        $sql = "SELECT * FROM Players WHERE total_goals >= :ngoals";

        $ngoals = $_POST['ngoals'];

        $result = $connection->prepare($sql);
        $result->bindParam(':ngoals', $ngoals, PDO::PARAM_STR);
        $result->execute();

        $data = $result->fetchAll();

        if ($data && $result->rowCount() > 0) { ?>
            <h2>Results</h2>
        
            <table>
              <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthday</th>
                <th>Total_Goals</th>
                <th>Position</th>
                </tr>
              </thead>
              <tbody>
          <?php foreach ($data as $row) { ?>
              <tr>
                <td><?php echo $row["pid"]; ?></td>
                <td><?php echo $row["name"]; ?></td>
                <td><?php echo "birthday"; ?></td>
                <td><?php echo $row["total_goals"]; ?></td>
                <td><?php echo $row["position"]; ?></td>
              </tr>
            <?php } ?>
              </tbody>
          </table>
          <?php } else { ?>
            > No results found for <?php echo $ngoals; ?>.
          
          <?php }

        $connection->close();

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>