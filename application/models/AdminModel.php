<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model {

    public function getAdmin($admin_name, $admin_password) {
        // Example query to check admin credentials in the database
        $this->db->where('username', $admin_name);
        $this->db->where('password', $admin_password); // Assuming you store plain text passwords
    
        $query = $this->db->get('admin'); // 'admin' should be replaced with your actual table name
    
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }




}

?>