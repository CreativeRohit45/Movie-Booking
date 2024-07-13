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

    public function getBookedSeats($movie_id, $time_slot) {
        $time_slot = urldecode($time_slot);
        $this->db->select('selected_seats');
        $this->db->from('bookings');
        $this->db->where('movie_id', $movie_id);
        $this->db->where('time_slot', $time_slot);
        $query = $this->db->get();
        return $query->result();
    }

    public function checkSeatsAvailability($movie_id, $time_slot, $screen_number, $selected_seats) {
        $this->db->select('selected_seats');
        $this->db->from('bookings');
        $this->db->where('movie_id', $movie_id);
        $this->db->where('time_slot', $time_slot);
        $this->db->where('screen_number', $screen_number);
        $query = $this->db->get();
    
        foreach ($query->result() as $row) {
            $booked_seats = json_decode($row->selected_seats, true);
            foreach ($selected_seats as $seat) {
                if (in_array($seat, $booked_seats)) {
                    return true; // Seat is already booked
                }
            }
        }
    
        return false; // All selected seats are available
    }
    
    
    
    
}
?>
