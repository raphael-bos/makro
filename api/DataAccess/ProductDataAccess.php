<?php
namespace DataAccess;
use System\DatabaseConnector;

class ProductDataAccess {
    private $db = null;

    public function __construct(){
        $this->db = (new DatabaseConnector())->getConnection();
    }

    public function getAll(){
        try {
            $sql = "select autoid as id, productname as name, 'description' as description, '01/01/1900' as dateOffer, 0.00 as price, 'unid.' as unitPrefix, 'https://pbs.twimg.com/profile_images/425274582581264384/X3QXBN8C.jpeg' as image from products;";
            $statement = $this->db->query($sql);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public function get($id){
        try {
            $sql = "select autoid as id, productname as name, 'description' as description, '01/01/1900' as dateOffer, 0.00 as price, 'unid.' as unitPrefix, 'https://pbs.twimg.com/profile_images/425274582581264384/X3QXBN8C.jpeg' as image from products where autoid = :id;";
            $statement = $this->db->prepare($sql);
            $statement->execute(array(':id' => $id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            return $e;
        }    
    }
}