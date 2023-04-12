<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoImModel extends Model
{
    protected $table      = 'foto_improvement';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_im', 'foto_im', 'keterangan', 'pembuat'];

    public function getFotoIm($id = 0)
    {
        if ($id == 0) {
            return $this->findAll();
        }

        return $this->where('id_im', $id)->findAll();
    }

    public function getCountFotoIm($id = 0)
    {
        return $this->where(['id_im' => $id])->countAllResults();
    }

    public function getSingleFotoIm($id = 0)
    {
        return $this->distinct()->join('opl_improvement', 'opl_improvement.id = foto_improvement.id_im')->groupBy('id_im')->findAll();
    }
}
