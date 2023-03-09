<?php

namespace App\Controllers;

use App\Models\DistribusiModel;
use App\Models\MesinModel;
use App\Models\PengetahuanDasarModel;
use App\Models\ImprovementModel;
use App\Models\TroubleShootingModel;
use App\Models\RealisasiTSModel;

class RealisasiTS extends BaseController
{

    protected $troubleshootingModel, $pengetahuandasarModel, $improvementModel;
    protected $mesinModel;
    protected $realisasiTSModel;
    protected $distribusiModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->pengetahuandasarModel = new PengetahuanDasarModel();
        $this->improvementModel = new ImprovementModel();
        $this->realisasiTSModel = new RealisasiTSModel();
        $this->distribusiModel = new DistribusiModel();
        $this->troubleshootingModel = new TroubleShootingModel();
        $this->mesinModel = new MesinModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('realisasi_ts');
    }

    public function realisasiList($id = 0)
    {

        if (in_groups('user')) {
            $this->builder->select('opl_trouble_shooting.*, realisasi_ts.*');
            $this->builder->join('opl_trouble_shooting', 'opl_trouble_shooting.id = realisasi_ts.id_ts');
            $this->builder->where('opl_trouble_shooting.id_distribusi', user()->distribusi);
            $user = [user()->id];
            $this->builder->whereNotIn('realisasi_ts.id_trainee', $user);
            $this->builder->where('opl_trouble_shooting.realisasi', 'TRUE');
            $query = $this->builder->get();
            // } else {
        }
        $data['realisasiTS'] = $query->getResultArray();


        return view('troubleshooting/troubleshootingListRealisasi', $data);
    }

    public function realisasiTrainerList($id = 0)
    {

        if (in_groups('user')) {
            $this->builder->select('realisasi_ts.*, opl_trouble_shooting.*, distribusi.nama_distribusi, mesin.nama_mesin');
            $this->builder->join('opl_trouble_shooting', 'opl_trouble_shooting.id = realisasi_ts.id_ts');
            $this->builder->join('mesin', 'mesin.id = opl_trouble_shooting.mesin');
            $this->builder->join('users', 'users.id = opl_trouble_shooting.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_trouble_shooting.id_distribusi', user()->distribusi);
            $user = [user()->id];
            $this->builder->whereNotIn('realisasi_ts.id_trainee', $user);
            $this->builder->where('opl_trouble_shooting.realisasi', 'TRUE');
            $this->builder->orderBy('opl_trouble_shooting.created_at', 'DESC');
            $query = $this->builder->get();
            // } else {
        }
        $data['realisasiTS'] = $query->getResultArray();


        return view('troubleshooting/troubleshootingInputDetail', $data);
    }

    public function submitRealisasi($id)
    {
        // dd($this->request->getVar());
        $this->realisasiTSModel->save([
            'id_ts' => $id,
            'tanggal_training' => date('Y-m-d H:i:s'),
            'id_trainee' => user()->id,
            'paraf_trainee' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('List-Sosialisasi-TroubleShooting')->with('pesan', 'Berhasil Training OPL Trouble Shooting');
    }

    public function parafTrainer($id)
    {
        // dd($this->request->getVar());
        $this->realisasiTSModel->save([
            'id' => $this->request->getVar('id'),
            'id_ts' => $id,
            'id_trainer' => user()->id,
            'paraf_trainer' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/ListTroubleShooting/DetailsUserTroubleShooting/' . $id)->with('pesan', 'Berhasil Menyetujui Trainer OPL Trouble Shooting');
    }

    public function deleteTrainee($id)
    {
        $id_realisasi = $this->request->getVar('id');
        // dd($id);
        $this->realisasiTSModel->delete($id_realisasi);

        return redirect()->to('/ListTroubleShooting/DetailsUserTroubleShooting/' . $id)->with('pesan', 'Berhasil Membatalkan Trainer OPL Pengetahuan Dasar');
    }
}
