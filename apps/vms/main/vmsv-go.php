<?php

ini_set('session.cookie_domain', '.volunteer.ensonyan.com');
$_SESSION['entry_name'] = $vmsusername;
$token = 'FoqXwKt0T59jDXrP';
?>
<form action="show.php" method="post">
        <input type="text" name="<?php echo "$vmsusername"; ?>"><br>
        <input type="text" name="myName"><br>
    <input type="submit" name="submit" value="Submit">
</form>