<?php 

abstract class Wrapper {

	protected $routes;
	// abstract public function register();
	
	public function userResponse($message,$status,$userData) {
		header("Content-Type:application/json");
		$response['message'] = $message;
		$response['status'] = $status;
		$response['data'] = $userData;
		$json_response = json_encode($response);
		echo $json_response;
	}

	public function userToken($email,$password) {
		$header = json_encode(['type'=>'jwt','alg'=>'HS256']);

		$payload = json_encode(['email'=>$email,'password'=>$password]);

		$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

		$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

		$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);

		$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

		$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

		return $jwt;
	}

	public function __construct() {

		$key = array_search( $_GET['url'], array_column( $this->routes, 'url' ) );
		if( $key !== false && isset( $this->routes[$key] ) ){
			$route = $this->routes[ $key ];
				if( strtolower( $_SERVER['REQUEST_METHOD'] ) == strtolower( $route['method'] ) ){
					call_user_func( $route['callback'] );
				}else{
					$this->invalid_route();
				}
		}else{
			$this->invalid_route();
		}
	}

	public function register_route( $url , $payload ) {
		
		$this->routes[] = array(
			'url'      => $url,
			'method'   => $payload[ 'method' ],
			'callback' => $payload[ 'callback' ]
		);
	}

	public function invalid_route(){
		$this->response( 404, array(
			'message' => 'Invalid Route',
		));
	}
	public function response( $status = 200, $data ){
		header('Content-Type: application/json');
		http_response_code( $status );
		echo json_encode($data);
		die;
	}
}