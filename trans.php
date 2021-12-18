<?php

require_once "method.php";
$tr = new Trans();
$request_method = $_SERVER['REQUEST_METHOD'];
switch ($request_method) {
    case 'GET':
        if (!empty($_GET['reference_id']) && !empty($_GET['merchant_id'])) {
            $tr->get_transs();
        } else {
            $tr->get_trans();
        }
        break;
    case 'POST':
        $tr->insert_trans();
        break;
    default:
        header('Method Not Allowed');
        break;
}
