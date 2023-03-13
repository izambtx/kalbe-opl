<?php

namespace App\Controllers;

use App\Controllers;
use Myth\Auth\Models\UserModel;

class Admin extends BaseController
{
    protected $db, $builder, $usersModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->usersModel = new UserModel();
    }

    public function index()
    {
        $users = $this->usersModel->findAll();

        $data = [
            'title' => 'List Of User',
            'users' => $users
        ];



        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        $this->builder->select('users.id as UI, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        return view('admin/index', $data);
    }

    public function detail($id = 0)
    {
        $data['title'] = 'Detail Of User';

        $this->builder->select('users.id as UI, username, email, user_image, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }

    public function create()
    {
        // $data = [
        //     'title' => 'Add New User'
        // ];

        $data['title'] = 'Add New User';
        // $this->builder->insert();
        // $query = $this->builder->get();

        return view('admin/create', $data);
    }

    public function edit($id = null)
    {
        if ($id != null) {
            $query = $this->db->table('users')->getWhere(['id' => $id]);
            if ($query->resultID->num_rows > 0) {

                $data['users'] = $query->getRow();

                return view('admin/edit', $data);
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function update($id)
    {
        // $data = $this->request->getPost();
        // unset($data['_method']);

        $data = [
            'username'      => $this->request->getVar('username'),
            'email'         => $this->request->getVar('email'),
            'password_hash' => $this->request->getVar('password'),
        ];

        $this->db->table('users')->where(['id' => $id])->update($data);
        return redirect()->to(site_url('/admin'))->with('success', 'Data Has Been Changed');
    }

    public function delete($id)
    {
        // $this->builder->delete($id);
        // $this->builder->where('users.id', $id);
        $this->db->table('users')->where(['id' => $id])->delete();
        session()->setFlashdata('success', 'Data Has Been Destroyed');
        return redirect()->to('/admin');

        // $data['title'] = 'Delete User';

        // $this->builder->delete($id);
        // $query = $this->builder->get();
        // $data['users'] = $query->getRow();

        // return view('/admin', $data);
    }

    public function edit_my_admin()
    {

        $data['title'] = 'Edit My Profile';

        return view('/admin/edit_my_admin', $data);
    }

    public function edit_my_profile()
    {

        $data['title'] = 'Edit My Profile';

        return view('/edit_my_profile', $data);
    }
}
