<?php 

include_once('JWT.php');
include_once('Wrapper.php');
include_once('Database.php');

Class Category extends Wrapper {

	public $table = "category";

	public function __construct() {

		$this->db= Database::getInstance();

		$this->register_route( 'addCategory', array(
			'method' => 'post',
			'callback' => array($this ,'addCategory')
		));

		$this->register_route( 'edit', array(
		'method' => 'put',
		'callback' => array($this ,'editCategory')
		));

		$this->register_route( 'delete', array(
		'method' => 'delete',
		'callback' => array($this ,'deleteCategory')
		));


		$this->register_route( 'users', array(
		'method' => 'get',
		'callback' => array($this ,'showCategory')
		));

		$this->register_route( 'title', array(
		'method' => 'get',
		'callback' => array($this ,'getTitle')
		));

		parent::__construct();
	}

	public function addCategory() {
		$decode = json_decode(file_get_contents('php://input'),true);
		$user_id = $decode['user_id'];
		$title   = $decode['title'];

		if (!empty($user_id) && !empty($title)) {

			$data = array(
					'user_id' => $user_id,
					'title'   => $title
					);
			if($this->db->insert($this->table,$data)){

				$this->userResponse('Data Inserted',200,$data);
			} else {
				$this->userResponse('Data Not Inserted',200,$response="");
			}
		} else {
			$this->userResponse('Empty Data',200,$response="");
		}
	}

	public function editCategory() {
		$decode = json_decode(file_get_contents('php://input'),true);
		$id = $_GET['id'];
		$title   = $decode['title'];

		if (!empty($id) && !empty($title)) {

			$data = array(
					'title'   => $title
					);

			$id =   array(
					'id'     =>$id
					);
			if($this->db->update($this->table,$data,$id)){
											 
				$this->userResponse('Data Updated',200,$data);
			} else {
				$this->userResponse('Data Not updated',200,$response="");
			}
		} else {
			$this->userResponse('Empty Data',200,$response="");
		}
	}

	public function deleteCategory() {
		// $decode = json_decode(file_get_contents('php://input'),true);
		// $id = $decode['id'];

		$id = $_GET['id'];

		if (!empty($id)) {

			$data = array(
					'id'   => $id
					);

			if($this->db->deleteCategory($this->table,$data)){						 
				$this->userResponse('Data Deleted',200,$data);
			} else {
				$this->userResponse('Data Not Deleted',200,$response="");
			}
		} else {
			$this->userResponse('Error',200,$response="");
		}
	}

	public function showCategory() {
		
		$user_id = $_GET['id'];
		$new = array('id','title');
		$data = array( 'user_id'=>$user_id );
		if (!empty($user_id)) {
			$category = $this->db->select($new,$data,$this->table);
			if ($category) {
				$response = $this->db->fetch($category);
				$this->userResponse('Categories',200,$response);
			} else {
				$this->userRespnse('Invalid user id',200,$response="");
			}
		} else {
			$this->userResponse('Empty Categories',200,$response="");
		}
	}

	public function getTitle() {
		$id = $_GET['id'];
		$new = array('id','title');
		$data = array( 'id' => $id);

		if( !empty($id) ) {
			$title = $this->db->select( $new,$data,$this->table );
			if(mysqli_num_rows($title)) {
				$response = $this->db->fetch($title);
				$this->userResponse('Title',200,$response);
			} else {
				$this->userResponse('Data not Found',200,$response="");
			}
		} else {
			$this->userResponse('Empty Id',200,$response="");
		}
	}
}

$category = new Category();