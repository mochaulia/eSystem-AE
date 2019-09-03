<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    /*
        ANONYMOUS METHOD
     */
    public function login()
    {
		// user have to be an anonymous user (loged out)
        logout_required();
		// load libs
        $this->load->library('form_validation');
        $this->load->library('session');
        // setting validation form
        $this->form_validation->set_rules('email', 'lang:login_identity_ph', 'required~valid_email');
        $this->form_validation->set_rules('password', 'lang:login_password_ph', 'required');
        // form submitted
        if ($this->form_validation->run() === true) {
            // if the user is logging in
            $remember = (bool)$this->input->post('remember');
            if (app('ion_auth')->login($this->input->post('email'), $this->input->post('password'), $remember)) {
				// if the login is successful
				// redirect them back to the home page
                $this->session->set_flashdata('message', app('ion_auth')->messages());
                redirect(config_item('login_success_page'), 'refresh');
            } else {
				// if the login was un-successful
				// redirect them back to the login page
                $this->session->set_flashdata('message', app('ion_auth')->errors());
                redirect(config_item('login_page'), 'refresh');
            }
        } else {
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
            $data['message'] = $this->session->flashdata('message');
            $data['nav'] = array(
                'list' => lang('create_user_register_heading'),
                'url' => site_url('auth/register')
            );
            $data['title'] = lang('login_heading');
            app('vnk')->view('login', $data);
        }
    }

    public function register()
    {
		// user have to be an anonymous user (loged out)		
        logout_required();
		// load libs
        $this->load->library('form_validation');
        $this->load->library('session');
        // load models
        $this->load->model('majors/majors_model');
        $this->load->model('units/units_model');
		// setting validation form
        $this->form_validation->set_rules('full_name', 'lang:create_user_validation_fullname_label', 'trim~required');
        $this->form_validation->set_rules('gender', 'lang:create_user_validation_gender_label', 'trim~required');
        $this->form_validation->set_rules('username', 'lang:create_user_validation_identity_label', 'trim~required~is_unique[' . $this->config->item('tables', 'ion_auth')['users'] . '.username]~numeric~min_length[' . $this->config->item('min_username_length', 'ion_auth') . ']');
        $this->form_validation->set_rules('role', 'lang:create_user_validation_role_label', 'trim~required');
        $this->form_validation->set_rules('email', 'lang:create_user_validation_email_label', 'trim~required~valid_email~is_unique[' . $this->config->item('tables', 'ion_auth')['users'] . '.email]');
        $this->form_validation->set_rules('secondary_email', 'lang:create_user_validation_secondary_email_label', 'trim~valid_email~is_unique[' . $this->config->item('tables', 'ion_auth')['users'] . '.secondary_email]~regex_match[/^[A-Za-z0-9._%+-]+@polman-bandung.ac.id$/]');
        $this->form_validation->set_rules('password', 'lang:create_user_validation_password_label', 'required~min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']');
        $this->form_validation->set_rules('password_confirm', 'lang:create_user_validation_password_confirm_label', 'required~matches[password]');
        $this->form_validation->set_rules('major', 'lang:create_user_validation_major_label', 'trim~required');
        $this->form_validation->set_rules('unit', 'lang:create_user_validation_unit_label', 'trim~required');
        $this->form_validation->set_rules('phone', 'lang:create_user_validation_phone_label', 'trim~required~regex_match[/((\62|\+62) ((\d{3}([ -]\d{3,})([- ]\d{4,})?)|(\d+)))|(\(\d+\) \d+)|\d{3}( \d+)+|(\d+[ -]\d+)|\d+/]');
        $this->form_validation->set_rules('home_address', 'lang:create_user_validation_home_addreess_label', 'trim');        
        // form submitted
        if ($this->form_validation->run() === true) {
			// if the user registering
            $email = strtolower($this->input->post('email'));
            $identity = $this->input->post('username');
            $password = $this->input->post('password');
            $additional_data = array(
                'first_name' => explode(' ', $this->input->post('full_name'), 2)[0],
                'last_name' => explode(' ', $this->input->post('full_name'), 2)[1],
                'gender' => $this->input->post('gender'),
                'secondary_email' => $this->input->post('secondary_email'),
                'id_major' => $this->input->post('major'),
                'id_unit' => $this->input->post('unit'),
                'phone' => $this->input->post('phone'),
                'home_address' => $this->input->post('home_address'),
            );
            $role = $this->input->post('role');
        }
        if ($this->form_validation->run() === true && app('ion_auth')->register($identity, $password, $email, $additional_data, array($role), true)) {
            // registering success
            $this->session->set_flashdata('message', app('ion_auth')->messages());
            redirect(config_item('login_page'), 'refresh');
        } else {
            // if not submit yet
            // load view
            $data['message'] = (app('ion_auth')->errors() ? app('ion_auth')->errors() : $this->session->flashdata('message'));
            $data['nav'] = array(
                'list' => lang('login_heading'),
                'url' => site_url('auth/login')
            );
            $data['title'] = lang('create_user_register_heading');
            app('vnk')->view('register', $data);
        }
    }

    public function activate($id = null, $code_raw = null)
    {
        if (!$id || !$code_raw) {
            // if code doesn't exist
            // show not found error
            show_404();
        }
        // user have to be an anonymous user (loged out)		
        logout_required();
		// load libs
        $this->load->library('session');
        $code = ends_with($code_raw, config_item('url_suffix'))
            ? str_replace(config_item('url_suffix'), '', $code_raw)
            : $code_raw;
        $activation = app('ion_auth')->activate($id, $code);
        if ($activation) {
            // if activation success
            // redirect to login page
            $this->session->set_flashdata('message', app('ion_auth')->messages());
            redirect(config_item('login_page'), 'refresh');
        } else {
            // if activation failed
			// redirect to forgot password page
            $this->session->set_flashdata('message', app('ion_auth')->errors());
            redirect('auth/forgot-password', 'refresh');
        }
    }

    public function forgot_password()
    {
        // user have to be an anonymous user (loged out)		
        logout_required();
		// load libs
        $this->load->library('form_validation');
        $this->load->library('session');
        // setting validation form
        $this->form_validation->set_rules('email', 'lang:forgot_password_validation_email_label', 'required~valid_email');
        if ($this->form_validation->run() === false) {
            // if form not submitted yet
            // load view
            $data['message'] = $this->session->flashdata('message');
            $data['nav'] = array(
                'list' => lang('login_heading'),
                'url' => site_url('auth/login')
            );
            $data['title'] = lang('forgot_password_heading');
            app('vnk')->view('forgot_password', $data);
        } else {
            $identity = app('ion_auth')->where(
                $this->config->item('identity', 'ion_auth'),
                $this->input->post('email')
            )->users()->row();
            if (empty($identity)) {
                app('ion_auth')->set_error('forgot_password_email_not_found');
                $this->session->set_flashdata('message', app('ion_auth')->errors());
                redirect('auth/forgot-password', 'refresh');
            }
			// run the forgotten password method to email an activation code to the user
            if (app('ion_auth')->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')})) {
				// if there were no errors
                $this->session->set_flashdata('message', app('ion_auth')->messages());
                redirect(config_item('login_page'), 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', app('ion_auth')->errors());
                redirect('auth/forgot_password', 'refresh');
            }
        }
    }

    public function reset_password($code_raw = null)
    {
        if (!$code_raw) {
            // if code doesn't exist
            // show not found error
            show_404();
        }
        // user have to be an anonymous user (loged out)		
        logout_required();
        // load libs
        $this->load->library('form_validation');
        $this->load->library('session');
        // pre forgotten password
        $code = ends_with($code_raw, config_item('url_suffix'))
            ? str_replace(config_item('url_suffix'), '', $code_raw)
            : $code_raw;
        $user = app('ion_auth')->forgotten_password_check($code);
        if ($user) {
            // if the code is valid then display the password reset form
            $this->form_validation->set_rules('password', 'lang:reset_password_validation_new_password_label', 'required~min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']');
            $this->form_validation->set_rules('password_confirm', 'lang:reset_password_validation_new_password_confirm_label', 'required~matches[password]');
            if ($this->form_validation->run() === false) {
                // if not submitted yet
                $data['message'] = $this->session->flashdata('message');
                $data['nav'] = array(
                    'list' => lang('login_heading'),
                    'url' => site_url('auth/login')
                );
                $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $data['user'] = $user;
                $data['csrf'] = $this->_get_csrf_nonce();
                $data['code'] = $code;
                $data['title'] = lang('reset_password_heading');
                app('vnk')->view('reset_password', $data);
            } else {
				// do we have a valid request?
                if ($this->_valid_csrf_nonce() === false || $user->id != $this->input->post('user_id')) {
                    // if csrf not valid
                    // something fishy might be up
                    // throw error
                    app('ion_auth')->clear_forgotten_password_code($code);
                    show_error(lang('error_csrf'));
                } else {
					// successfully change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};
                    $change = app('ion_auth')->reset_password($identity, $this->input->post('password'));
                    if ($change) {
						// if the password was successfully changed
                        $this->session->set_flashdata('message', app('ion_auth')->messages());
                        redirect(config_item('login_page'), 'refresh');
                    } else {
                        $this->session->set_flashdata('message', app('ion_auth')->errors());
                        redirect('auth/reset-password/' . $code, 'refresh');
                    }
                }
            }
        } else {
			// if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', app('ion_auth')->errors());
            redirect('auth/forgot-password', 'refresh');
        }
    }
    /*
        / ANONYMOUS METHOD
     */
    
    /*
        USER METHOD
     */
    public function logout()
    {
		// user have to loged in		
        login_required();
        // load libs
        $this->load->library('session');        
		// log the user out
        app('ion_auth')->ion_auth->logout();
		// redirect them to the landing page
        $this->session->set_flashdata('message', app('ion_auth')->messages());
        redirect(config_item('login_page'));
    }
    /*
        / USER METHOD
     */

    /*
        PROTECTED METHOD
     */
    protected function _get_csrf_nonce()
    {
        // load libs
        $this->load->library('session');
        // load helper
        $this->load->helper('string');
        // set vars
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);
        return array($key => $value);
    }

    protected function _valid_csrf_nonce()
    {
        // load libs
        $this->load->library('session');
        $csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
        if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
            return true;
        } else {
            return false;
        }
    }
    /*
        / PROTECTED METHOD
     */
}
