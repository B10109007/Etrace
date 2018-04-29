<?php
// Check for a cookie, if none go to login page
if (!isset($_SESSION['UserName']))
{
    $URL = 'http://'.$_SERVER['HTTP_HOST'];
    header("Location:".$URL);
}
?>