<?php 
require_once 'System\DatabaseConnector.php';
require_once 'DataAccess\LogDataAccess.php';
require_once 'Controller\LogController.php';
require_once 'Business\LogBusiness.php';
require_once 'Model\Log.php';

use Controller\LogController;
use Model\Log;
try{
    $action = isset($_GET['action']) ? $_GET['action'] : null;//string
    $id = isset($_GET['id']) ? $_GET['id'] : null;//int
    $column = isset($_GET['column']) ? $_GET['column'] : null;//string
    $value = isset($_GET['value']) ? $_GET['value'] : null;//string
    $receipt = isset($_GET['receipt']) ? $_GET['receipt'] : null;//string
    $printType = isset($_GET['printType']) ? $_GET['printType'] : null;//string
    $opinionType = isset($_GET['opinionType']) ? $_GET['opinionType'] : null;//string
    $comment = isset($_GET['comment']) ? $_GET['comment'] : null;//string
    $flagReceipt = isset($_GET['flagReceipt']) ? $_GET['flagReceipt'] : null;//int
    $downloadType = isset($_GET['downloadType']) ? $_GET['downloadType'] : null;//string
    $country = isset($_GET['country']) ? $_GET['country'] : null;//string
    $store = isset($_GET['store']) ? $_GET['store'] : null;//string
    $endTime = isset($_GET['endTime']) ? $_GET['endTime'] : null;//DateTime dd/mm/yyyy hh:mm:ss

    switch ($action) {
        case "search":
            echo (new LogController)->search($id);
            break;
        case "update":
            echo (new LogController)->update($id, $column, $value);
            break;
        case "insert":    
            $log = (new Log);
            $log->receipt = $receipt;
            $log->printType = $printType;
            $log->opinionType = $opinionType;
            $log->comment = $comment;
            $log->flagReceipt = $flagReceipt;
            $log->downloadType = $downloadType;
            $log->country = $country;
            $log->store = $store;
            $log->endTime = $endTime;
            echo (new LogController)->insert($log);
            break;
        default:
            echo json_encode(array("success" => false ,  "message" => "Action not found."));
    }    
} catch (Exception $e) {
    echo json_encode(array("success" => false ,  "message" => "Failed to process your request.", "Exception" => $e->__toString()));
}
?>