<?php

require_once('./config/conn.php');

$sql = "CREATE TABLE trans (
                    id INT(11) PRIMARY KEY AUTO_INCREMENT,
                    item_name VARCHAR(50),
                    amount VARCHAR(50),
                    payment_type VARCHAR(50),
                    customer_name VARCHAR(50),
                    merchant_id INT(11),
                    invoice_id INT(11),
                    reference_id INT(11),
                    status VARCHAR(20)
                    )";

if ($conn->query($sql)) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
