<?php

return function (): void {

    $data = require_once '_config/app.php';

    header('Content-Type: application/json');
    echo json_encode($data);

};
