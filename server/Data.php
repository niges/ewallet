<?php 

include_once('JWT.php');
include_once('Wrapper.php');
include_once('Database.php');


Class Data extends Wrapper {

	public $table = "data";
	public function __construct() {

		$this->db = Database::getInstance();
		
		$this->register_route( 'add', array(
			'method' => 'post',
			'callback' => array($this ,'addData')
		));

		$this->register_route( 'edit', array(
			'method' => 'put',
			'callback' => array($this ,'editData')
		));

		$this->register_route( 'delete', array(
			'method' => 'delete',
			'callback' => array($this ,'deleteData')
		));

		$this->register_route( 'show', array(
		'method' => 'get',
		'callback' => array($this ,'showData')
		));

		$this->register_route( 'title', array(
		'method' => 'get',
		'callback' => array($this ,'getTitle')
		));

		parent::__construct();
	}

	public function addData() {

		$cid    = $_GET['id'];
		$decode = json_decode(file_get_contents('php://input'),true);
		$title = $decode['title'];
		$body  = $decode['body'];

		if (!empty($title) && !empty($body) ) {

			$data = array(
					'title'=>$title,
					'body' =>$body,
					'category_id' => $cid
					);

			$dataInsert = $this->db->insert($this->table,$data);

			if ($dataInsert) {
				$this->userResponse('Data inserted Successfully',200,$data);
			} else {
				$this->userResponse('Invalid Data',200,$response="");
			}
		} else {
			$this->userResponse('Empty data',200,$response="");
		}
	}

	public function editData() {
		$cid = $_GET['id'];
		$decode = json_decode(file_get_contents('php://input'),true);
		$title = $decode['title'];
		$body  = $decode['body'];

		$id = array('id'=>$cid);

		if (!empty($title) && !empty($body)) {
			$data = array(
					'title'=>$title,
					'body' => $body
					);
			$update = $this->db->update($this->table,$data,$id);
			if ($update) {
				$this->userResponse('Data updated Successfully',200,$data);
			} else {
				$this->userResponse('Invalid Data',200,$response="");
			}
		} else {
			$this->userResponse('Empty data',200,$response="");
		}

	}

	public function deleteData() {
		$id = $_GET['id'];

		if (!empty($id)) {
			$data = array('id'=>$id);
			$delete = $this->db->delete($this->table,$data);
			if ($delete) {
				$this->userResponse('Data deleted Successfully',200,$data);
			} else {
				$this->userResponse('Invalid Data',200,$response="");
			}
		} else {
			$this->userResponse('Empty data',200,$response="");
		}
	}

	public function showData() {
		
		$cid = $_GET['id'];

		if (!empty($cid)) {

			$new = array('id','title','body');
			$data = array('category_id'=>$cid);
			$show = $this->db->select($new,$data,$this->table);
			if (mysqli_num_rows($show)) {
				$response = $this->db->fetch($show);
				$this->userResponse('Data shown',200,$response);
			} else {
				$this->userResponse('Id Not Found',200,$response="");
			}
		} else {
			$this->userResponse('Empty Id',200,$response="");
		}
	}

	public function getTitle() {

		$id = $_GET['id'];
		$new = array('id','title','body');
		$data = array( 'id' => $id);

		if( !empty($id) ) {
			$title = $this->db->select( $new,$data,$this->table );
			if(mysqli_num_rows($title)) {
				$response = $this->db->fetch($title);
				$this->userResponse('Data',200,$response);
			} else {
				$this->userResponse('Data not Found',200,$response="");
			}
		} else {
			$this->userResponse('Empty Id',200,$response="");
		}
	}
}
$data = new Data();