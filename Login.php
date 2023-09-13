<?php

$id = "";
$fname = "";
$lname = "";

?>

<html>
    <head>
        <title>Search and retrieve data</title>
        <meta charset="utf-8">
        <meta name="viewport" content="witdh=device=witdh, initial-scale=1.0">
    </head>
    <body>
        <form action="start.php" method="post">
            ID to search: <input type="text" name="id"><br><br>
            First Name: <input type="text" name="fname"><br><br>
            Last Name: <input type="text" name="lname"><br><br>
            <input type="submit" name="Find" value="Find Data">
        </form>
    </body>
</html>