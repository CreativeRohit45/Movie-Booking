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

    public function checkMovieExists($screen_number, $selected_times_array, $movie_date) {
        $this->db->where('screen_number', $screen_number);
        $this->db->where('date', $movie_date);
        $this->db->group_start(); // Start group
        foreach ($selected_times_array as $time) {
            $this->db->or_where('JSON_CONTAINS(time, ' . $this->db->escape(json_encode($time)) . ')');
        }
        $this->db->group_end(); // End group
    
        $query = $this->db->get('movies');
    
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }
    
    public function checkMovieExistsExclude($exclude_id, $screen_number, $movie_time, $movie_date) {
        $this->db->select('*');
        $this->db->from('movies');
        $this->db->where('screen_number', $screen_number);
        $this->db->where('date', $movie_date);
    
        // Convert $movie_time array to JSON format for comparison
        $json_movie_time = json_encode($movie_time);
    
        // Use JSON_CONTAINS to check if any of the movie times exist in the database
        $this->db->where("JSON_CONTAINS(time, " . $this->db->escape($json_movie_time) . ")");
    
        // Exclude the movie with specific ID
        $this->db->where('id !=', $exclude_id);
        
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    

    // Function to insert a new movie into the database
    public function insertMovie($data) {
        return $this->db->insert('movies', $data);
    }

    public function getAllMovies() {
        $query = $this->db->get('movies');
        return $query->result();
    }

    public function getAllBookings() {
        $query = $this->db->get('bookings');
        return $query->result();
    }

    public function getCustomerName($customer_id) {
        $this->db->select('full_name'); // Assuming the name column in users table is 'name'
        $this->db->from('users');
        $this->db->where('customer_id', $customer_id); // Assuming the primary key of users table is 'id'
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->full_name;
        } else {
            return null;
        }
    }

    public function deleteMovie($movie_id) {
        // Perform deletion based on movie ID
        $this->db->where('id', $movie_id);
        $this->db->delete('movies');
    
        return $this->db->affected_rows() > 0;
    }
    
    public function getMovieById($movie_id) {
        // Ensure $movie_id is an integer
        $movie_id = (int) $movie_id;

        // Query to fetch movie details by ID
        $query = $this->db->get_where('movies', array('id' => $movie_id));

        // Check if a record was found
        if ($query->num_rows() > 0) {
            return $query->row(); // Return the movie object
        } else {
            return null; // Movie not found
        }
    }

    public function updateMovie($movie_id, $data) {
        // Ensure $movie_id is an integer
        $movie_id = (int) $movie_id;

        // Update movie record based on ID
        $this->db->where('id', $movie_id);
        return $this->db->update('movies', $data);
    }

    public function getSelectedTimesByMovieId($movie_id) {
        $query = $this->db->select('time')
                          ->where('id', $movie_id)
                          ->get('movies');
                          
        return $query->result_array();
    }


}

?>