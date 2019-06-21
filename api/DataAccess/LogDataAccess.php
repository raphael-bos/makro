<?php
namespace DataAccess;
use System\DatabaseConnector;

class LogDataAccess {
    private $db = null;

    public function __construct(){
        $this->db = (new DatabaseConnector())->getConnection();
    }

    public function getAll(){
        try {
            $sql = "SELECT id, receipt, printType, opinionType, comment, flagReceipt, downloadType, country, store, startTime, endTime FROM log_totem_offers;";
            $statement = $this->db->query($sql);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->db->rollback();
            return($e);  
        }
    }

    public function get($id){
        try {
            $sql = "SELECT id, receipt, printType, opinionType, comment, flagReceipt, downloadType, country, store, startTime, endTime FROM log_totem_offers where id = :id;";
            $statement = $this->db->prepare($sql);
            $statement->execute(array(':id' => $id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            $this->db->rollback();
            return($e);  
        }
    }

    public function update($log){
        try {
            $sql = "UPDATE log_totem_offers SET receipt = :receipt, printType = :printType, opinionType = :opinionType, comment = :comment, flagReceipt = :flagReceipt, downloadType = :downloadType, country = :country, store = :store, startTime = :startTime , endTime = :endTime WHERE id = :id;";
            $statement = $this->db->prepare($sql);
            $statement->execute(
                    array(
                        ':receipt' => $log->receipt,
                        ':printType' => $log->printType,
                        ':opinionType' => $log->opinionType,
                        ':comment' => $log->comment,
                        ':flagReceipt' => $log->flagReceipt,
                        ':downloadType' => $log->downloadType,
                        ':country' => $log->country,
                        ':store' => $log->store,
                        ':startTime' => $log->startTime,
                        ':endTime' => $log->endTime,
                        ':id' => $log->id
                    )
                );
            return $log;
        } catch (Exception $e) {
            $this->db->rollback();
            return($e);  
        }
    }

    public function insert($log){
        try {
            $sql = "INSERT INTO log_totem_offers (receipt, printType, opinionType, comment, flagReceipt, downloadType, country, store, startTime, endTime) VALUES(:receipt, :printType, :opinionType, :comment, :flagReceipt, :downloadType, :country, :store, now(), :endTime);";
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':receipt', $log->receipt);
            $statement->bindValue(':printType', $log->printType);
            $statement->bindValue(':opinionType', $log->opinionType);
            $statement->bindValue(':comment', $log->comment);
            $statement->bindValue(':flagReceipt', $log->flagReceipt);
            $statement->bindValue(':downloadType', $log->downloadType);
            $statement->bindValue(':country', $log->country);
            $statement->bindValue(':store', $log->store);
            $statement->bindValue(':endTime', (new \DateTime($log->endTime))->format('Y-m-d H:i:s'));
            $statement->execute();
            $log->id = $this->db->lastInsertId(); 
            return $log;
        } catch (Exception $e) {
            $this->db->rollback();
            return($e);  
        }
    }
}