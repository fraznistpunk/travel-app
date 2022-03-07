<?php
	
	class User {

		private $con;
		private $username;

		public function __construct($con) {
			$this->con = $con;
		}

		 public function get_all_users() {
            $arr = array();
            $query = mysqli_query($this->con, "SELECT * FROM `users`");

            if(mysqli_num_rows($query) >= 1) {
                while($data = mysqli_fetch_array($query)) {
                    array_push($arr, $data);
                }
                return $arr;
            } else {
                // array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

		public function get_user($id) {
            $query = mysqli_query($this->con, "SELECT * FROM `users` WHERE user_id = $id");
            if(mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_array($query);
                return $data; 
            } else {
                // array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

		// public function getEmail() {
		// 	$query = mysqli_query($this->con, "SELECT email FROM users WHERE username='$this->username'");
		// 	$row = mysqli_fetch_array($query);
		// 	return $row['email'];
		// }

		// public function getFirstAndLastName() {
		// 	$query = mysqli_query($this->con, "SELECT concat(firstName, ' ', lastName) as 'name' FROM users WHERE username='$this->username'");
		// 	$row = mysqli_fetch_array($query);
		// 	return $row['name'];
		// }
		public function already_exists($un) {
			$query = mysqli_query($this->con, "SELECT * FROM users WHERE Username = '$un'");
			if(mysqli_num_rows($query) >= 1) {
				$data = mysqli_fetch_array($query);
				return false;
			} else {
				return true;
			}

		}
		public function insert_user($name, $pw, $type) {
			if($this->already_exists($name)) {
				$qry = "INSERT INTO `users`(`Username`, `Pwd`, `Typeofuser`) VALUES ('".$name."', '".$pw."', '".$type."') ";
				if(mysqli_query($this->con,$qry)) {
					return json_encode(array("status" =>  "success"));
				} else {
					return json_encode(array("status" =>  "fail", "code" => "Error: ".mysqli_error($this->con)));
				}
				mysqli_close($this->con);
			} else {
				return json_encode(array("status" =>  "user_exist"));
			}
		}

		public function update_user($id, $name, $pw, $type) {
			$qry = "UPDATE users SET `Username` = '".$name."', `Pwd` = '".$pw."', `Typeofuser` = '".$type."' WHERE user_id = $id";
			if(mysqli_query($this->con, $qry)) {
				return json_encode(array("status" =>  "success"));
			} else {
				return json_encode(array("status" =>  "fail", "code" => "Error: ".mysqli_error($this->con)));
			}
			mysqli_close($this->con);
		}
		public function delete_user($id) {
			$qry = "DELETE FROM `users` WHERE `user_id` = $id";
			if(mysqli_query($this->con,$qry)) {
				return json_encode(array("status" =>  "success"));
			} else {
				return json_encode(array("status" =>  "fail", "code" => "Error: ".mysqli_error($this->con)));
			}
			mysqli_close($this->con);
		}
	}

?>