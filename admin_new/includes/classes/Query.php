<?php
    
    class Query {

        private $con;
        private $username;

        public function __construct($con) {
            $this->con = $con;
        }

        public function get_all_enquiry() {
            $arr = array();
            $query = mysqli_query($this->con, "SELECT * FROM `enquiry`");

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
        public function set_approve($id) {
            $query = mysqli_query($this->con, "UPDATE `enquiry` SET `Statusfield` = 'Approved' WHERE Enquiryid = $id");
            if($query) {
                return true; 
            } else {
                return mysqli_error($this->con);
            }
        }

        public function set_pending($id) {
            $query = mysqli_query($this->con, "UPDATE `enquiry` SET `Statusfield` = 'Pending' WHERE Enquiryid = $id");
            if($query) {
                return true; 
            } else {
                return mysqli_error($this->con);
            }
        }

        // public function getUsername() {
        //     return $this->username;
        // }
        // public function getEmail() {
        //     $query = mysqli_query($this->con, "SELECT email FROM users WHERE username='$this->username'");
        //     $row = mysqli_fetch_array($query);
        //     return $row['email'];
        // }

        public function getFirstAndLastName() {
            $query = mysqli_query($this->con, "SELECT concat(firstName, ' ', lastName) as 'name' FROM users WHERE username='$this->username'");
            $row = mysqli_fetch_array($query);
            return $row['name'];
        }
    }

?>