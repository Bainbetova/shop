<?php
    session_start();
    // remove the user's id
    unset($_SESSION['user_id']);
?>