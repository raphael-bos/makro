<?php
namespace Business;
use DataAccess\ProductDataAccess;
use Model\Product;

class ProductBusiness{
    public function getAll(){
        try {
            $products = [];
            foreach( (new ProductDataAccess())->getAll() as $objDataAccess){
                $product = new Product();
                $product->id = $objDataAccess['id'];
                $product->name = $objDataAccess['name'];
                $product->description = $objDataAccess['description'];
                $product->dateOffer = $objDataAccess['dateOffer'];
                $product->price = $objDataAccess['price'];
                $product->unitPrefix = $objDataAccess['unitPrefix'];
                $product->image = $objDataAccess['image'];
                $products[] = $product;
            }
            return $products;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function get($id){
        try {
            $product = new Product();
            $objDataAccess = (new ProductDataAccess())->get($id);
            if ($objDataAccess) {
                $product->id = $objDataAccess[0]['id'];
                $product->name = $objDataAccess[0]['name'];
                $product->description = $objDataAccess[0]['description'];
                $product->dateOffer = $objDataAccess[0]['dateOffer'];
                $product->price = $objDataAccess[0]['price'];
                $product->unitPrefix = $objDataAccess[0]['unitPrefix'];
                $product->image = $objDataAccess[0]['image'];
            }
            return $product;
        } catch (Exception $e) {
            return $e;
        }               
    }

    public function getJson($id){
        try {
            $return = null;
            if( ( isset($id) || $id != "" ) && is_numeric($id) ){
                $return  = $this->json($id);
            } else {
                $return = $this->jsonAll();
            }
            return $return;
        } catch (Exception $e) {
            return $e;
        }
    }

    private function json($id){
        try {            
            $product = $this->get($id);
            return json_encode($product->getJsonData());
        } catch (Exception $e) {
            return $e;
        }
    }

    private function jsonAll(){
        try {
            $jsonList = [];
            $products = $this->getAll();
            foreach( $products as $product){
                $jsonList[] = $product->getJsonData();
            }
            return json_encode($jsonList);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function generatePDFListOffers($log){
        try {
            $serverPath = $_SERVER["DOCUMENT_ROOT"]."/totem/api/pdf/";
            $fileName =  $log->getHashID(). ".pdf";
            $path = $serverPath . $fileName;

            $pdf = new \FPDF();
            $pdf->SetTopMargin(15);
            $pdf->AddPage(); 
            $pdf->SetFillColor(229,226,226);
            $pdf->Rect(0, 0, 210, 297, 'F');
            $products = $this->getAll();
            $count = 1;
            $this->headerPDFListOffers($pdf); 
            $lenghtProducts = count($products);
            foreach( $products as $product){
                $pdf->SetDrawColor(229,226,226);
                $pdf->SetTextColor(0,0,0); 
                $postionY = intval($pdf->GetY()) + 0.50;
                $pdf->Cell(50,7,"","LT",0,'C', true);
                $pdf->SetFont('Arial','B',16);
                $pdf->Cell(140,7,utf8_decode($product->name) . count($products) . $count,"TR",1,'L', true);
                $pdf->Cell(50,7,"","L",0,'C', true);
                $pdf->SetFont('Arial',null,16);
                $pdf->Cell(140,7,utf8_decode($product->description),"R",1,'L', true);
                $pdf->Cell(50,14,"","L",0,'C', true);
                $pdf->Cell(50,14,utf8_decode('Até '. $product->dateOffer),"B",0,'L', true);
                $pdf->SetTextColor(244, 33, 45);
                $pdf->SetFont('Arial','B',16);
                $pdf->Cell(90,7,"$". $product->price,"R",1,'L', true);
                $pdf->Cell(100,7,"","LB",0,'C', false);
                $pdf->Cell(90,7,utf8_decode($product->unitPrefix),"BR",1,'L', true);
                $pdf->SetTextColor(0,0,0);                
                $pdf->Image($product->image,10.5,$postionY,27,0,'JPEG');
                if($count % 8 == 0 && $lenghtProducts != $count){
                    $pdf->SetTopMargin(15);
                    $pdf->AddPage();
                    $pdf->SetFillColor(229,226,226);
                    $pdf->Rect(0, 0, 210, 297, 'F');
                    $this->headerPDFListOffers($pdf);
                }
                $count = $count + 1;
            }            
            $pdf->Output('F', $path);
            return $log;
        } catch (Exception $e) {
            return $e;
        }

    }

    private function headerPDFListOffers($pdf){
        $pdf->SetFillColor(255,255,255);
        $pdf->Rect(0, 0, 210, 14, 'F');
        $pdf->Image($_SERVER["DOCUMENT_ROOT"]."/totem/img/makro_logo.png",10.5,1,40,0,'PNG');
        $pdf->SetTextColor(244, 33, 45);
        $pdf->SetFont('Arial','B',30);
        $pdf->Cell(190,20,utf8_decode('Sus ofertas'),0,1,'L'); 
    }
}
?>
