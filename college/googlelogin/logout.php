<?php
include('config.php');
// reset Oauth access token
$google_client->revokeToken();

// Destroy entire session date
session_destroy();
// redirect page to index.php

header('Location:signin.php');

?>