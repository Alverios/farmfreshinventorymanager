<?php

if ($_POST["export"]) {
    $connect = mysqli_connect("localhost", "root", "", "store");  
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=product.csv');
    $output = fopen("php://output", "w");
    fputcsv($output, array('product ID','Product Name', 'Product Image','Brand ID', 'Category ID','Quantity', 'Rate', 'Active','Status'));
    $query = "SELECT * FROM product";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);

}
