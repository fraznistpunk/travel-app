<?php
    class Package {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function get_all_packs() {
            $arr = array();
            $query = mysqli_query($this->con, "SELECT * FROM `package`");

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

        public function get_package_by_id($id) {
            $query = mysqli_query($this->con, "SELECT * FROM `package` WHERE Packid = $id");
            if(mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_array($query);
                return $data;
            } else {
                return false;
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

        public function already_exists($package) {
			$query = mysqli_query($this->con, "SELECT * FROM `package` WHERE `Packname` = '$package'");
			if(mysqli_num_rows($query) >= 1) {
				$data = mysqli_fetch_array($query);
				return false;
			} else {
				return true;
			}
		}

        public function insert_package($packagename, $par_cat, $sub_cat, $price, $image, $image2, $image3, $desc) {
            if($this->already_exists($packagename)) {
                $qry = "INSERT INTO `package`(`Packname`, `Category`, `Subcategory`, `Packprice`, `Pic1`, `Pic2`, `Pic3`, `Detail`) VALUES ('".$packagename."', $par_cat, $sub_cat, $price, '".$image."', '".$image2."', '".$image3."', '".$desc."')";
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

        public function set_package_by_id($id, $name, $cat, $sub_cat, $price, $image1, $image2, $image3, $desc) {
            $sql = "UPDATE `package` SET `Packname` = '".$name."', `Category` = $cat, `Subcategory` = $sub_cat, `Packprice` = $price, `Pic1` = '".$image1."', `Pic2` = '".$image2."', `Pic3` = '".$image3."', `Detail` = '".$desc."' WHERE Packid = $id";
            $query = mysqli_query($this->con, $sql);
            if($query) {
                return json_encode(array("status" => true)); 
            } else {
                array_push($this->errorArray, Constants::$UPDATE_FAIL);
                return json_encode(array("status" => false, "code" => mysqli_error($this->con)));
            }
        }

        public function delete_package($id) { 
            $qry = "DELETE FROM `package` WHERE Packid = $id";
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

        // public function del_cat($id) {
        //     $sql = "DELETE FROM `category` WHERE Cat_id = $id";
        //     $query = mysqli_query($this->con, $sql);
        //     if($query) {
        //         return true; 
        //     } else {
        //         array_push($this->errorArray, Constants::$DELETE_FAIL);
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