<?php

namespace App\Controllers;

use App\Models\DistribusiModel;
use App\Models\MesinModel;
use App\Models\PengetahuanDasarModel;
use App\Models\ImprovementModel;
use App\Models\TroubleShootingModel;
use App\Models\RealisasiIMModel;

class RealisasiIM extends BaseController
{

    protected $troubleshootingModel, $pengetahuandasarModel, $improvementModel;
    protected $mesinModel;
    protected $realisasiIMModel;
    protected $distribusiModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->pengetahuandasarModel = new PengetahuanDasarModel();
        $this->improvementModel = new ImprovementModel();
        $this->realisasiIMModel = new RealisasiIMModel();
        $this->distribusiModel = new DistribusiModel();
        $this->troubleshootingModel = new TroubleShootingModel();
        $this->mesinModel = new MesinModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('realisasi_im');
    }

    public function realisasiList($id = 0)
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        if (in_groups('user')) {
            $this->builder->select('opl_improvement.*');
            $this->builder->join('opl_improvement', 'opl_improvement.id = realisasi_im.id_im');
            $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
            $user = [user()->id];
            $this->builder->whereNotIn('realisasi_im.id_trainee', $user);
            $this->builder->where('opl_improvement.realisasi', 'TRUE');
            $query = $this->builder->get($limit, $offset);
            // } else {
            $this->builder->select('opl_improvement.*');
            $this->builder->join('opl_improvement', 'opl_improvement.id = realisasi_im.id_im');
            $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
            $user = [user()->id];
            $this->builder->whereNotIn('realisasi_im.id_trainee', $user);
            $this->builder->where('opl_improvement.realisasi', 'TRUE');
            $total = $this->builder->countAllResults();
        }

        if (in_groups('user')) {
            $data = [
                'title' => 'List Sosialisasi OPL Improvement',
                'improvementUser' => $this->improvementModel->getImprovement(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPL(),
                'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                'countIM' => $this->improvementModel->getCountOPL(),
                'countRIM' => $this->improvementModel->getCountReturned(),
                'countRTS' => $this->troubleshootingModel->getCountReturned(),
                'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                'page' => $page,
                'perPage' => $perPage,
                'total' => $total,
                'offset' => $offset,
                'currentPage' => $currentPage
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'List Sosialisasi OPL Improvement',
                'improvementUser' => $this->improvementModel->getImprovement(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                'countRIM' => $this->improvementModel->getCountCreated(),
                'countRTS' => $this->troubleshootingModel->getCountCreated(),
                'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                'page' => $page,
                'perPage' => $perPage,
                'total' => $total,
                'offset' => $offset,
                'currentPage' => $currentPage
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'List Sosialisasi OPL Improvement',
                'improvementUser' => $this->improvementModel->getImprovement(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                'countIM' => $this->improvementModel->getCountOPLEngineer(),
                'countRIM' => $this->improvementModel->getCountApproved(),
                'countRTS' => $this->troubleshootingModel->getCountApproved(),
                'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                'page' => $page,
                'perPage' => $perPage,
                'total' => $total,
                'offset' => $offset,
                'currentPage' => $currentPage
            ];
        }

        $data['improvementUserMesin'] = $query->getResultArray();


        return view('improvement/improvementListRealisasi', $data);
    }

    public function realisasiTrainerList($id = 0)
    {

        if (in_groups('user')) {
            $this->builder->select('realisasi_im.*, opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
            $this->builder->join('opl_improvement', 'opl_improvement.id = realisasi_im.id_im');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
            $user = [user()->id];
            $this->builder->whereNotIn('realisasi_im.id_trainee', $user);
            $this->builder->where('opl_improvement.realisasi', 'TRUE');
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $query = $this->builder->get();
            // } else {
        }
        $data['realisasiIM'] = $query->getResultArray();


        return view('improvement/improvementInputDetail', $data);
    }

    public function submitRealisasi($id)
    {
        // dd($this->request->getVar());
        $this->realisasiIMModel->save([
            'id_im' => $id,
            'tanggal_training' => date('Y-m-d H:i:s'),
            'id_trainee' => user()->id,
            'paraf_trainee' => date('Y-m-d H:i:s')
        ]);
        return redirect()->to('List-Sosialisasi-Improvement')->with('pesan', 'Berhasil Training OPL Improvement');
    }

    public function parafTrainer($id)
    {
        // dd($id);
        $this->realisasiIMModel->save([
            'id' => $this->request->getVar('id'),
            'id_im' => $id,
            'id_trainer' => user()->id,
            'paraf_trainer' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/ListImprovement/DetailsUserImprovement/' . $id)->with('pesan', 'Berhasil Menyetujui Trainee OPL Improvement');
    }

    public function deleteTrainee($id)
    {
        $id_realisasi = $this->request->getVar('id');
        // dd($id);
        $this->realisasiIMModel->delete($id_realisasi);

        return redirect()->to('/ListImprovement/DetailsUserImprovement/' . $id)->with('pesan', 'Berhasil Membatalkan Trainee OPL Pengetahuan Dasar');
    }
}
