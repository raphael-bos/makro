<?php
require_once 'lib\fpdf\fpdf.php';
require_once 'System\DatabaseConnector.php';
require_once 'DataAccess\ProductDataAccess.php';
require_once 'DataAccess\LogDataAccess.php';
require_once 'Controller\ProductController.php';
require_once 'Business\ProductBusiness.php';
require_once 'Business\LogBusiness.php';
require_once 'Model\Product.php';
require_once 'Model\Log.php';
use Controller\ProductController;
use Business\LogBusiness;
try{
    $action = isset($_GET['action']) ? $_GET['action'] : null;//string
    $id = isset($_GET['id']) ? $_GET['id'] : null;//int
    $idLog = isset($_GET['idLog']) ? $_GET['idLog'] : null;//int
    
    switch ($action) {
        case "search":
            echo (new ProductController())->search($id);
            break;
        case "generatepdf":        
            $log = (new LogBusiness())->get($idLog);
            echo json_encode( (new ProductController())->generatePDFListOffers($log) );
            break;
        default:
            echo json_encode(array("success" => false ,  "message" => "Action not found."));
    }    
} catch (Exception $e) {
    echo json_encode(array("success" => false ,  "message" => "Failed to process your request.", "Exception" => $e->__toString()));
}
?>