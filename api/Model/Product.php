<?php
namespace Model;

class Product {
    private $id;
    private $name;
    private $description;
    private $dateOffer;
    private $price;
    private $unitPrefix;
    private $image;
  
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
}
?>