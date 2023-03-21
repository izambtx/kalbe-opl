<?php

namespace App\Models;

use CodeIgniter\Model;

class RealisasiPDModel extends Model
{
    protected $table      = 'realisasi_pd';
    protected $useTimeStamps      = True;
    protected $allowedFields = ['id_pd', 'tanggal_training', 'id_trainee', 'paraf_trainee', 'id_trainer', 'paraf_trainer'];

    public function getRealisasiPD($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->findAll();
    }

    public function getRealisasi($id = false)
    {

        return $this->where(['id_pd' => $id])->first();
    }

    public function getRealisasiTrainee($id = false)
    {

        return $this->where(['id_trainee' => user_id()])->groupBy('id_pd')->findAll();
    }
}
