<?php
session_start();

$output = [
    'user' => NULL,
    'msg' => 'get authentication first.',
    'type' => 'error'
];

if (!isset($_SESSION['xyz_user']) || !isset($_SESSION['xyz_user']['id'])) {
    // TODO: get authentication first.
    echo json_encode($output);
    return;
} else {
    $output['user'] = $_SESSION['xyz_user'];
    unset($output['user']['id']);
    echo json_encode($output);
    return;
}
