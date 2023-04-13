<?php

namespace App\Controllers;

use App\Controllers;
use Myth\Auth\Models\UserModel;
use App\Models\UsersModel;
use Myth\Auth\Entities\User;
use App\Models\DistribusiModel;

class Admin extends BaseController
{
    protected $db, $builder, $userModel, $usersModel;
    protected $distribusiModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->userModel = new UserModel();
        $this->distribusiModel = new DistribusiModel();
        $this->usersModel = new UsersModel();
    }

    public function index()
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $this->builder->select('users.id as UI, NIK, username, fullname, name, nama_distribusi');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = users.distribusi');
            $this->builder->like('username', $keyword);
            $this->builder->orlike('fullname', $keyword);
            $this->builder->orlike('auth_groups.name', $keyword);
            // $this->builder->orderBy('auth_groups.id');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('users.id as UI, NIK, username, fullname, name, nama_distribusi');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = users.distribusi');
            $this->builder->like('username', $keyword);
            $this->builder->orlike('fullname', $keyword);
            $this->builder->orlike('auth_groups.name', $keyword);
            // $this->builder->orderBy('auth_groups.id');
            $total = $this->builder->countAllResults();
        } else {
            $this->builder->select('users.id as UI, NIK, username, fullname, name, nama_distribusi');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = users.distribusi');
            // $this->builder->orderBy('auth_groups.id');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('users.id as UI, NIK, username, fullname, name, nama_distribusi');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = users.distribusi');
            // $this->builder->orderBy('auth_groups.id');
            $total = $this->builder->countAllResults();
        }

        $data = [
            'title' => 'List Of Users',
            'page' => $page,
            'perPage' => $perPage,
            'total' => $total,
            'offset' => $offset,
            'currentPage' => $currentPage,
            'keyword' => $keyword,
            'countTS' => 0,
            'countPD' => 0,
            'countIM' => 0,
            'countRIM' => 0,
            'countRTS' => 0,
            'countRPD' => 0,
            'countSPD' => 0,
            'countTSPD' => 0,
            'countSTS' => 0,
            'countTSTS' => 0,
            'countSIM' => 0,
            'countTSIM' => 0
        ];

        $data['users'] = $query->getResult();

        return view('admin/index', $data);
    }

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Details Of User',
            'countTS' => 0,
            'countPD' => 0,
            'countIM' => 0,
            'countRIM' => 0,
            'countRTS' => 0,
            'countRPD' => 0,
            'countSPD' => 0,
            'countTSPD' => 0,
            'countSTS' => 0,
            'countTSTS' => 0,
            'countSIM' => 0,
            'countTSIM' => 0
        ];

        $this->builder->select('users.id as UI, users.*, name, nama_distribusi');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = users.distribusi');
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
        $data = [
            'title' => 'Add New User',
            'distribusi' => $this->distribusiModel->getDistribusi(),
            'countTS' => 0,
            'countPD' => 0,
            'countIM' => 0,
            'countRIM' => 0,
            'countRTS' => 0,
            'countRPD' => 0,
            'countSPD' => 0,
            'countTSPD' => 0,
            'countSTS' => 0,
            'countTSTS' => 0,
            'countSIM' => 0,
            'countTSIM' => 0
        ];
        // $this->builder->insert();
        // $query = $this->builder->get();

        return view('admin/create', $data);
    }

    public function edit($id = null)
    {
        $data = [
            'title' => 'Edit Data User',
            'groupsUser' => $this->db->table('auth_groups')->getWhere()->getResultArray(),
            'distribusi' => $this->distribusiModel->getDistribusi(),
            'countTS' => 0,
            'countPD' => 0,
            'countIM' => 0,
            'countRIM' => 0,
            'countRTS' => 0,
            'countRPD' => 0,
            'countSPD' => 0,
            'countTSPD' => 0,
            'countSTS' => 0,
            'countTSTS' => 0,
            'countSIM' => 0,
            'countTSIM' => 0
        ];
        if ($id != null) {
            $query = $this->db->table('users')->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->getWhere(['id' => $id]);

            if ($query->resultID->num_rows > 0) {

                $data['user'] = $query->getRow();

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
        // dd($id);
        $this->usersModel->save([
            'id' => $id,
            'NIK' => $this->request->getVar('NIK'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'distribusi' => $this->request->getVar('department')
        ]);

        $this->db->table('auth_groups_users')->where('user_id', $id)->update([
            'user_id' => $id,
            'group_id' => $this->request->getVar('groups')
        ]);
        return redirect()->to(site_url('/admin'))->with('pesan', 'Data Has Been Changed');
    }

    public function delete($id)
    {
        $this->db->table('users')->where(['id' => $id])->delete();
        session()->setFlashdata('pesan', 'Data Has Been Destroyed');
        return redirect()->to('/admin');
    }

    public function changePassword($id)
    {

        if (in_groups('user')) {
            $data = [
                'title' => 'Change User Password',
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPL(),
                'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                'countIM' => $this->improvementModel->getCountOPL(),
                'countRIM' => $this->improvementModel->getCountReturned(),
                'countRTS' => $this->troubleshootingModel->getCountReturned(),
                'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Change User Password',
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                'countRIM' => $this->improvementModel->getCountCreated(),
                'countRTS' => $this->troubleshootingModel->getCountCreated(),
                'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Change User Password',
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                'countIM' => $this->improvementModel->getCountOPLEngineer(),
                'countRIM' => $this->improvementModel->getCountApproved(),
                'countRTS' => $this->troubleshootingModel->getCountApproved(),
                'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } else {
            $data = [
                'title' => 'Change User Password',
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'password' => $this->usersModel->getUsers($id),
                'countTS' => 0,
                'countPD' => 0,
                'countIM' => 0,
                'countRIM' => 0,
                'countRTS' => 0,
                'countRPD' => 0,
                'countSPD' => 0,
                'countTSPD' => 0,
                'countSTS' => 0,
                'countTSTS' => 0,
                'countSIM' => 0,
                'countTSIM' => 0
            ];
        }
        return view('admin/ubahPassword', $data);
    }

    public function updatePassword($id)
    {

        //Rules for the update password form
        $rules = [
            'old-password' => [
                // 'rules'  => 'required|checkOldPasswords',
                'rules'  => 'required',
                'errors' => [
                    // 'checkOldPasswords' => 'Password Lama Tidak Sesuai',
                    'required' => 'Password Lama Harus Diisi',
                ]
            ],
            'new-password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password Baru Harus Diisi',

                ]
            ],
            'password' => [
                'rules'  => 'required|matches[new-password]',
                'errors' => [
                    'required' => 'Konfirmasi Password Baru Harus Diisi',
                    'matches' => 'Password Tidak Sesuai Dengan Password Baru'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {

            //Create new instance of the MythAuth UserModel
            $users = model(UserModel::class);

            //Get the id of the current user
            $user_id = $id;

            //Create new user entity
            $entity = new User();

            //Get current password from input field
            $newPassword = $this->request->getVar('password');

            //Hash password using the "setPassword" function of the User entity
            $entity->setPassword($newPassword);

            //Save the hashed password in the variable "hash"
            $hash  = $entity->password_hash;

            //update the current users password_hash in the database with the new hashed password.
            $users->update($user_id, ['password_hash' => $hash]);

            //Return back with success message
            return redirect()->to('/admin/' . $id)->with('pesan', "Password Has Been Updated");
        } else {
            $validation = $this->validator->getErrors();
            //Return with errors
            return redirect()->to('/admin/change-password/' . $id)->withInput()->with('errors', $validation);
        }
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
