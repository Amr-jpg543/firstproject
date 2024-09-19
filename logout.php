<?php

//starts the session before unsetting it and destrying it and sends the user back to the index page if they logged out before terminating the program
session_start();
session_unset();
session_destroy();

header("location:index.php");
die();
