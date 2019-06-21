<?php
namespace Controller;
use Business\ProductBusiness;

class ProductController {
    public function search($id){
        try {
            return (new ProductBusiness())->getJson($id);
        } catch (Exception $e) {
            return $e;
        }               
    }

    public function generatePDFListOffers($log){
        try {
            $result = array(
                "success" => false,
                'message' => 'Failed to create PDF.'
            );
            if (!empty($log)){
                $log = (new ProductBusiness())->generatePDFListOffers($log);
                if (isset($log)){
                    $result = array(
                        "success" => true,
                        'message' => 'Created successfully.',
                        "log" => $log->getJsonData()
                    );
                }
            }
            return $result;
        } catch (Exception $e) {
            return $e;
        }               
    }
}