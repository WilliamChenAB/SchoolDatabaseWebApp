<?php include "templates/header.php"; ?>

<ul>
    <li> <a href="data/init.php"><strong>Initialize Database</strong></a></li>
</ul> <ul>
    <li> <a href="insert.php"><strong>Insert</strong></a> - add a player </li>
    <li> <a href="delete.php"><strong>Delete</strong></a> - delete a rink </li>
    <li> <a href="update.php"><strong>Update</strong></a> - rename a team with chosen ID </li>
</ul> <ul>
    <li> <a href="select_query.php"><strong>Select</strong></a> - select players with at least <i>n</i> goals </li>
    <li> <a href="projection_query.php"><strong>Projection</strong></a> - project a chosen column of the Venues data set </li>
    <li> <a href="join_query.php"><strong>Join</strong></a> - find the size of rinks </li>
    <li> <a href="aggregation.php"><strong>Aggregation</strong></a> - find the salaried player with the lowest salary </li>
    <li> <a href="nested_aggregation.php"><strong>Nested Aggregation</strong></a> - find the average goals per player's position </li>
    <li> <a href="division_query.php"><strong>Division</strong></a> - find the names of sponsors who donate at least <i>n</i> to all teams </li>
</ul>

</body>
</html>
