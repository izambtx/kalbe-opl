<?php

namespace App\Models;

use CodeIgniter\Model;

class DistribusiModel extends Model
{
    protected $table      = 'distribusi';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nama_distribusi'];

    public function getDistribusi($id = false)
    {
        if ($id == false) {
            return $this->orderBy('nama_distribusi')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
