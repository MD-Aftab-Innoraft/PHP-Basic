<?php

session_start();

/* Freeing all the session variables.  */
session_unset();

/* Destroying the session. */
session_destroy();

/* Redirecting to the login page. */
header('Location: index.php');
exit();

?>
