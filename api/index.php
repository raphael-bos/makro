<?php 
require_once 'lib\fpdf\fpdf.php';
require_once 'System\DatabaseConnector.php';
require_once 'DataAccess\ProductDataAccess.php';
require_once 'DataAccess\LogDataAccess.php';
require_once 'Controller\ProductController.php';
require_once 'Controller\LogController.php';
require_once 'Business\ProductBusiness.php';
require_once 'Business\LogBusiness.php';
require_once 'Model\Product.php';
require_once 'Model\Log.php';
use Controller\ProductController;
use Business\LogBusiness;

try{
    $id = isset($_GET['id']) ? $_GET['id'] : null;//int
    echo json_encode( (new ProductController())->generatePDFListOffers($id) );
} catch(\Throwable $e) {
    echo json_encode(array("success" => false ,  "message" => "Failed to process your request.", "Exception" => $e->__toString()));
}
// $productController = new ProductController();
// $result = $productController->getJson(null);
// echo($result);
// echo "<br>---------------------<br>";
// $productController = new ProductController();
// $result = $productController->getJson(46);
// print_r($result);
// echo "<br>---------------------<br>";
// echo (new LogController())->getJson(null);
// echo (new LogController())->getJson(1);
// $p = new Product();
// $p->firstField = 'John';
// $p->secondField = 'Doe';
// echo "<br>";
// echo "<br>";
// echo "<br>";
// var_dump($p);
// echo "<br>";
// echo $p->firstField;
?>