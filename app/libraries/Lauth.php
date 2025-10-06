<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Lauth
{
    protected $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->database();
        $this->_lava->call->library('session');
        $this->_lava->call->model('StudentsModel');
    }

    /**
     * Register a new user
     *
     * @param string $first_name
     * @param string $last_name
     * @param string $email
     * @param string $password
     * @param string $role
     * @return bool
     */
    public function register($first_name, $last_name, $email, $password, $role = 'user')
    {

        $existing_user = $this->_lava->db->table('students')
                               ->where('email', $email)
                               ->where('password', $password)
                               ->get();

        if ($existing_user) {
            return false; 
        }

        return $this->_lava->StudentsModel->insert([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $password
        ]);
    }

    /**
     * Login user
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public function login($email, $password)
    {
        $user = $this->_lava->db->table('students')
                        ->where('email', $email)
                        ->where('password', $password)
                        ->get();

        if ($user && $user['password'] === $password) {
            $this->_lava->session->set_userdata([
                'user_id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'logged_in' => true
            ]);
            return true;
        }

        return false;
    }

    /**
     * Check if user is logged in
     *
     * @return bool
     */
    public function is_logged_in()
    {
        return (bool) $this->_lava->session->userdata('logged_in');
    }

    /**
     * Check user role
     *
     * @param string $role
     * @return bool
     */
    public function has_role($role)
    {
        // Since we removed roles, always return true for basic access
        return true;
    }

    /**
     * Get current user data
     *
     * @return array|null
     */
    public function get_user_data()
    {
        if ($this->is_logged_in()) {
            return [
                'user_id' => $this->_lava->session->userdata('user_id'),
                'first_name' => $this->_lava->session->userdata('first_name'),
                'last_name' => $this->_lava->session->userdata('last_name'),
                'email' => $this->_lava->session->userdata('email')
            ];
        }
        return null;
    }

    /**
     * Logout user
     *
     * @return void
     */
    public function logout()
    {
        $this->_lava->session->unset_userdata(['user_id', 'first_name', 'last_name', 'email', 'logged_in']);
    }
}