<?php

require_once 'boot.php';

cerrarSesion();
die (json_encode(['error'=>'login_required']));