<?php

session_start();
session_destroy();
// unset( $_SESSION['admin_login']); // PAG NAG ERROR UNCOMMENT MO TO


    header('location: ../adminLogin.php');
?>