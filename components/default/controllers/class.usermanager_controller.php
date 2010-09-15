<?php // -*- mode:php; tab-width:4; indent-tabs-mode:t; c-basic-offset:4; -*-

/**
* @author Greg Froese
*
*/

class UsermanagerController extends \silk\action\Controller {
	public function index( $params = null ) {
		$users = \silk\auth\User::find_all();
		$this->set( "users", $users );
	}
	
	public function edit( $params = null ) {
		//is this a new user?
		if(  $params["id"] === "0" ) {
			$user = new \silk\auth\User();
			$user->fill_object( $params, $user );
			if( !empty( $params["password"] ) && !empty( $params["confirm_password"] ) && $params["password"] == $params["confirm_password"] ) {
				
				$user->set_password( $params["password"] );	
				$user->save();
				if( count( $user->validation_errors ) > 0 ) {
						$this->set( "error" , implode( "<br />", $user->validation_errors ));								
				} else {
					\silk\action\Response::redirect( "/usermanager/edit/$user->id" );
				}
			} else {
				if( !empty( $params["username"] )) { //don't show an error when its a new user
					$this->set( "error", "No password supplied or they don't match" );
				}
			}	
		} else { //its a save
			if( $params["password"] != $params["confirm_password"] ) {
				$this->set( "error", "Passwords do not match" );
			} else {
				$user = \silk\auth\User::find_by_id( $params["id"] );
//				$user->fill_object( $params, $user ); //does this work?
				$user->first_name = $params["first_name"];
				$user->last_name = $params["last_name"];
				if( !empty( $params["password"] )) {
					$user->set_password( $params["password"] );
				}
				$user->save();
				$this->set( "message", "$user->username saved successfully" );
//				var_dump( $user );
			}
		}
		if( !empty( $params["id"] ) && $params["id"] !== "0" ) {
			$user = \silk\auth\User::find_by_id( $params["id"] );
		}
		$this->set( "user", $user );
	}
	
	public function save( $params ) {
		var_dump( $params ); die;
	}
}