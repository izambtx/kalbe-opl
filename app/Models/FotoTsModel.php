<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoTsModel extends Model
{
    protected $table      = 'foto_trouble_shooting';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_ts', 'foto_ts', 'keterangan', 'pembuat'];

    public function getFotoTs($id = 0)
    {
        if ($id == 0) {
            return $this->findAll();
        }

        return $this->where('id_ts', $id)->findAll();
    }

    public function getCountFotoTs($id = 0)
    {
        return $this->where(['id_ts' => $id])->countAllResults();
    }
}
