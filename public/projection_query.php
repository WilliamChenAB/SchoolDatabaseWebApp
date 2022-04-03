<?php require "templates/header.php"; ?>
<h2>PROJECTION</h2><br>
Choose three columns in the Events data set to display.

<form method="post">
  <select name="column1">
    <option value="eid">eID</option>
    <option value="address">Address</option>
    <option value="rnum">Rink_Num</option>
    <option value="date_and_time">Date/Time</option>
    <option value="duration">Duration</option>
  </select>
  <select name="column2">
  <option value="eid">eID</option>
    <option value="address">Address</option>
    <option value="rnum">Rink_Num</option>
    <option value="date_and_time">Date/Time</option>
    <option value="duration">Duration</option>
  </select>
  <select name="column3">
    <option value="eid">eID</option>
    <option value="address">Address</option>
    <option value="rnum">Rink_Num</option>
    <option value="date_and_time">Date/Time</option>
    <option value="duration">Duration</option>
  </select>
  <input type="submit" name="submit" value="View Results">
</form>

<?php

require "data/config.php";

if (isset($_POST['submit'])) {
    try {
        // Create connection
        $connection = new PDO($dsn, $username, $password, $options);

        $col1 = $_POST['column1'];
        $col2 = $_POST['column2'];
        $col3 = $_POST['column3'];
        $sql = "SELECT $col1, $col2, $col3 FROM Events";

        $result = $connection->prepare($sql);
        $result->execute();

        $data = $result->fetchAll();

        if ($data && $result->rowCount() > 0) { ?>
            <h2>Results</h2>
        
            <table>
              <thead>
                <tr>
                  <th> <?php echo $col1; ?> </th>
                  <th> <?php echo $col2; ?> </th>
                  <th> <?php echo $col3; ?> </th>
                </tr>
              </thead>
              <tbody>
          <?php foreach ($data as $row) { ?>
              <tr>
                <td><?php echo $row[$col1]; ?></td>
                <td><?php echo $row[$col2]; ?></td>
                <td><?php echo $row[$col3]; ?></td>
              </tr>
            <?php } ?>
              </tbody>
          </table>
          <?php } else { ?>
            <!-- No results found for <?php //echo $col; ?>. -->
          <?php }

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>

<?php require "templates/footer.php"; ?>