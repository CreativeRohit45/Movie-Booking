<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
    public function index() {
        $data['movies'] = $this->MovieModel->getAllMovies();
        $data['active_tab'] = 'home';
        $this->load->view('user/header',$data);
        $this->load->view('user/userDash',$data);
    }

    public function viewMovie($movie_id) {
        $data['active_tab'] = 'home';
        $movie = $this->MovieModel->getMovie($movie_id);
        $data['movie'] = $movie;
        $data['time_slots'] = json_decode($movie->time, true);
    
        // Fetch booked seats for the movie
        $booked_seats = $this->MovieModel->getBookedSeats($movie->movie_id);
        $data['booked_seats'] = $booked_seats;
    
        $this->load->view('user/header', $data);
        $this->load->view('user/bookMovie', $data);
    }
    

    public function registerUser(){
        $this->form_validation->set_rules('full_name', 'Full Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load the registration page with errors
            $data['active_tab'] = 'register';
            $this->load->view('user/header',$data);
            $this->load->view('user/userRegister',$data);
        } else {
            // Generate unique customer ID
            $customer_id = $this->generateCustID();

            // Validation passed, insert data into database
            $data = array(
                'customer_id' => $customer_id,
                'full_name' => $this->input->post('full_name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            );

            $insert_id = $this->MovieModel->createUser($data);

            if ($insert_id) {
                // Successfully inserted data
                $this->session->set_flashdata('success', 'Registration successful. You can now login.');
                redirect('userLogin');
            } else {
                // Failed to insert data
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                $data['active_tab'] = 'register';
                $this->load->view('user/header',$data);
                $this->load->view('user/userRegister',$data);
    
            }
        }
        
    }

    private function generateCustID() {
        $this->load->helper('string');
        $unique_id = 'CUST-' . random_string('alnum', 8);
        
        // Ensure the ID is unique by checking the database
        while ($this->MovieModel->custExists($unique_id)) {
            $unique_id = 'CUST-' . random_string('alnum', 8);
        }

        return $unique_id;
    }

    public function loginUser(){

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load the login page with errors
            $data['active_tab'] = 'login';
            $this->load->view('user/header',$data);
            $this->load->view('user/userLogin',$data);
        } else {
            // Get input values
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Check user credentials
            $user = $this->MovieModel->checkUser($email);

            if ($user && password_verify($password, $user->password)) {
                // Password is correct, set session data
                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('customer_id', $user->customer_id);
                $this->session->set_userdata('full_name', $user->full_name);
                $this->session->set_flashdata('success', 'Login successful.');
                redirect('userHome'); // Change this to your desired redirection
            } else {
                // Invalid credentials
                $this->session->set_flashdata('error', 'Invalid email or password.');
                redirect('userLogin');
            }
        }
    }

    public function bookTickets() {
        // Retrieve data sent via POST request
        $requestData = json_decode(file_get_contents('php://input'), true);
    
        // Extract data from request
        $movie_id = $requestData['movie_id'];
        $total_seats = $requestData['total_seats'];
        $time_slot = $requestData['time_slot'];
        $price = $requestData['price'];
        $screen_number = $requestData['screen_number'];
        $movie_name = $requestData['movie_name'];
        $selected_seats = $requestData['selected_seats'];
    
        // Example: Retrieve customer_id from session (replace with your actual session handling)
        $customer_id = $this->session->userdata('customer_id');
    
        // Prepare data to insert into the database
        $booking_data = array(
            'movie_id' => $movie_id,
            'customer_id' => $customer_id,
            'total_seats' => $total_seats,
            'time_slot' => $time_slot,
            'price' => $price,
            'screen_number' => $screen_number,
            'movie_name' => $movie_name,
            'selected_seats' => json_encode($selected_seats)
        );
    
        // Insert into the database using your Model (adjust this based on your actual Model method)
        $inserted = $this->MovieModel->insertData($booking_data);
    
        // Prepare response based on insertion result
        if ($inserted) {
            // Successfully booked
            $response = array('success' => true, 'message' => 'Booking successful');
        } else {
            // Failed to book
            $response = array('success' => false, 'message' => 'Failed to book');
        }
    
        // Send JSON response back to the client
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    

    public function userLogout() {
        // Destroy the session
        $this->session->sess_destroy();
        redirect('userHome');
    }

}