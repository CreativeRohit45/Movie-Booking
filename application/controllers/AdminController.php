<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller {

    public function index() {
        $this->load->view('admin/adminLogin');
    }

    public function adminLogin() {
		// Set validation rules
		$this->form_validation->set_rules('admin_name', 'Admin Name', 'required');
		$this->form_validation->set_rules('admin_password', 'Admin Password', 'required');
	
		if ($this->form_validation->run() === FALSE) {
			// Validation failed, show login form with errors
			$this->load->view('admin/adminLogin');
		} else {
			// Validation passed, process the login
			$admin_name = $this->input->post('admin_name');
			$admin_password = $this->input->post('admin_password');
	
			// Example: Check admin credentials in the database
			$admin = $this->AdminModel->getAdmin($admin_name, $admin_password);
	
			if ($admin) {
				// Admin login successful, create session
				$admin_data = array(
					'admin_name' => $admin->username,
					// You can add more data to the session as needed
				);
			
				$this->session->set_userdata('admin_logged_in', $admin_data);
				// Redirect to the admin dashboard or any other page
				$this->adminView();
			} else {
				// Admin login failed, show error message
				$data['login_error'] = 'Invalid admin credentials. Please try again.';
				$this->load->view('admin/adminLogin', $data);
			}
		}
	}

    public function adminView() {
		// Check if admin session is set
		if ($this->session->userdata('admin_logged_in')) {
			// Get the selected order from the form data or from session if not available
            $data['active_tab'] = 'home';
            $data['movies'] = $this->AdminModel->getAllMovies();
			// Load the view and pass the data
			$this->load->view('header',$data);
			$this->load->view('admin/adminView',$data);
		} else {
			// Admin session not found, load the login view
			$this->load->view('admin/adminLogin');
		}
	}

    public function addShow() {
		// Check if admin session is set
		if ($this->session->userdata('admin_logged_in')) {
			$data['active_tab'] = 'add_show';
			$this->load->view('header', $data); 
			$this->load->view('admin/addShow', $data);
		} else {
			// Admin session not found, redirect to login page or show error message
			$this->load->view('admin/adminLogin');// Redirect to the login page
		}
	}

    public function addMovie() {
        // Set validation rules
        $this->form_validation->set_rules('movie_name', 'Movie Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('movie_genre', 'Movie Genre', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('screen_number', 'Screen Number', 'required|integer');
        $this->form_validation->set_rules('selected_times', 'Movie Time', 'required');
        $this->form_validation->set_rules('seat_price', 'Seat Price', 'required|numeric');
        $this->form_validation->set_rules('movie_date', 'Movie Date', 'required|callback_valid_date|callback_tomorrow_date');
        $this->form_validation->set_rules('movie_photo', 'Movie Photo', 'callback_file_check');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the form with validation errors
            redirect('addShow');
        } else {
            // Form validation passed
            $screen_number = $this->input->post('screen_number');
            $movie_date = $this->input->post('movie_date');
            $selected_times = $this->input->post('selected_times');

            $selected_times_array = array_filter(array_map('trim', explode(',', $selected_times)));
            // Check if a movie is already scheduled on the same screen at the same time
            $movieExists = $this->AdminModel->checkMovieExists($screen_number, $selected_times_array, $movie_date);
            if ($movieExists) {
                // Movie already scheduled
                $this->session->set_flashdata('error', 'A movie is already scheduled on this screen at the selected time.');
                redirect('addShow'); // Redirect back to the form
            } else {
                // Handle file upload
                $photo = file_get_contents($_FILES['movie_photo']['tmp_name']);
                $movie_id = 'MOV_' . uniqid();
                // Prepare data for insertion
                $data = [
                    'movie_id' => $movie_id,
                    'photo' => $photo,
                    'name' => $this->input->post('movie_name'),
                    'genre' => $this->input->post('movie_genre'),
                    'screen_number' => $screen_number,
                    'time' => json_encode($selected_times_array),
                    'price' => $this->input->post('seat_price'),
                    'total_seats' => 60,
                    'date' => $movie_date
                ];

                // Insert data into the database
                if ($this->AdminModel->insertMovie($data)) {
                    // Success
                    $this->session->set_flashdata('success', 'Movie added successfully');
                    redirect('adminView'); // Redirect to movies page
                } else {
                    // Error
                    $this->session->set_flashdata('error', 'Failed to add movie');
                    redirect('addShow'); // Redirect back to the form
                }
            }
        }
    }

    public function deleteMovie($movie_id) {
        // Check if movie ID is provided and numeric
        if (!is_numeric($movie_id)) {
            $this->session->set_flashdata('error', 'Invalid movie ID');
            redirect('adminView'); // Redirect back to movies page
        }
    
        // Perform deletion
        if ($this->AdminModel->deleteMovie($movie_id)) {
            // Deletion successful
            $this->session->set_flashdata('success', 'Movie deleted successfully');
        } else {
            // Deletion failed
            $this->session->set_flashdata('error', 'Failed to delete movie');
        }
    
        redirect('adminView'); // Redirect back to movies page
    }

    public function editMovie($movie_id) {
        // Check if movie ID is provided and numeric
        if (!is_numeric($movie_id)) {
            $this->session->set_flashdata('error', 'Invalid movie ID');
            redirect('adminView'); // Redirect back to movies page
        }
    
        // Fetch movie details from database
        $data['movie'] = $this->AdminModel->getMovieById($movie_id);
        $data['selected_times'] = $this->AdminModel->getSelectedTimesByMovieId($movie_id);
        if (!$data['movie']) {
            // Movie not found
            $this->session->set_flashdata('error', 'Movie not found');
            redirect('adminView'); // Redirect back to movies page
        }
    
        // Load edit view with movie details
        $data['active_tab'] = 'home';
		$this->load->view('header', $data); 
        $this->load->view('admin/editMovie', $data);
    }
    
    public function updateMovie($movie_id) {
        // Check if movie ID is provided and numeric
        if (!is_numeric($movie_id)) {
            $this->session->set_flashdata('error', 'Invalid movie ID');
            redirect('adminView'); // Redirect back to movies page
        }
    
        // Set validation rules
        $this->form_validation->set_rules('movie_name', 'Movie Name', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('movie_genre', 'Movie Genre', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('screen_number', 'Screen Number', 'required|integer');
        $this->form_validation->set_rules('movie_time', 'Movie Time', 'required');
        $this->form_validation->set_rules('seat_price', 'Seat Price', 'required|numeric');
        $this->form_validation->set_rules('movie_date', 'Movie Date', 'required|callback_valid_date|callback_tomorrow_date');
    
        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the edit form with validation errors
            $data['movie'] = (object) $this->input->post(); // Preserve form input
            $this->load->view('editMovie', $data);
        } else {
            // Form validation passed
            $screen_number = $this->input->post('screen_number');
            $movie_date = $this->input->post('movie_date');
    
            // Check if a movie is already scheduled on the same screen at the same time, excluding current movie
            $movieExists = $this->AdminModel->checkMovieExistsExclude($movie_id, $screen_number, $this->input->post('movie_time'), $movie_date);
            $selected_times = $this->input->post('movie_time');
            if ($movieExists) {
                // Movie already scheduled
                $this->session->set_flashdata('error', 'A movie is already scheduled on this screen at the selected time.');
                redirect('adminView'); // Redirect back to movies page
            } else {
                // Handle file upload if applicable
                if (!empty($_FILES['movie_photo']['name'])) {
                    $photo = file_get_contents($_FILES['movie_photo']['tmp_name']);
                    $data['photo'] = $photo;
                }
                
                // Prepare data for update
                $data = [
                    'name' => $this->input->post('movie_name'),
                    'genre' => $this->input->post('movie_genre'),
                    'screen_number' => $screen_number,
                    'time' => json_encode($selected_times),
                    'price' => $this->input->post('seat_price'),
                    'date' => $movie_date
                ];
    
                // Update movie in the database
                if ($this->AdminModel->updateMovie($movie_id, $data)) {
                    // Success
                    $this->session->set_flashdata('success', 'Movie updated successfully');
                } else {
                    // Error
                    $this->session->set_flashdata('error', 'Failed to update movie');
                }
    
                redirect('adminView'); // Redirect back to movies page
            }
        }
    }



     // Custom callback function to check file upload
     public function file_check($str) {
        return TRUE; // Example, adjust as needed
    }

    // Custom callback function to check if the date is valid
    public function valid_date($date) {
        if (DateTime::createFromFormat('Y-m-d', $date) !== FALSE) {
            return TRUE;
        } else {
            $this->form_validation->set_message('valid_date', 'The {field} field must contain a valid date (YYYY-MM-DD)');
            return FALSE;
        }
    }

    // Custom callback function to check if the date is tomorrow or later
    public function tomorrow_date($date) {
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        if ($date >= $tomorrow) {
            return TRUE;
        } else {
            $this->form_validation->set_message('tomorrow_date', 'The {field} must be selected from tomorrow onwards.');
            return FALSE;
        }
    }

    public function logout() {
		// Unset admin session data
		$this->session->unset_userdata('admin_logged_in');
		// Redirect to the login page
		$this->load->view('admin/adminLogin');
	}
    
    
}
