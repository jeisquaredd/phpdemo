<?php
require_once('classes/database.php');

$con = new database();
try {
    $connection = $con->opencon();
    if ($connection) {
        $query = $connection->prepare("SELECT DATE_FORMAT(transaction_timestamp, '%Y-%m-%d') AS transaction_date, SUM(sale_amount) AS total_sales FROM sales_transactions GROUP BY DATE_FORMAT(transaction_timestamp, '%Y-%m-%d') ORDER BY transaction_date");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $data = [];
        foreach ($results as $row) {
            $data[] = [$row['transaction_date'], (float)$row['total_sales']];
        }

        echo json_encode(['sales_data' => $data]);
    } else {
        echo json_encode(['error' => 'Database connection failed.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
