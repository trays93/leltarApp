<?php
if (!session_id()) @session_start();
//session tartalmat üriti
session_destroy();
//átirányitás az index.php -re
header('Location: index.php');