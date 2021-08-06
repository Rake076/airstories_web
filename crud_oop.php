<?php
/**
 *
 */
class Database
{
  private $db_host = 'localhost';
  private $db_user = 'root';
  private $db_pass = '';
  private $db_name = 'library';

  private $mysqli = '';
  private $result = array();
  private $conn = false;

  function __construct()
  {
    if(!$this->conn){
      $this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
      $this->conn = true;
      if($this->mysqli->connect_error){
        array_push($this->result,$this->mysqli->connect_error);
        return false;
        }
       }else{
       return true;
     }
   } // __construct function

public function insert($table ,$params=array())
{
if($this->tableExist($table)) {
   $table_coloums = implode(",",array_keys($params));
   $table_values = implode("', '",$params);
    $sql = "insert into $table ($table_coloums) values ('$table_values')";
    if ($this->mysqli->query($sql)) {
      array_push($this->result,$this->mysqli);
      return true;
    } else {
      array_push($this->result,$this->mysqli->error);
      return false;
    }
  }else {
  return false;
 }
} // insert function

public function select($table)
{
  $array = array();
  $sql = "SELECT * FROM ".$table." ";
   $result = $this->mysqli->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
       $array[] = $row;
    }
    return $array;


} // select function

public function select_task($table,$id)
{
  $array = array();
  $sql = "SELECT * FROM '.$table.' WHERE $id='.$id.'  ";
   $result = $this->mysqli->query($sql);
    while ($row = mysqli_fetch_assoc($result)) {
       $array[] = $row;
    }
    return $array;


} // select function




public function delete($id, $table)
   {
       $query = "DELETE FROM $table WHERE id = $id";
       $result = $this->mysqli->query($query);
       if ($result == false) {
           echo 'Error: cannot delete id ' . $id . ' from table ' . $table;
           return false;
       } else {
           return true;
       }
   } // delete one record

   public function delete_table($table)
      {
          $query = "DELETE FROM $table";
          $result = $this->mysqli->query($query);
          if ($result == false) {
              echo 'Error: cannot delete' . $table;
              return false;
          } else {
              return true;
          }
      } // delete whole table


      public function delete_task($t_id,$table)
      {
          $query = "DELETE FROM $table WHERE t_id = $t_id";
          $result = $this->mysqli->query($query);
          if ($result == false) {
              echo 'Error: cannot delete id ' . $t_id . ' from table ' . $table;
              return false;
          } else {
              return true;
          }
      } // delete one record



public function edit($id,$table)
{
  $array = array();
  $sql = "SELECT * FROM $table WHERE id = $id";
   $result = $this->mysqli->query($sql);
   while ($row = mysqli_fetch_assoc($result)) {
      $array[] = $row;
   }
   return $array;
} // getting data from table to form

// getting tasks data
public function edit_task($t_id,$table)
{
  $array = array();
  $sql = "SELECT * FROM $table WHERE t_id = $t_id";
   $result = $this->mysqli->query($sql);
   while ($row = mysqli_fetch_assoc($result)) {
      $array[] = $row;
   }
   return $array;
}

public function update_task($table ,$params=array(),$where = null )
{
  if($this->tableExist($table)) {
    $args = array();
    foreach ($params as $key => $value) {
      $args[] = "$key = '$value'";
    }
   $sql = "UPDATE $table SET ".implode(', ',$args);
   if ($where != null) {
     $sql .= "WHERE $where";
   }
     if ($this->mysqli->query($sql)) {
       array_push($this->result,$this->mysqli->affected_rows);
       return true;
     } else {
       array_push($this->result,$this->mysqli->error);
     }

   }else{
     return false;
   }
}




 // getting data from table to form


public function update($table ,$params=array(),$where = null )
{
  if($this->tableExist($table)) {
    $args = array();
    foreach ($params as $key => $value) {
      $args[] = "$key = '$value'";
    }
   $sql = "UPDATE $table SET ".implode(', ',$args);
   if ($where != null) {
     $sql .= "WHERE $where";
   }
     if ($this->mysqli->query($sql)) {
       array_push($this->result,$this->mysqli->affected_rows);
       return true;
     } else {
       array_push($this->result,$this->mysqli->error);
     }

   }else{
     return false;
   }
}


private function tableExist($table)
{
  $sql = "show tables from $this->db_name like '$table'";
  $tableInDb = $this->mysqli->query($sql);
  if ($tableInDb) {
    if ($tableInDb->num_rows == 1) {
      return true;
    } else {
      array_push($this->result,$table.'does not exist in database');
      return false;
    }
  }
} // tableExist


// count data of complete table
public function count_data($table)
{
  $sql = "SELECT * FROM ".$table." ";
   $result = $this->mysqli->query($sql);
    $count = mysqli_num_rows($result);
    echo $count;
}


// count data of completed_story
public function completed_story($table)
{
  $sql = "SELECT * FROM $table WHERE b_status='completed_story'";
   $result = $this->mysqli->query($sql);
    $count = mysqli_num_rows($result);
    echo $count;
}

// count data of short_story
public function short_story($table)
{
  $sql = "SELECT * FROM $table WHERE b_status='short_story'";
   $result = $this->mysqli->query($sql);
    $count = mysqli_num_rows($result);
    echo $count;
}


// close connection to databsae
public function __destruct()
{
  if($this->conn){
    if($this->mysqli->close()){
      $this->conn = false;
      return true;
     }
    }else {
     return false;
    }
  } // destructor function

} // class database




 ?>
