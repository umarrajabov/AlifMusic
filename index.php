<?php

ini_set('session.cookie_lifetime', 86400);
ini_set('session.gc_maxlifetime', 86400);
session_start();

require_once __DIR__."/vendor/autoload.php";

use core\Application;

Application::run(); 
