<?php
    class Catagory {

        private $con;
        private $errorArray;

        public function __construct($con) {
            $this->con = $con;
            $this->errorArray = array();
        }

        public function already_exists($cat) {
			$query = mysqli_query($this->con, "SELECT * FROM category WHERE Cat_name = '$cat'");
			if(mysqli_num_rows($query) >= 1) {
				$data = mysqli_fetch_array($query);
				return false;
			} else {
				return true;
			}
		}
        
        public function already_exists_subcat($cat) {
			$query = mysqli_query($this->con, "SELECT * FROM subcategory WHERE Subcatname = '".$cat."'");
			if(mysqli_num_rows($query) >= 1) {
				$data = mysqli_fetch_array($query);
				return false;
			} else {
				return true;
			}
		}
        public function insert_subcat($name, $parent_cat_id, $file, $desc) {
            if($this->already_exists_subcat($name)) {
				$qry = "INSERT INTO `subcategory`(`Subcatname`, `Catid`, `Pic`, `Detail`) VALUES ('".$name."', $parent_cat_id, '".$file."', '".$desc."')";
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

        public function insert_cat($catname) {
            $qry = "INSERT INTO `category`(`Cat_name`) VALUES ('".$catname."')";
            if($this->already_exists($catname)) {
				$qry = "INSERT INTO `category`(`Cat_name`) VALUES ('".$catname."')";
				if(mysqli_query($this->con, $qry)) {
					return json_encode(array("status" =>  "success"));
				} else {
					return json_encode(array("status" =>  "fail", "code" => "Error: ".mysqli_error($this->con)));
				}
				mysqli_close($this->con);
			} else {
				return json_encode(array("status" =>  "user_exist"));
			}
        }
        
        public function get_all_cat() {
            $arr = array();
            $query = mysqli_query($this->con, "SELECT * FROM `category`");
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

        public function get_all_sub_cat() {
            $arr = array();
            $query = mysqli_query($this->con, "SELECT * FROM `subcategory`");

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

        public function get_subcat_by_id($str) {
            $query = mysqli_query($this->con, "SELECT * FROM `subcategory` WHERE Subcatid = $str");
            if(mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_array($query);
                return $data;
            } else {
                return false;
            }
        }

        public function get_subcatname_by_id($str) {
            $query = mysqli_query($this->con, "SELECT * FROM `subcategory` WHERE Subcatid = $str");
            if(mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_array($query);
                return $data[1];
            } else {
                return false;
            }
        }

        public function get_catname_by_id($id) {
            $query = mysqli_query($this->con, "SELECT * FROM `category` WHERE Cat_id = $id");
            if(mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_array($query);
                return $data[1]; 
            } else {
                // array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        public function get_cat_by_id($id) {
            $query = mysqli_query($this->con, "SELECT * FROM `category` WHERE Cat_id = $id");
            if(mysqli_num_rows($query) == 1) {
                $data = mysqli_fetch_array($query);
                return $data; 
            } else {
                // array_push($this->errorArray, Constants::$loginFailed);
                return false;
            }
        }
        public function get_subcat_with_parentid($id) {
            $arr = array();
            $query = mysqli_query($this->con, "SELECT * FROM `subcategory` WHERE Catid = $id");
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

        public function set_cat_by_id($id, $name) {
            $sql = "UPDATE `category` set Cat_name = '".$name."' WHERE Cat_id = $id";
            $query = mysqli_query($this->con, $sql);
            if($query) {
                return true; 
            } else {
                array_push($this->errorArray, Constants::$UPDATE_FAIL);
                // return mysqli_error($this->con);
                return false;
            }
        }

        public function set_subcat_by_id($id, $name, $par_cat, $icon, $desc) {
            $sql = "UPDATE `subcategory` SET `Subcatname`= '".$name."', `Catid`= $par_cat, `Pic`= '".$icon."', `Detail`= '".$desc."' WHERE Subcatid = $id";
            $query = mysqli_query($this->con, $sql);
            if($query) {
                return true; 
            } else {
                array_push($this->errorArray, Constants::$UPDATE_FAIL);
                // return mysqli_error($this->con);
                return false;
            }
        }

        public function del_cat($id) {
            $sql = "DELETE FROM `category` WHERE Cat_id = $id";
            $query = mysqli_query($this->con, $sql);
            if($query) {
                return true; 
            } else {
                array_push($this->errorArray, Constants::$DELETE_FAIL);
                return false;
            }
        }

        public function del_subcat($id) {
            $sql = "DELETE FROM `subcategory` WHERE Subcatid = $id";
            $query = mysqli_query($this->con, $sql);
            if($query) {
                return true; 
            } else {
                array_push($this->errorArray, Constants::$DELETE_FAIL);
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