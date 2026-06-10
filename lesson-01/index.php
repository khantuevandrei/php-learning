<?php

declare(strict_types=1);

echo 'Server time: ' . date("Y-m-d") . ' ' . date('H:i:s') . "\n";
echo 'Client IP: ' . $_SERVER['REMOTE_ADDR'] . "\n";
echo 'Request method: ' . $_SERVER['REQUEST_METHOD'];
