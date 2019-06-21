<?php
namespace Business;
use DataAccess\LogDataAccess;
use Model\Log;

class LogBusiness{
    public function getAll(){
        try {
            $logs = [];
            foreach( (new LogDataAccess())->getAll() as $objDataAccess){
                $log = new Log();
                $log->id = $objDataAccess['id'];
                $log->receipt = $objDataAccess['receipt'];
                $log->printType = $objDataAccess['printType'];
                $log->opinionType = $objDataAccess['opinionType'];
                $log->comment = $objDataAccess['comment'];
                $log->flagReceipt = $objDataAccess['flagReceipt'];
                $log->downloadType = $objDataAccess['downloadType'];
                $log->country = $objDataAccess['country'];
                $log->store = $objDataAccess['store'];
                $log->startTime = $objDataAccess['startTime'];
                $log->endTime = $objDataAccess['endTime'];
                $logs[] = $log;
            }
            return $logs;
        } catch (Exception $e) {
            return($e);  
        }
    }

    public function get($id){
        try {
            $log = new Log();
            $objDataAccess = (new LogDataAccess())->get($id);
            if ($objDataAccess) {
                $log->id = $objDataAccess[0]['id'];
                $log->receipt = $objDataAccess[0]['receipt'];
                $log->printType = $objDataAccess[0]['printType'];
                $log->opinionType = $objDataAccess[0]['opinionType'];
                $log->comment = $objDataAccess[0]['comment'];
                $log->flagReceipt = $objDataAccess[0]['flagReceipt'];
                $log->downloadType = $objDataAccess[0]['downloadType'];
                $log->country = $objDataAccess[0]['country'];
                $log->store = $objDataAccess[0]['store'];
                $log->startTime = $objDataAccess[0]['startTime'];
                $log->endTime = $objDataAccess[0]['endTime'];
            }
            return $log;
        } catch (Exception $e) {
            return($e);  
        }            
    }

    public function update($id, $column, $value){
        try {
            $result = false;
            $oldObject = $this->get($id);
            if ($oldObject->$column != $value){
                $log = $this->get($id);
                $log->$column = $value;
                $newLog = (new LogDataAccess())->update($log);
                $result = $oldObject->$column != $newLog->$column;
            } else {
                $result = true;
            }
            return $result;
        } catch (Exception $e) {
            return($e);  
        } 
    }    

    public function insert($log){   
        try {
            $newLog = (new LogDataAccess())->insert($log);
            return $newLog;
        } catch (Exception $e) {
            return($e);  
        }
    }
}
?>
