<?php
namespace Controller;
use Business\LogBusiness;

class LogController { 
    public function search($id){
        try {
            $return = null;
            if( ( isset($id) || $id != "" ) && is_numeric($id) ){
                $return  = $this->getJson($id);
            } else {
                $return = $this->getJsonAll();
            }
            return $return;
        } catch (Exception $e) {
            return($e);  
        }
    }

    private function getJson($id){
        try {            
            $log = (new LogBusiness())->get($id);
            return json_encode($log->getJsonData());
        } catch (Exception $e) {
            return($e);  
        }
    }

    private function getJsonAll(){
        try {
            $jsonList = [];
            $logs = (new LogBusiness())->getAll();
            foreach( $logs as $log){
                $jsonList[] = $log->getJsonData();
            }
            return json_encode($jsonList);
        } catch (Exception $e) {
            return($e);  
        }
    }

    public function update($id, $column, $value){
        try {
            $updateDone = false;
            $result = array(
                            'success' => false,
                            'message' => 'Failed to update.'
                            );

            if($id != null || $column != null || $value != null){
                $updateDone = (new LogBusiness)->update($id, $column, $value);
            }
            if ($updateDone) {
                $result['success'] = true;
                $result['message'] = 'Updated successfully.';
            }
            return json_encode($result);
        } catch (Exception $e) {
            return($e);  
        }
    }

    public function insert($log){
        try{
            $result = array(
                            'success' => false,
                            'message' => 'Failed to insert.'
                            );                            
            $newLog = (new LogBusiness)->insert($log);
            if (!is_null($newLog)){
                if($newLog->id != 0){
                    $result = array(
                                    'success' => true,
                                    'message' => 'Inserted successfully.',
                                    'log' => $newLog->getJsonData()
                                    );
                }
            }
            return json_encode($result);
        } catch (Exception $e) {
            return($e);  
        }
    }
}