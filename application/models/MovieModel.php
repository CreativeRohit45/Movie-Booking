<?php
class MovieModel extends CI_Model {
    public function getAllMovies() {
        $query = $this->db->get('movies'); // assuming your table name is 'movies'
        return $query->result();
    }

    public function getMovie($movie_id) {
        // Ensure the movie ID is an integer to prevent SQL injection
        $movie_id = (int)$movie_id;
    
        // Query the database to get the movie details
        $this->db->where('id', $movie_id);
        $query = $this->db->get('movies');
    
        // Check if a movie with the given ID exists
        if ($query->num_rows() == 1) {
            // Return the movie details
            return $query->row();
        } else {
            // Return null if no movie found
            return null;
        }
    }

    public function createUser($data) {
        return $this->db->insert('users', $data);
    }

    // Check if a customer ID already exists
    public function custExists($customer_id) {
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get('users');
        return $query->num_rows() > 0;
    }

    public function checkUser($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row(); // Return single row
    }

    public function insertData($data) {
        // Insert data into bookings table
        return $this->db->insert('bookings', $data);
    }

    public function getBookedSeats($movie_id) {
        $this->db->select('*');
        $this->db->from('bookings');
        $this->db->where('movie_id', $movie_id);
        $query = $this->db->get();
        return $query->result();
    }
    
    
}
?>
