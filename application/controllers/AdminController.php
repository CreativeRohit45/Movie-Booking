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
			// Fetch all roles from the database
			$data['active_tab'] = 'add_show';
			// Load the view to display the roles
			$this->load->view('header', $data); 
			$this->load->view('admin/addShow', $data);
		} else {
			// Admin session not found, redirect to login page or show error message
			$this->load->view('admin/adminLogin');// Redirect to the login page
		}
	}
}
