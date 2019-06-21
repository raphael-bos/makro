<?php
namespace Model;

class Log {
    private $id;
    private $receipt;//documento fiscal
    private $printType;//tipo de impressão
    private $opinionType;//tipo de opnião
    private $comment;//comentário
    private $flagReceipt;//Se o cliente não informar o documento fiscal, inserir valor zero no banco
    private $downloadType;//Caso não sido feito download, guardar como zero a informação e 1 para impressão e 2 para qr code
    private $country;//URL da página informando o país
    private $store;//URL da página informando id da loja
    private $startTime;//DataHora que cliente iniciou iteração com o sistema
    private $endTime;//DataHora que cliente iniciou iteração com o sistema
    private $urlPDF;

    function __construct() {
      try{
          $actualUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}/totem/api/pdf/";
          $fileName =  $this->getHashID(). ".pdf";
          $this->urlPDF = $actualUrl . $fileName;
      } catch(\Exception $e){
        return $e;
      }
    }

    public function __get($property) {
      try{
        if (property_exists($this, $property)) {
          return $this->$property;
        }
      } catch(\Exception $e){
        return $e;
      }
    }
  
    public function __set($property, $value) {
      try{
        if (property_exists($this, $property)) {
          $this->$property = $value;
        }  
        return $this;
      } catch(\Exception $e){
        return $e;
      }
    }

    function getJsonData(){        
      try{
        $var = get_object_vars($this);
        foreach ($var as &$value) {
            if (is_object($value) && method_exists($value,'getJsonData')) {
                $value = $value->getJsonData();
            }
        }
        return $var;
      } catch(\Exception $e){
        return $e;
      }
    }
    
    function getHashID(){
      try{
          return md5($this->id . 'totemapp');
      } catch (Exception $e) {
          return($e);  
      }
  }
}
?>