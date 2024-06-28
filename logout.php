<?php
require_once './utils/init.php';
session_destroy();
header('Location: ./index.php');
exit;
