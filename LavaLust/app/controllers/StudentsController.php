<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class StudentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('pagination');

        $this->pagination->set_theme('custom');
        $this->pagination->set_custom_classes([
            'nav' => 'pagination-nav',
            'ul' => 'pagination-list',
            'li' => 'pagination-item',
            'a' => 'pagination-link',
            'active' => 'active'
        ]);

    }
    public function get_all($page = 1)
    {
        try {
            $per_page = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 10;
            $allowed_per_page = [10, 25, 50, 100];
            if (!in_array($per_page, $allowed_per_page)) {
                $per_page = 10;
            }
            $search = isset($_GET['search']) ? trim($_GET['search']) : null;
            $total_rows = $this->StudentsModel->count_all_records($search);

            $query_params = [];
            if ($search) {
                $query_params['search'] = $search;
            }
            if (isset($_GET['per_page'])) {
                $query_params['per_page'] = $_GET['per_page'];
            }

            $pagination_data = $this->pagination->initialize(
                $total_rows,
                $per_page,
                $page,
                '/users/get-all',
                5,
                $query_params
            );

            $data['records'] = $this->StudentsModel->get_records_with_pagination($pagination_data['limit'], $search);
            $data['total_records'] = $total_rows;
            $data['pagination_data'] = $pagination_data;
            $data['pagination_links'] = $this->pagination->paginate();

            $this->call->view('ui/get_all', $data);

        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Failed to load records: ' . $e->getMessage());
            redirect('users/get-all');
        }
    }

    function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email' => $_POST['email']
            ];
            $this->StudentsModel->insert($data);
            redirect('users');
        }
        $this->call->view('ui/create');
    }
    function update($id)
    {
        $contents = $this->StudentsModel->find($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'last_name' => $_POST['last_name'],
                'first_name' => $_POST['first_name'],
                'email' => $_POST['email']
            ];
            $this->StudentsModel->update($id, $data);
            redirect('users');
        }
        $this->call->view('ui/update', ['user' => $contents]);
    }
    function delete($id)
    {
        $this->StudentsModel->soft_delete($id);
        redirect('users');
    }

    public function search()
    {
        $query = $this->input->get('q');
        $data['users'] = $this->User_model->search_users($query);
        $this->load->view('partials/user_rows', $data); // returns only <tr> rows
    }
}
