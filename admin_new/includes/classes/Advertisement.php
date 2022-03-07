<?php
    class Advertisement {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function get_all_advertisement() {
            $arr = array();
            $query = mysqli_query($this->con, "SELECT * FROM `advertisement`");

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
        public function already_exists($adv) {
			$query = mysqli_query($this->con, "SELECT * FROM advertisement WHERE `Title` = '".$adv."'");
			if(mysqli_num_rows($query) >= 1) {
				return false;
			} else {
				return true;
			}
		}
        public function insert_adv($adv, $comp, $file, $desc) {
            if($this->already_exists($adv)) {
				$qry = "INSERT INTO `advertisement`(`Title`, `Companyname`, `Pic`, `Detail`) VALUES ('".$adv."', '".$comp."', '".$file."', '".$desc."')";
				if(mysqli_query($this->con, $qry)) {
					return json_encode(array("status" =>  "success"));
				} else {
					return json_encode(array("status" =>  "fail", "code" => "Error: ".mysqli_error($this->con)));
				}
				mysqli_close($this->con);
			} else {
				return json_encode(array("status" =>  "already_exist"));
			}
        }

        public function get_adv_by_id($id) {
            $query = mysqli_query($this->con, "SELECT * FROM `advertisement` WHERE Advid = $id");
            if(mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_array($query);
                return $data; 
            } else {
                // array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }

        public function delete_ad($id) {
            $qry = "DELETE FROM `advertisement` WHERE `Advid` = $id";
            if (mysqli_query($this->con, $qry)) {
                return json_encode(array("status" =>  "success"));
            } else {
                return json_encode(array("status" =>  "fail", "code" => "Error: " . mysqli_error($this->con)));
            }
            mysqli_close($this->con);
        }

        // public function set_adv_by_id($id, $name) {
        //     $sql = "UPDATE `advertisement` set Cat_name = '".$name."' WHERE Advid = $id";
        //     $query = mysqli_query($this->con, $sql);
        //     if($query) {
        //         return true; 
        //     } else {
        //         array_push($this->errorArray, Constants::$UPDATE_FAIL);
        //         // return mysqli_error($this->con);
        //         return false;
        //     }
        // }

        // public function getError($error) {
        //     if(!in_array($error, $this->errorArray)) {
        //         $error = "";
        //     }
        //     return "<span class='errorMessage text-danger'>$error</span>";
        // }

    }
?>