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
    
}
?>
