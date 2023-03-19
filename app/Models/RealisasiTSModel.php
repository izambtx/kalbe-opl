<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiTSModel extends Model
{
    protected $table      = 'realisasi_ts';
    protected $useTimeStamps      = True;
    protected $allowedFields = ['id_ts', 'tanggal_training', 'id_trainee', 'paraf_trainee', 'id_trainer', 'paraf_trainer'];

    public function getRealisasiTS($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->findAll();
    }

    public function getRealisasi($id = false)
    {

        return $this->where(['id_ts' => $id])->first();
    }

    public function getRealisasiTrainee($id = false)
    {

        return $this->where(['id_trainee' => user_id()])->groupBy('id_ts')->findAll();
    }
}
