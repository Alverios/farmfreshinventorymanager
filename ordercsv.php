<?php

if ($_POST["export"]) {
    $connect = mysqli_connect("localhost", "root", "", "store");  
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=orders.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('Order Date', 'Client Name','Client Contact', 'Total Amount','Payment Status'));
    $query = "SELECT order_date,client_name,client_contact,total_amount,payment_status FROM orders";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);

}
