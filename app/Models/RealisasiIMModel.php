<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiIMModel extends Model
{
    protected $table      = 'realisasi_im';
    protected $useTimeStamps      = True;
    protected $allowedFields = ['id_im', 'tanggal_training', 'id_trainee', 'paraf_trainee', 'id_trainer', 'paraf_trainer'];

    public function getRealisasiIM($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->findAll();
    }
}
