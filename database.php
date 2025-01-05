<?php

class Database{
    private $db_host = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "testing";

    private $conn = false;
    private $mysqli = "";
    private $result = array();

//-------------------------------------------------------------------------------------------------------->
    public function __construct(){
            if(!$this->conn){
                $this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
                $this->conn = true ;
                if($this->mysqli->connect_error){
                    array_push($this->result, $this->mysqli->connect_error);
                    return false;
                }
            }else{
                return true;
            }
    }

//-------------------------------------------------------------------------------------------------------->
    public function insert($table,$param=array()){
        if($this->tableExists($table)){
            print_r($param);

            $table_colums = implode(', ', array_keys($param));
            $table_value = implode("', '", $param);
            
            $sql = " INSERT INTO $table ($table_colums) VALUES ('$table_value') ";
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->insert_id);
                echo "Success Fully insert student data in this id : ";
                return true;
            }else{
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        }else{
            return false;
        }

    }

//-------------------------------------------------------------------------------------------------------->
    public function update($table, $param=array(),$where = null){
        if($this->tableExists($table)){
            $args = array();
            foreach ($param as $key => $value) {
                $args[] = "$key = '$value' ";
            }

            $sql = "UPDATE $table SET  ". implode(', ',$args);
            if($where != null){
                $sql .= " WHERE $where";
            }

            if($this->mysqli->query($sql)){
                 array_push($this->result, $this->mysqli->affected_rows);
                echo "Success Fully Update student data  ";
                return true;
            }else{
                 array_push($this->result, $this->mysqli->error);
            }
        }else{
            return false;
        }
     }
 

//-------------------------------------------------------------------------------------------------------->
    public function delete($table , $where=null){
        if($this->tableExists($table)){
            $sql = " DELETE FROM $table ";
            if($where!=null){
                $sql .= " WHERE $where";
            }
            if($this->mysqli->query($sql)){
                array_push($this->result, $this->mysqli->affected_rows);
                echo "<br> Successfully deleted ";
            }else{
                array_push($this->result, $this->mysqli->error);
            }
        }else{
            return false;
        }
    }

//-------------------------------------------------------------------------------------------------------->
    public function select($table,$rows='*',$join=null,$where=null,$order=null,$limit=null){
            if($this->tableExists($table)){
                $sql = "SELECT $rows FROM $table";
                if($join!=null){
                    $sql .= " JOIN $join";
                }
                if($where!=null){
                    $sql .= " WHERE $where";
                }
                if($order!=null){
                    $sql .= " ORDER BY $order";
                }
                if($limit!=null){
                    $sql .= " LIMIT 0, $limit";
                }
                
                $query = $this->mysqli->query($sql);
                
                echo $sql;
                if($query){
                    array_push($this->result, $query->fetch_all(MYSQLI_ASSOC));
                    echo "<br> fetch data through multiple sql parameters";
                }else{
                    array_push($this->result,$this->mysqli->error);
                    echo "<br> error in multiple sql parameters in select function";
                }

            }
    }

      public function sql($sql){
        $query = $this->mysqli->query($sql);
        if($query){
            array_push($this->result, $query->fetch_all(MYSQLI_ASSOC));
            echo "<br> Show data base on simple sql query";
        }else{
            array_push($this->result, $query->fetch_all(MYSQLI_ASSOC));
            echo " <br> failed simple sql query from sql function";
        }
    }

//-------------------------------------------------------------------------------------------------------->
    private function tableExists($table){
        $sql = "SHOW TABLES FROM $this->db_name LIKE '$table'  ";
        $tableInDb = $this->mysqli->query($sql);
        if($tableInDb){
            if($tableInDb->num_rows == 1){
                return true;
            }else{
                array_push($this->result , "This table (  ".  $table . " ) Does't exits in database !!");
                return false;
            }
        }
    }

//-------------------------------------------------------------------------------------------------------->
    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }

//-------------------------------------------------------------------------------------------------------->
    public function __destruct(){
        if($this->conn){
            if($this->mysqli->close()){
                $this->conn = false;
                return true;
            }
        }else{
            return false;
        }
    }
}


?>