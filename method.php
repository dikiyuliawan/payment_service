<?php

require_once('./config/conn.php');

class Trans
{
    public function get_trans()
    {
        global $conn;
        $data = [];
        $query = mysqli_query($conn, "SELECT * FROM trans");
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        $response = [
            'status' => true,
            'message' => 'Get list transactions succesfully',
            'data' => $data
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function get_transs()
    {
        global $conn;
        $data = [];
        $reference_id = $_GET['reference_id'];
        $merchant_id = $_GET['merchant_id'];

        $query = mysqli_query($conn, "SELECT * FROM trans WHERE reference_id = $reference_id AND merchant_id = $merchant_id");
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        $response = [
            'reference_id' => $data[0]['reference_id'],
            'invoice_id' => $data[0]['invoice_id'],
            'status' => $data[0]['status']
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function insert_trans()
    {
        global $conn;
        $item_name = $_POST['item_name'];
        $amount = $_POST['amount'];
        $payment_type = $_POST['payment_type'];
        $customer_name = $_POST['customer_name'];
        $merchant_id = $_POST['merchant_id'];
        $invoice_id = $_POST['invoice_id'];
        $reference_id = mt_rand(10, 1000);

        if ($payment_type == 'virtual_account') {
            $va = mt_rand(100000, 99999999);
        } else {
            $va = '-';
        }

        $query = mysqli_query($conn, "INSERT INTO payment_service SET item_name = '$item_name', amount = '$amount', payment_type = '$payment_type', customer_name = '$customer_name', merchant_id = '$merchant_id', reference_id = '$reference_id', invoice_id = '$invoice_id', status = 'Pending'");
        if ($query) {
            $response = [
                'reference_id' => $reference_id,
                'number_va' => $va,
                'status' => 'Pending'
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Failed to add transaction'
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
