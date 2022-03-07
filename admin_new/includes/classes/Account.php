<?php
	class Account {

		private $con;
		private $errorArray;

		public function __construct($con) {
			$this->con = $con;
			$this->errorArray = array();
		}

		public function login($un, $pw) {

			// $pw = md5($pw);
			$pw = $pw;

			$query = mysqli_query($this->con, "SELECT * FROM users WHERE Username = '$un' AND Pwd = '$pw'");

			if(mysqli_num_rows($query) == 1) {
				$data = mysqli_fetch_array($query);
				return $data;
			} else {
				array_push($this->errorArray, Constants::$loginFailed);
				return false;
			}

		}

		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage text-danger'>$error</span>";
		}

	}
?>