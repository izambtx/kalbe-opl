<?php

namespace App\Models;

use CodeIgniter\Model;

class FotoPdModel extends Model
{
    protected $table      = 'foto_pengetahuan_dasar';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['id_pd', 'foto_pd', 'keterangan', 'pembuat'];

    public function getFotoPd($id = 0)
    {
        if ($id == 0) {
            return $this->findAll();
        }

        return $this->where('id_pd', $id)->findAll();
    }

    public function getCountFotoPd($id = 0)
    {
        return $this->where(['id_pd' => $id])->countAllResults();
    }

    public function getSingleFotoPd($id = 0)
    {
        return $this->distinct()->join('opl_pengetahuan_dasar', 'opl_pengetahuan_dasar.id = foto_pengetahuan_dasar.id_pd')->groupBy('id_pd')->findAll();
    }
}
