<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class Auth extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('lauth');
    }

    /**
     * Display login form and handle login submission
     */
    public function login()
    {
        // If user is already logged in, redirect to users list
        if ($this->lauth->is_logged_in()) {
            redirect('users');
        }

        $data = [];

        if ($this->io->method() == 'post') {
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            if (empty($email) || empty($password)) {
                $data['error'] = 'Please fill in all fields.';
            } else {
                if ($this->lauth->login($email, $password)) {
                    redirect('users');
                } else {
                    $data['error'] = 'Invalid email or password.';
                }
            }
        }

        $this->call->view('ui/login', $data);
    }

    /**
     * Display register form and handle registration submission
     */
    public function register()
    {
        // If user is already logged in, redirect to users list
        if ($this->lauth->is_logged_in()) {
            redirect('users');
        }

        $data = [];

        if ($this->io->method() == 'post') {
            $first_name = $this->io->post('first_name');
            $last_name = $this->io->post('last_name');
            $email = $this->io->post('email');
            $password = $this->io->post('password');

            if (empty($first_name) || empty($last_name) || empty($email) || empty($password)) {
                $data['error'] = 'Please fill in all fields.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Please enter a valid email address.';
            } elseif (strlen($password) < 6) {
                $data['error'] = 'Password must be at least 6 characters long.';
            } else {
                if ($this->lauth->register($first_name, $last_name, $email, $password)) {
                    $data['success'] = 'Registration successful! You can now login.';
                } else {
                    $data['error'] = 'Email already exists. Please use a different email.';
                }
            }
        }

        $this->call->view('ui/register', $data);
    }

    /**
     * Logout user and redirect to login
     */
    public function logout()
    {
        $this->lauth->logout();
        redirect('auth/login');
    }
}