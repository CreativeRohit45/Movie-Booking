<?php
class MovieModel extends CI_Model {
    public function getAllMovies() {
        $query = $this->db->get('movies'); // assuming your table name is 'movies'
        return $query->result();
    }
}
?>
