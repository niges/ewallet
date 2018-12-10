<?php 

class Database {

	private $user = "root";
	private $password = "";
	private $host = "localhost";
	private $database = "apiassignment";
	public $connection;
	public static $instance;

	public function __construct() {

		if (!isset($this->connection)) {
			$this->connection = new mysqli($this->host,$this->user,$this->password,$this->database);
			if (!$this->connection) {
				echo "Error Establishing connection".mysqli_error();
			}
			return $this->connection;
		}
	}

	public static function getInstance() {
		if(!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function insert($table,$data) {

		$condition = "";
		foreach ($data as $key => $value) {
			$condition .= $key . '=' . "'$value'" . ',';
		}

		$condition =rtrim($condition,',');

		$sql = "INSERT INTO ". $table . " SET " . $condition;

		$result = mysqli_query($this->connection,$sql);
		return $result;
	}

	// public function select($table,$data) {

	// 	$sql = "SELECT * FROM ". $table . " WHERE email=" . "'$data'";
	// 	$result = mysqli_query($this->connection,$sql);
	// 	return $result;

	// }

	public function select($data,$criteria,$tableName){
       if( is_array( $data ) && count( $data ) > 0 ){
           $sql="SELECT ";
           foreach ($data as $value) {
               $sql .=$value . ',';
           }
           $sql= rtrim( $sql,',');
           $sql.=' FROM '. $tableName;
           if (!empty($criteria)) {
                $sql.=' WHERE ';
               foreach ($criteria as $key => $value) {
                   $sql .=$key.'="' .$value. '" AND ';
               }
               $sql = substr($sql,0,-4);
           }
           $result= mysqli_query($this->connection,$sql);
           // $fetch = $this->rows_show($result);

           return $result;

       }
       return false;
    }

    // public function update($data,$table,$email) {
    // 	$condition = '';
    // 	foreach ($data as $key => $value) {
  		// 	$condition .= $key . '=' . "'$value'";
    // 	}
    // 	$sql = "UPDATE " . $table . " SET " . $condition . " WHERE email='$email'";
    // 	$query = mysqli_query($this->connection,$sql);
    // 	return $query;
    // }

	public function update($tableName="",$data="",$criteria=""){
       if( is_array( $data ) && count( $data ) > 0 ){
           $sql = 'UPDATE ' . $tableName. ' SET ';

           foreach ($data as $field => $value){
               $sql .=$field .'="'.$value . '",';
           }
           $sql = rtrim( $sql,',');

           $sql .=' WHERE ';

           foreach ($criteria as $field => $value){
               $sql .=$field .'="'.$value . '"AND';
           }
           $sql = rtrim( $sql,'AND');
           $result = mysqli_query($this->connection,$sql);
           return $result;
       }
       return false;
   }

   public function delete($table,$data) {
   		if( is_array( $data ) && count( $data ) > 0 ){
   			$condition = '';
   			foreach ($data as $key => $value) {
   				$condition .= $key . '=' . $value;
   			}
   			$sql = "DELETE FROM ". $table . " WHERE " . $condition;
   			$query = mysqli_query($this->connection,$sql);
   			return $query;
   		}
   }

    public function deleteCategory($table,$data) {
    if( is_array( $data ) && count( $data ) > 0 ){
      $condition = '';
      foreach ($data as $key => $value) {
        $condition .= $key . '=' . $value;
      }
      // $sql = "DELETE FROM ". $table . " WHERE " . $condition;

      $sql = "DELETE category,data FROM category INNER JOIN data ON data.category_id = category.id WHERE category.".$condition;
      $query = mysqli_query($this->connection,$sql);
      return $query;
    }
   }

   public function fetch($data) {
   		$rows = [];
   		while ($row = mysqli_fetch_assoc($data)) {
   			$rows[] = $row;
   		}
   		return $rows;
   }

}
$database = new Database();


