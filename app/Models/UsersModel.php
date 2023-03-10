<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id', 'password_hash', 'updated_at'];

    public function getEngineer($id = false)
    {
        return $this->join('auth_groups_users', 'auth_groups_users.user_id = users.id')->where('auth_groups_users.group_id', '4')->findAll();
    }

    public function getDistribusiUsers($distribusi = false)
    {
        return $this->join('distribusi', 'distribusi.id = users.distribusi')->where('users.distribusi', $distribusi)->findAll();
    }

    public function getUsers($id = false)
    {
        if ($id == false) {
            return $this->orderBy('fullname')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
