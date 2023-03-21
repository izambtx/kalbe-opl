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

    public function getRealisasi($id = false)
    {

        return $this->where(['id_im' => $id])->first();
    }

    public function getRealisasiTrainee($id = false)
    {

        return $this->where(['id_trainee' => user_id()])->groupBy('id_im')->findAll();
    }
}
