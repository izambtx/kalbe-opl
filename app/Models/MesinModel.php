<?php

namespace App\Models;

use CodeIgniter\Model;

class MesinModel extends Model
{
    protected $table      = 'mesin';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['nama_mesin'];

    public function getMesin($id = false)
    {
        if ($id == false) {
            return $this->orderBy('nama_mesin')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
