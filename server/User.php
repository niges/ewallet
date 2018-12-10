<?php 
include_once('JWT.php');
include_once('Wrapper.php');
include_once('Database.php');
include_once('Phpmailer.php');


class User extends Wrapper {

	public $table = "user";

	public function __construct() {
		$this->db= Database::getInstance();

		$this->register_route( 'register', array(
			'method' => 'post',
			'callback' => array($this , 'register' )
		));

		$this->register_route( 'login', array(
			'method' => 'post',
			'callback' => array($this , 'login' )
		));

		$this->register_route( 'forget', array(
			'method' => 'post',
			'callback' => array($this , 'forget' )
		));

		$this->register_route( 'recovery', array(
			'method' => 'post',
			'callback' => array($this , 'recovery' )
		));

		$this->register_route( 'resendEmail', array(
			'method' => 'post',
			'callback' => array($this , 'forget' )
		));

		parent::__construct();

	}

	public function register(){
		
		$data = json_decode(file_get_contents('php://input'), true);
		$name = $data['name'];
		$email = $data['email'];
		$password = md5($data['password']);
		
		if (!empty($name) && !empty($email)) {
			$data = array(
				'name'=>$name,
				'email'=>$email,
				'password'=>$password
				
				);
			$new = array('*');
			$emailData = array('email'=>$email);
			if (mysqli_num_rows($this->db->select($new,$emailData,$this->table))==0) {
				if ($this->db->insert($this->table,$data)==true) {

					$jwt = $this->userToken($email,$password);

					$response = array('name'=>$name,'email'=>$email,'jwt'=>$jwt);

					$this->userResponse('Successfully Registered',200,$response);

				} else {
					$this->userResponse('Not Registered',200,$response='');
				}
			} else {
				$this->userResponse('Already Subscribed',200,$response='');
			}
			
		} else {
			$this->userResponse("You need to enter Name and password",200);
		}
	}

	public function login() {
		$decode   = json_decode(file_get_contents('php://input'),true);
		$email    = $decode[ 'email' ];
		$password = $decode[ 'password' ];

		$data = array(
			'email'    => $email,
			'password' => md5($password)
		);
		$new = array('*');
		if (!empty($email) && !empty($password)) {
			
			if(mysqli_num_rows($this->db->select($new,$data,$this->table))>0) {
				$jwt = $this->userToken($email,$password);
				$id = $this->db->select($new,$data,$this->table);
				foreach ($id as $key => $value) {
					$newid =  $value['id'];
				}
				// $decode = JWT::decode($jwt,'abC123!',['HS256']);
			
				// $head = $this->getBearerToken();
				// echo $head;	die();
				
				$response = array('jwt'=>$jwt,'id'=>$newid);
				$this->userResponse("You are logged in",200,$response);
			} else {
				$this->userResponse("Username or Password Not correct",200,$response='');
			}
		} else {
			$this->userResponse("Empty Username or password",200,$response='');
		}
	}

	public function forget() {
		$decode = json_decode(file_get_contents('php://input'),true);
		$email = $decode['email'];
		$data = array('email'=>$email);
		$new = array('*');
		if (!empty($email)) {
			if (mysqli_num_rows($this->db->select($new,$data,$this->table))>0) {
				$jwt = $this->userToken($email,$password='');
				$mail = new Phpmailers();
				$mail->send_mail($jwt);
				$response = array('jwt'=>$jwt);
				$this->userResponse("Your token is",200,$response);
			} else {
				$this->userResponse('Invalid username',200,$response='');
			}
		} else {
			$this->userResponse('Enter Username',200,$response='');
		}
	}

	public function recovery() {
		$decode = json_decode(file_get_contents('php://input'),true);
		$token = $decode['token'];
		$password = md5($decode['password']);
		$jwt = JWT::decode($token,'abC123!',['HS256']);
		if ($jwt) {
			$data = array('password'=>$password);
			$email = $jwt->email;
			$newemail = array('email'=>$email);
			if($this->db->update($this->table,$data,$newemail)){
				$newToken = $this->userToken($email,$password='');
				$response = array('jwt' => $newToken);
				$this->userResponse("Your token is",200,$response);
			} else{
				$this->userResonse('Not Updated',200,$response='');
			}
		} else {
			$this->userResponse('Error',200,$response='');
		}
	}
}
$user = new User();
// $user->check();