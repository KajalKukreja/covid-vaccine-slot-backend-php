<?php
    class Member {
        private $id;
        private $email;
        private $mobile_no;
        private $pincode;
        private $district_id;

        function __construct($id, $email, $mobile_no, $pincode, $district_id) {
            $this->id = $id;
            $this->email = $email;
            $this->mobile_no = $mobile_no;
            $this->pincode = $pincode;
            $this->district_id = $district_id;
        }
        function get_id() {
            return $this->id;
        }
        function set_id($id) {
            $this->id = $id;
        }
        function get_email() {
            return $this->email;
        }
        function set_email($email) {
            $this->email = $email;
        }
        function get_mobile_no() {
            return $this->mobile_no;
        }
        function set_mobile_no($mobile_no) {
            $this->mobile_no = $mobile_no;
        }
        function get_pincode() {
            return $this->pincode;
        }
        function set_pincode($pincode) {
            $this->pincode = $pincode;
        }
        function get_district_id() {
            return $this->district_id;
        }
        function set_district_id($district_id) {
            $this->district_id = $district_id;
        }
    }
?>