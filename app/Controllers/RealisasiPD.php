<?php

namespace App\Controllers;

use App\Models\DistribusiModel;
use App\Models\MesinModel;
use App\Models\PengetahuanDasarModel;
use App\Models\ImprovementModel;
use App\Models\TroubleShootingModel;
use App\Models\RealisasiPDModel;

class RealisasiPD extends BaseController
{

    protected $troubleshootingModel, $pengetahuandasarModel, $improvementModel;
    protected $mesinModel;
    protected $realisasiPDModel;
    protected $distribusiModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->pengetahuandasarModel = new PengetahuanDasarModel();
        $this->improvementModel = new ImprovementModel();
        $this->realisasiPDModel = new RealisasiPDModel();
        $this->distribusiModel = new DistribusiModel();
        $this->troubleshootingModel = new TroubleShootingModel();
        $this->mesinModel = new MesinModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('realisasi_pd');
    }

    public function realisasiList($id = 0)
    {

        if (in_groups('user')) {
            $this->builder->select('opl_pengetahuan_dasar.*, realisasi_pd.*');
            $this->builder->join('opl_pengetahuan_dasar', 'opl_pengetahuan_dasar.id = realisasi_pd.id_pd');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $user = [user()->id];
            $this->builder->whereNotIn('realisasi_pd.id_trainee', $user);
            $this->builder->where('opl_pengetahuan_dasar.realisasi', 'TRUE');
            $query = $this->builder->get();
            // } else {
        }
        $data['realisasiPD'] = $query->getResultArray();


        return view('pengetahuandasar/pengetahuandasarListRealisasi', $data);
    }

    public function realisasiTrainerList($id = 0)
    {

        if (in_groups('user')) {
            $this->builder->select('realisasi_pd.*, opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
            $this->builder->join('opl_pengetahuan_dasar', 'opl_pengetahuan_dasar.id = realisasi_pd.id_pd');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $user = [user()->id];
            $this->builder->whereNotIn('realisasi_pd.id_trainee', $user);
            $this->builder->where('opl_pengetahuan_dasar.realisasi', 'TRUE');
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $query = $this->builder->get();
            // } else {
        }
        $data['realisasiPD'] = $query->getResultArray();


        return view('pengetahuandasar/pengetahuandasarInputDetail', $data);
    }

    public function submitRealisasi($id)
    {
        // dd($this->request->getVar());
        $this->realisasiPDModel->save([
            'id_pd' => $id,
            'tanggal_training' => date('Y-m-d H:i:s'),
            'id_trainee' => user()->id,
            'paraf_trainee' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('List-Sosialisasi-PengetahuanDasar')->with('pesan', 'Berhasil Training OPL Pengetahuan Dasar');
    }

    public function parafTrainer($id)
    {
        // dd($this->request->getVar());
        $this->realisasiPDModel->save([
            'id' => $this->request->getVar('id'),
            'id_pd' => $id,
            'id_trainer' => user()->id,
            'paraf_trainer' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/' . $id)->with('pesan', 'Berhasil Menyetujui Trainer OPL Pengetahuan Dasar');
    }

    public function deleteTrainee($id)
    {
        $id_realisasi = $this->request->getVar('id');
        // dd($id);
        $this->realisasiPDModel->delete($id_realisasi);

        return redirect()->to('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/' . $id)->with('pesan', 'Berhasil Membatalkan Trainer OPL Pengetahuan Dasar');
    }
}
