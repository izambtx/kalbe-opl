<?php

namespace App\Controllers;

use App\Models\DistribusiModel;
use App\Models\MesinModel;
use App\Models\RealisasiIMModel;
use App\Models\TroubleShootingModel;
use App\Models\ImprovementModel;
use App\Models\PengetahuanDasarModel;
use App\Models\FotoImModel;

class improvement extends BaseController
{

    protected $improvementModel;
    protected $pengetahuandasarModel;
    protected $troubleshootingModel;
    protected $mesinModel;
    protected $fotoimmodel;
    protected $realisasiIMModel;
    protected $distribusiModel;
    protected $db, $builder;

    public function __construct()
    {
        $this->distribusiModel = new DistribusiModel();
        $this->troubleshootingModel = new TroubleShootingModel();
        $this->pengetahuandasarModel = new PengetahuanDasarModel();
        $this->improvementModel = new ImprovementModel();
        $this->mesinModel = new MesinModel();
        $this->realisasiIMModel = new RealisasiIMModel();
        $this->fotoimmodel = new FotoImModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('opl_improvement');
    }

    public function index($id = 0)
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {

            if (in_groups('supervisor')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $this->builder->where('opl_improvement.status', 'Created');
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $this->builder->where('opl_improvement.status', 'Created');
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $mesin = ['1'];
                $this->builder->whereNotIn('opl_improvement.mesin', $mesin);
                $this->builder->where('opl_improvement.status', 'Approved Supervisor');
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $mesin = ['1'];
                $this->builder->whereNotIn('opl_improvement.mesin', $mesin);
                $this->builder->where('opl_improvement.status', 'Approved Supervisor');
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {

            if (in_groups('supervisor')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $this->builder->where('opl_improvement.status', 'Created');
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $this->builder->where('opl_improvement.status', 'Created');
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $mesin = ['1'];
                $this->builder->whereNotIn('opl_improvement.mesin', $mesin);
                $this->builder->where('opl_improvement.status', 'Approved Supervisor');
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $mesin = ['1'];
                $this->builder->whereNotIn('opl_improvement.mesin', $mesin);
                $this->builder->where('opl_improvement.status', 'Approved Supervisor');
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }

        if (in_groups('user')) {
            $data = [
                'title' => 'Daftar List OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Daftar List OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Daftar List OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        $data['improvement'] = $query->getResultArray();

        return view('improvement/improvement', $data);
    }

    public function detail($id)
    {

        if (in_groups('user')) {
            $data = [
                'title' => 'Detail OPL Improvement',
                'foto_im' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPL(),
                'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                'countIM' => $this->improvementModel->getCountOPL(),
                'countRIM' => $this->improvementModel->getCountReturned(),
                'countRTS' => $this->troubleshootingModel->getCountReturned(),
                'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Detail OPL Improvement',
                'foto_im' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                'countRIM' => $this->improvementModel->getCountCreated(),
                'countRTS' => $this->troubleshootingModel->getCountCreated(),
                'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Detail OPL Improvement',
                'foto_im' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                'countIM' => $this->improvementModel->getCountOPLEngineer(),
                'countRIM' => $this->improvementModel->getCountApproved(),
                'countRTS' => $this->troubleshootingModel->getCountApproved(),
                'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        if (in_groups('supervisor')) {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $query = $this->builder->get();
        } else {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $query = $this->builder->get();
        }

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_improvement.penyetuju');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_improvement.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_improvement.engineer');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_improvement.id', $id);
        $query3 = $this->builder->get();

        $data['improvement'] = $query->getRowArray();

        $data['improvement2'] = $query2->getRowArray();

        $data['improvement3'] = $query3->getRowArray();

        return view('improvement/improvementDetail', $data);
    }

    public function approve($id)
    {
        // dd($this->request->getVar());
        $this->improvementModel->save([
            'id' => $id,
            'penyetuju' => $this->request->getVar('approveopl'),
            'opl_no' => $this->request->getVar('noopl'),
            'status' => 'Approved Supervisor',
            'realisasi' => $this->request->getVar('statusrealisasi'),
            'approved_at' => $this->request->getVar('tglapprove')
        ]);
        return redirect()->to('Improvement/History/' . user()->id)->with('pesan', 'OPL Telah Berhasil Diapprove');
    }

    public function engineer($id)
    {
        // dd($this->request->getVar());
        $this->improvementModel->save([
            'id' => $id,
            'engineer' => $this->request->getVar('approveopl'),
            'status' => 'Approved Engineer',
            'realisasi' => 'TRUE',
            'checked_at' => $this->request->getVar('tglcheck')
        ]);
        return redirect()->to('Improvement/History/' . user()->id)->with('pesan', 'OPL Telah Berhasil Diapprove dan Secara Langsung Telah Tersosialisasi');
    }

    public function rejectedSupervisor($id)
    {
        // dd($this->request->getVar());
        $this->improvementModel->save([
            'id' => $id,
            'rejecter' => $this->request->getVar('rejectopl'),
            'alasan' => $this->request->getVar('alasanreject'),
            'status' => 'Rejected Supervisor',
            'rejected_at' => $this->request->getVar('tglreject')
        ]);
        return redirect()->to('Improvement/History/' . user()->id)->with('pesan', 'OPL Telah Berhasil Direject dan Dikembalikan Kepada Pembuat OPL');
    }

    public function rejectedEngineer($id)
    {
        // dd($this->request->getVar());
        $this->improvementModel->save([
            'id' => $id,
            'rejecter' => $this->request->getVar('rejectopl'),
            'alasan' => $this->request->getVar('alasanreject'),
            'status' => 'Rejected Engineer',
            'rejected_at' => $this->request->getVar('tglreject')
        ]);
        return redirect()->to('Improvement/History/' . user()->id)->with('pesan', 'OPL Telah Berhasil Direject dan Dikembalikan Kepada Pembuat OPL');
    }

    public function returnedSupervisor($id)
    {
        // dd($this->request->getVar());
        $this->improvementModel->save([
            'id' => $id,
            'returner' => $this->request->getVar('returnopl'),
            'alasan' => $this->request->getVar('alasanreturn'),
            'status' => 'Returned Supervisor',
            'returned_at' => $this->request->getVar('tglreturn')
        ]);
        return redirect()->to('Improvement/History/' . user()->id)->with('pesan', 'OPL Telah Berhasil Direturn dan Dikembalikan Kepada Pembuat OPL Agar Dirubah');
    }

    public function returnedEngineer($id)
    {
        // dd($this->request->getVar());
        $this->improvementModel->save([
            'id' => $id,
            'returner' => $this->request->getVar('returnopl'),
            'alasan' => $this->request->getVar('alasanreturn'),
            'status' => 'Returned Engineer',
            'returned_at' => $this->request->getVar('tglreturn')
        ]);
        return redirect()->to('Improvement/History/' . user()->id)->with('pesan', 'OPL Telah Berhasil Direturn dan Dikembalikan Kepada Pembuat OPL Agar Dirubah');
    }

    public function history($id = 0)
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            if (in_groups('supervisor')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {

            if (in_groups('supervisor')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }

        if (in_groups('user')) {
            $data = [
                'title' => 'History OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'History OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'History OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        $data['improvement'] = $query->getResultArray();

        return view('improvement/improvementHistory', $data);
    }


    // BAGIAN INPUT ======================================================================



    public function inputList($id = 0)
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $keyword = $this->request->getVar('keyword');
        $mesin = $this->request->getVar('mesin');
        if ($keyword || $mesin) {

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.pembuat', user_id());
            $status = ['Created'];
            $this->builder->whereIn('opl_improvement.status', $status);
            // $this->builder->whereNotIn('opl_improvement.mesin', $mesin);
            $this->builder->like('opl_improvement.tema', $keyword);
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.pembuat', user_id());
            $status = ['Created'];
            $this->builder->whereIn('opl_improvement.status', $status);
            // $this->builder->whereNotIn('opl_improvement.mesin', $mesin);
            $this->builder->like('opl_improvement.tema', $keyword);
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.pembuat', user_id());
            $status = ['Created'];
            $this->builder->whereIn('opl_improvement.status', $status);
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.pembuat', user_id());
            $status = ['Created'];
            $this->builder->whereIn('opl_improvement.status', $status);
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        if (in_groups('user')) {
            $data = [
                'title' => 'List OPL Improvement',
                'improvement' => $this->improvementModel->getImprovement(),
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'id_user' => $id,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'List OPL Improvement',
                'improvement' => $this->improvementModel->getImprovement(),
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'id_user' => $id,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'List OPL Improvement',
                'improvement' => $this->improvementModel->getImprovement(),
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'id_user' => $id,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }


        $data['improvementUser'] = $query->getResultArray();

        // if (empty($data['improvementUser'])) {
        //     return redirect()->to('/');
        // }


        return view('improvement/improvementList', $data);
    }

    public function detailInput($id)
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 5;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        if (in_groups('supervisor')) {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $total = $this->builder->countAllResults();
        } else {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $total = $this->builder->countAllResults();
        }

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_improvement.penyetuju');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_improvement.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_improvement.engineer');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_improvement.id', $id);
        $query3 = $this->builder->get();

        if (in_groups('user')) {
            $data = [
                'title' => 'Detail OPL Improvement',
                'foto_imU' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'realisasiIM' => $this->db->table('realisasi_im')->select('realisasi_im.*, users.username')->join('users', 'users.id = realisasi_im.id_trainee')->getWhere(['id_im' => $id])->getResultArray(),
                'imUser' => $this->improvementModel->getImprovement($id),
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
                'currentPage' => $currentPage,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Detail OPL Improvement',
                'foto_imU' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'realisasiIM' => $this->db->table('realisasi_im')->select('realisasi_im.*, users.username')->join('users', 'users.id = realisasi_im.id_trainee')->getWhere(['id_im' => $id])->getResultArray(),
                'imUser' => $this->improvementModel->getImprovement($id),
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
                'currentPage' => $currentPage,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Detail OPL Improvement',
                'foto_imU' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'realisasiIM' => $this->db->table('realisasi_im')->select('realisasi_im.*, users.username')->join('users', 'users.id = realisasi_im.id_trainee')->getWhere(['id_im' => $id])->getResultArray(),
                'imUser' => $this->improvementModel->getImprovement($id),
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
                'currentPage' => $currentPage,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        $data['improvementUser'] = $query->getRowArray();

        $data['improvementUser2'] = $query2->getRowArray();

        $data['improvementUser3'] = $query3->getRowArray();

        // Jika data tidak ditemukan
        if (empty($data['improvementUser'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('OPL Berkategori Improvement Tidak Ada');
        }

        return view('improvement/improvementInputDetail', $data);
    }

    public function create()
    {
        // session();

        if (in_groups('user')) {
            $data = [
                'title' => 'Form Create OPL Improvement',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'inputFotoIM' => $this->request->getVar('jumlahFoto'),
                'countOPL' => $this->builder->where('pembuat', user_id())->countAllResults(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPL(),
                'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                'countIM' => $this->improvementModel->getCountOPL(),
                'countRIM' => $this->improvementModel->getCountReturned(),
                'countRTS' => $this->troubleshootingModel->getCountReturned(),
                'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Form Create OPL Improvement',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'inputFotoIM' => $this->request->getVar('jumlahFoto'),
                'countOPL' => $this->builder->where('pembuat', user_id())->countAllResults(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                'countRIM' => $this->improvementModel->getCountCreated(),
                'countRTS' => $this->troubleshootingModel->getCountCreated(),
                'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Form Create OPL Improvement',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'inputFotoIM' => $this->request->getVar('jumlahFoto'),
                'countOPL' => $this->builder->where('pembuat', user_id())->countAllResults(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                'countIM' => $this->improvementModel->getCountOPLEngineer(),
                'countRIM' => $this->improvementModel->getCountApproved(),
                'countRTS' => $this->troubleshootingModel->getCountApproved(),
                'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }


        return view('improvement/improvementInput', $data);
    }

    public function save()
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'tema' => [
                'rules' => 'required|is_unique[opl_improvement.tema]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'fungsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'dampak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'penjelasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'distribusi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->listErrors();
            return redirect()->to('/ListImprovement/CreateImprovement')->withInput()->with('validation', $validation);
        }

        $this->improvementModel->save([
            'tema' => $this->request->getVar('tema'),
            'tujuan' => $this->request->getVar('tujuan'),
            'fungsi' => $this->request->getVar('fungsi'),
            'penjelasan' => $this->request->getVar('penjelasan'),
            'dampak' => $this->request->getVar('dampak'),
            'mesin' => $this->request->getVar('mesin'),
            'status' => 'Created',
            'opl_no' => $this->request->getVar('counter'),
            'pembuat' => $this->request->getVar('pembuat'),
            'id_distribusi' => $this->request->getVar('distribusi')
        ]);

        $id_im = $this->improvementModel->getInsertID();

        $jumlahFotonya = $this->request->getVar('jumlahFileFoto');
        // ambil gambar
        for ($i = 1; $i <= $jumlahFotonya; $i++) {
            $fileFoto[$i] = $this->request->getFile('foto_sebelum' . $i); //ini pake foto_sebelum karena name di inputnya emg gitu biar nyambung sama JS nya juga

            // apakah tidak ada gambar yang diupload
            if ($fileFoto[$i]->getError() == 4) {
                $namaFoto[$i] = 'default.jpg';
            } else {
                // pindahkan file ke folder img
                $fileFoto[$i]->move('img');
                // ambil nama file foto
                $namaFoto[$i] = $fileFoto[$i]->getName();
            }
        }

        for ($x = 1; $x <= $jumlahFotonya; $x++) {

            $keterangan = $this->request->getVar('ket_foto' . $x);
            $pembuat = $this->request->getVar('pembuat');
            $data = [
                'id_im' => $id_im,
                'foto_im'  => $namaFoto[$x],
                'keterangan'  => $keterangan,
                'pembuat'  => $pembuat
            ];
            $this->fotoimmodel->save($data);
        }

        return redirect()->to('ListImprovement/' . user()->id)->with('pesan', 'OPL Berhasil Ditambahkan');
    }

    public function returned($id = 0)
    {

        $page = 1;

        if ($this->request->getGet()) {
            $page = $this->request->getGet('page');
        }

        $currentPage = $this->request->getVar('page') ? $this->request->getVar('page') : 1;

        $perPage = 15;

        $limit = $perPage;
        $offset = ($page - 1) * $perPage;

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {

            if (in_groups('user')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.pembuat', user()->id);
                $status = ['Created'];
                $this->builder->whereNotIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.pembuat', user()->id);
                $status = ['Created'];
                $this->builder->whereNotIn('opl_improvement.status', $status);
                $this->builder->like('opl_improvement.tema', $keyword);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {

            if (in_groups('user')) {
                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.pembuat', user()->id);
                $status = ['Created'];
                $this->builder->whereNotIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
                $this->builder->join('users', 'users.id = opl_improvement.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_improvement.pembuat', user()->id);
                $status = ['Created'];
                $this->builder->whereNotIn('opl_improvement.status', $status);
                $this->builder->orderBy('opl_improvement.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }

        if (in_groups('user')) {
            $data = [
                'title' => 'List Updated Status OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'List Updated Status OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'List Updated Status OPL Improvement',
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        $data['improvementUser'] = $query->getResultArray();

        return view('improvement/improvementStatus', $data);
    }

    public function editReturned($id)
    {
        // session();

        if (in_groups('user')) {
            $data = [
                'title' => 'Form Update Returned OPL Improvement',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'improvement' => $this->improvementModel->getImprovement($id),
                'fotoIM' => $this->fotoimmodel->getFotoIm($id),
                'countFotoIM' => $this->fotoimmodel->getCountFotoIm($id),
                'inputFotoIM' => $this->request->getVar('jumlahFoto'),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPL(),
                'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                'countIM' => $this->improvementModel->getCountOPL(),
                'countRIM' => $this->improvementModel->getCountReturned(),
                'countRTS' => $this->troubleshootingModel->getCountReturned(),
                'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Form Update Returned OPL Improvement',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'improvement' => $this->improvementModel->getImprovement($id),
                'inputFotoIM' => $this->request->getVar('jumlahFoto'),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                'countRIM' => $this->improvementModel->getCountCreated(),
                'countRTS' => $this->troubleshootingModel->getCountCreated(),
                'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Form Update Returned OPL Improvement',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'improvement' => $this->improvementModel->getImprovement($id),
                'inputFotoIM' => $this->request->getVar('jumlahFoto'),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                'countIM' => $this->improvementModel->getCountOPLEngineer(),
                'countRIM' => $this->improvementModel->getCountApproved(),
                'countRTS' => $this->troubleshootingModel->getCountApproved(),
                'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }


        return view('improvement/improvementEdit', $data);
    }

    public function updateReturned($id)
    {

        // CEK TEMA
        $oplLama = $this->improvementModel->getImprovement($id);
        if ($oplLama['tema'] == $this->request->getVar('tema')) {
            $rule_tema = 'required';
        } else {
            $rule_tema = 'required|is_unique[opl_improvement.tema]';
        }

        // VALIDASI INPUT
        if (!$this->validate([
            'tema' => [
                'rules' => $rule_tema,
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'is_unique' => '{field} sudah terdaftar.'
                ]
            ],
            'tujuan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'fungsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'dampak' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'penjelasan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi.'
                ]
            ],
            'distribusi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->listErrors();
            return redirect()->to('/ListImprovement/Edit/DetailsUserImprovement/' . $id)->withInput()->with('validation', $validation);
        }

        $status = $this->request->getVar('status');
        if ($status == 'Returned Supervisor') {
            $status = 'Created';
        } else {
            $status = 'Approved Supervisor';
        }

        $this->improvementModel->save([
            'id' => $id,
            'tema' => $this->request->getVar('tema'),
            'tujuan' => $this->request->getVar('tujuan'),
            'fungsi' => $this->request->getVar('fungsi'),
            'penjelasan' => $this->request->getVar('penjelasan'),
            'dampak' => $this->request->getVar('dampak'),
            'mesin' => $this->request->getVar('mesin'),
            'status' => $status,
            'revisi' => $this->request->getVar('revisi'),
            'id_distribusi' => $this->request->getVar('distribusi')
        ]);

        $jumlahFotonya = $this->request->getVar('jumlahFileFoto');
        // ambil gambar
        for ($i = 1; $i <= $jumlahFotonya; $i++) {
            $fotoLama[$i] = $this->request->getVar('fotoLama' . $i);
            $fileFoto[$i] = $this->request->getFile('foto_sebelum' . $i); //ini pake foto_sebelum karena name di inputnya emg gitu biar nyambung sama JS nya juga

            // apakah gambar tidak berubah
            if ($fileFoto[$i]->getError() == 4) {
                $namaFoto[$i] = $fotoLama[$i];
            } else {
                // pindahkan file ke folder img
                $fileFoto[$i]->move('img');
                // hapus foto lama
                unlink('img/' . $fotoLama[$i]);
                // ambil nama file foto
                $namaFoto[$i] = $fileFoto[$i]->getName();
            }
        }

        for ($x = 1; $x <= $jumlahFotonya; $x++) {

            $fotoID = $this->request->getVar('fotoID' . $x);
            $keterangan = $this->request->getVar('ket_foto' . $x);
            $data = [
                'id' => $fotoID,
                'foto_im'  => $namaFoto[$x],
                'keterangan'  => $keterangan
            ];
            $this->fotoimmodel->save($data);
        }

        if ($status == 'Created') {
            return redirect()->to('ListImprovement/' . user()->id)->with('pesan', 'OPL Berhasil Terupdate, Supervisor/Engineer Akan Memeriksa Ulang');
        } else {
            return redirect()->to('ListImprovement/Status/' . user()->id)->with('pesan', 'OPL Berhasil Terupdate, Supervisor/Engineer Akan Memeriksa Ulang');
        }
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

        // d($this->request->getVar('keyword'));
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {

            // if (in_groups('supervisor')) {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
            $this->builder->where('opl_improvement.realisasi', 'TRUE');
            $this->builder->like('opl_improvement.tema', $keyword);
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
            $this->builder->where('opl_improvement.realisasi', 'TRUE');
            $this->builder->like('opl_improvement.tema', $keyword);
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            // if (in_groups('supervisor')) {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
            $this->builder->where('opl_improvement.realisasi', 'TRUE');
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id_distribusi', user()->distribusi);
            $this->builder->where('opl_improvement.realisasi', 'TRUE');
            $this->builder->orderBy('opl_improvement.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }
        // } else {
        // }

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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
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
                'currentPage' => $currentPage,
                'keyword' => $keyword,
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        $data['improvementUserMesin'] = $query->getResultArray();

        // if (empty($data['improvementUser'])) {
        //     return redirect()->to('/');
        // }


        return view('improvement/improvementListRealisasi', $data);
    }

    public function detailRealisasi($id)
    {

        if (in_groups('user')) {
            $data = [
                'title' => 'Detail Sosialisasi OPL Improvement',
                'foto_imU' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'imUser' => $this->improvementModel->getImprovement($id),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPL(),
                'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                'countIM' => $this->improvementModel->getCountOPL(),
                'countRIM' => $this->improvementModel->getCountReturned(),
                'countRTS' => $this->troubleshootingModel->getCountReturned(),
                'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Detail Sosialisasi OPL Improvement',
                'foto_imU' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'imUser' => $this->improvementModel->getImprovement($id),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                'countRIM' => $this->improvementModel->getCountCreated(),
                'countRTS' => $this->troubleshootingModel->getCountCreated(),
                'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif (in_groups('engineer')) {
            $data = [
                'title' => 'Detail Sosialisasi OPL Improvement',
                'foto_imU' => $this->db->table('foto_improvement')->getWhere(['id_im' => $id])->getResultArray(),
                'imUser' => $this->improvementModel->getImprovement($id),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                'countIM' => $this->improvementModel->getCountOPLEngineer(),
                'countRIM' => $this->improvementModel->getCountApproved(),
                'countRTS' => $this->troubleshootingModel->getCountApproved(),
                'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        if (in_groups('supervisor')) {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $query = $this->builder->get();
        } else {
            $this->builder->select('opl_improvement.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_improvement.mesin');
            $this->builder->join('users', 'users.id = opl_improvement.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_improvement.id', $id);
            $query = $this->builder->get();
        }

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_improvement.penyetuju');
        $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('opl_improvement.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_improvement.engineer');
        $this->builder->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('opl_improvement.id', $id);
        $query3 = $this->builder->get();

        $data['improvementUser'] = $query->getRowArray();

        $data['improvementUser2'] = $query2->getRowArray();

        $data['improvementUser3'] = $query3->getRowArray();

        // Jika data tidak ditemukan
        if (empty($data['improvementUser'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('OPL Berkategori Improvement Tidak Ada');
        }

        return view('improvement/improvementDetailRealisasi', $data);
    }
}
