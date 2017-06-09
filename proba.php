<html>
    <head>
        <title>asdf</title>
    </head>
    <body>
        <form method="post" action="proba.php">
            <input type="date" name="date" />
            <input type="submit">
        </form>
        <div>
<?php

if(isset($_POST["date"])) {
    print $_POST["date"];
    $datum = date("Y-m-d");
    print $datum;
}
?>
            
        </div>
    </body>
</html>
