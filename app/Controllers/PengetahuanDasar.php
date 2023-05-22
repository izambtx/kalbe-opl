<?php

namespace App\Controllers;

use App\Models\DistribusiModel;
use App\Models\MesinModel;
use App\Models\RealisasiPDModel;
use App\Models\TroubleShootingModel;
use App\Models\ImprovementModel;
use App\Models\PengetahuanDasarModel;
use App\Models\FotoPdModel;
use \Dompdf\Dompdf;
use App\Models\UsersModel;

class pengetahuandasar extends BaseController
{

    protected $improvementModel;
    protected $pengetahuandasarModel;
    protected $troubleshootingModel;
    protected $mesinModel;
    protected $realisasiPDModel;
    protected $fotopdmodel;
    protected $distribusiModel;
    protected $dompdf;
    protected $db, $builder, $usersModel;

    public function __construct()
    {
        $this->distribusiModel = new DistribusiModel();
        $this->troubleshootingModel = new TroubleShootingModel();
        $this->pengetahuandasarModel = new PengetahuanDasarModel();
        $this->improvementModel = new ImprovementModel();
        $this->mesinModel = new MesinModel();
        $this->realisasiPDModel = new RealisasiPDModel();
        $this->fotopdmodel = new FotoPdModel();
        $this->usersModel = new UsersModel();
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('opl_pengetahuan_dasar');
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
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Supervisor', 'Created'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Supervisor', 'Created'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {
            if (in_groups('supervisor')) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Supervisor', 'Created'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Supervisor', 'Created'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }


        if (in_groups('user')) {
            $data = [
                'title' => 'Daftar List OPL Pengetahuan Dasar',
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
                'title' => 'Daftar List OPL Pengetahuan Dasar',
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
                'title' => 'Daftar List OPL Pengetahuan Dasar',
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

        $data['pengetahuandasar'] = $query->getResultArray();

        return view('pengetahuandasar/pengetahuandasar', $data);
    }

    public function detail($id)
    {


        if (in_groups('user')) {
            $data = [
                'title' => 'Detail OPL Pengetahuan Dasar',
                'foto_pd' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
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
                'title' => 'Detail OPL Pengetahuan Dasar',
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
                'foto_pd' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
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
                'title' => 'Detail OPL Pengetahuan Dasar',
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
                'foto_pd' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
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
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $query = $this->builder->get();
        } else {
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $query = $this->builder->get();
        }

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.penyetuju');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_pengetahuan_dasar.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.engineer');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_pengetahuan_dasar.id', $id);
        $query3 = $this->builder->get();

        $data['pengetahuandasar'] = $query->getRowArray();

        $data['pengetahuandasar2'] = $query2->getRowArray();

        $data['pengetahuandasar3'] = $query3->getRowArray();

        return view('pengetahuandasar/pengetahuandasarDetail', $data);
    }

    public function approve($id)
    {

        $sdwi = $this->request->getVar('sdwi');
        $sdwi_no = "NA";
        if ($sdwi == 'NA' || $sdwi == 'na' || $sdwi == '' || $sdwi == ' ' || $sdwi == 'tidak ada' || $sdwi == 'Tidak Ada' || $sdwi == 'Tidak ada') {
            $sdwi_no == 'NA';
        } else {
            $sdwi_no = $sdwi;
        }

        // dd($sdwi_no);

        $this->pengetahuandasarModel->save([
            'id' => $id,
            'penyetuju' => $this->request->getVar('approveopl'),
            'opl_no' => $this->request->getVar('noopl'),
            'status' => 'Approved Supervisor',
            'sd/wi_no' => $sdwi_no,
            'realisasi' => $this->request->getVar('statusrealisasi'),
            'approved_at' => $this->request->getVar('tglapprove')
        ]);
        return redirect()->to('PengetahuanDasar/History')->with('pesan', 'OPL Telah Berhasil Diapprove');
    }

    public function engineer($id)
    {
        // dd($this->request->getVar());
        if (in_groups('supervisor')) {
            $this->pengetahuandasarModel->save([
                'id' => $id,
                'engineer' => $this->request->getVar('approveopl'),
                'status' => 'Approved Engineer',
                'opl_no' => $this->request->getVar('noopl'),
                'realisasi' => 'TRUE',
                'checked_at' => $this->request->getVar('tglcheck')
            ]);
        } elseif (in_groups('engineer')) {
            $this->pengetahuandasarModel->save([
                'id' => $id,
                'engineer' => $this->request->getVar('approveopl'),
                'status' => 'Approved Engineer',
                'opl_no' => $this->request->getVar('noopl'),
                'realisasi' => 'TRUE',
                'checked_at' => $this->request->getVar('tglcheck')
            ]);
        }
        return redirect()->to('PengetahuanDasar/History')->with('pesan', 'OPL Telah Berhasil Diapprove dan Secara Langsung Telah Tersosialisasi');
    }

    public function rejectedSupervisor($id)
    {
        // dd($this->request->getVar());
        $this->pengetahuandasarModel->save([
            'id' => $id,
            'rejecter' => $this->request->getVar('rejectopl'),
            'alasan' => $this->request->getVar('alasanreject'),
            'status' => 'Rejected Supervisor',
            'rejected_at' => $this->request->getVar('tglreject')
        ]);
        return redirect()->to('PengetahuanDasar/History')->with('pesan', 'OPL Telah Berhasil Direject dan Dikembalikan Kepada Pembuat OPL');
    }

    public function rejectedEngineer($id)
    {
        // dd($this->request->getVar());
        $this->pengetahuandasarModel->save([
            'id' => $id,
            'rejecter' => $this->request->getVar('rejectopl'),
            'alasan' => $this->request->getVar('alasanreject'),
            'status' => 'Rejected Engineer',
            'rejected_at' => $this->request->getVar('tglreject')
        ]);
        return redirect()->to('PengetahuanDasar/History')->with('pesan', 'OPL Telah Berhasil Direject dan Dikembalikan Kepada Pembuat OPL');
    }

    public function returnedSupervisor($id)
    {
        // dd($this->request->getVar());
        $this->pengetahuandasarModel->save([
            'id' => $id,
            'returner' => $this->request->getVar('returnopl'),
            'alasan' => $this->request->getVar('alasanreturn'),
            'status' => 'Returned Supervisor',
            'returned_at' => $this->request->getVar('tglreturn')
        ]);
        return redirect()->to('PengetahuanDasar/History')->with('pesan', 'OPL Telah Berhasil Direturn dan Dikembalikan Kepada Pembuat OPL Agar Dirubah');
    }

    public function returnedEngineer($id)
    {
        // dd($this->request->getVar());
        $this->pengetahuandasarModel->save([
            'id' => $id,
            'returner' => $this->request->getVar('returnopl'),
            'alasan' => $this->request->getVar('alasanreturn'),
            'status' => 'Returned Engineer',
            'returned_at' => $this->request->getVar('tglreturn')
        ]);
        return redirect()->to('PengetahuanDasar/History')->with('pesan', 'OPL Telah Berhasil Direturn dan Dikembalikan Kepada Pembuat OPL Agar Dirubah');
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
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {
            if (in_groups('supervisor')) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
                $status = ['Approved Supervisor', 'Approved Engineer', 'Returned Supervisor', 'Rejected Supervisor'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif (in_groups('engineer')) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $status = ['Approved Engineer', 'Returned Engineer', 'Rejected Engineer'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }


        if (in_groups('user')) {
            $data = [
                'title' => 'History OPL Pengetahuan Dasar',
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
                'title' => 'History OPL Pengetahuan Dasar',
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
                'title' => 'History OPL Pengetahuan Dasar',
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


        $data['pengetahuandasar'] = $query->getResultArray();

        return view('pengetahuandasar/pengetahuandasarHistory', $data);
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

        $distribusi = $this->request->getVar('distribusi');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $keyword = $this->request->getVar('keyword');
        if (in_groups('user')) {
            if ($keyword) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', $id);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', $id);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', $id);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', $id);
                $status = ['Created', 'Updated'];
                $this->builder->whereIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {
            if ($keyword) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orlike('users.fullname', $keyword);
                $this->builder->orlike('users.username', $keyword);
                $this->builder->orlike('opl_pengetahuan_dasar.opl_no', $keyword);
                $this->builder->orlike('mesin.nama_mesin', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orlike('users.fullname', $keyword);
                $this->builder->orlike('users.username', $keyword);
                $this->builder->orlike('opl_pengetahuan_dasar.opl_no', $keyword);
                $this->builder->orlike('mesin.nama_mesin', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } elseif ($month || $year || $distribusi) {

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('MONTH(opl_pengetahuan_dasar.created_at)', $month);
                $this->builder->where('YEAR(opl_pengetahuan_dasar.created_at)', $year);
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', $distribusi);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('MONTH(opl_pengetahuan_dasar.created_at)', $month);
                $this->builder->where('YEAR(opl_pengetahuan_dasar.created_at)', $year);
                $this->builder->where('opl_pengetahuan_dasar.id_distribusi', $distribusi);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            } else {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }


        if (in_groups('user')) {
            $data = [
                'title' => 'List OPL Pengetahuan Dasar',
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar(),
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
                'title' => 'List OPL Pengetahuan Dasar',
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar(),
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
                'title' => 'List OPL Pengetahuan Dasar',
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar(),
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
        } else {

            $distribusi = $this->request->getVar('distribusi');
            $users = $this->request->getVar('users');
            $month = $this->request->getVar('month');
            $year = $this->request->getVar('year');
            if ($distribusi || $users || $month || $year) {
                $data = [
                    'title' => 'List OPL Pengetahuan Dasar',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'page' => $page,
                    'perPage' => $perPage,
                    'total' => $total,
                    'offset' => $offset,
                    'currentPage' => $currentPage,
                    'keyword' => $keyword,
                    'countTS' => 0,
                    'countPD' => 0,
                    'countIM' => 0,
                    'countRIM' => 0,
                    'countRTS' => 0,
                    'countRPD' => 0,
                    'countSPD' => 0,
                    'countTSPD' => 0,
                    'countSTS' => 0,
                    'countTSTS' => 0,
                    'countSIM' => 0,
                    'countTSIM' => 0
                ];
            } else {
                $data = [
                    'title' => 'List OPL Pengetahuan Dasar',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'page' => $page,
                    'perPage' => $perPage,
                    'total' => $total,
                    'offset' => $offset,
                    'currentPage' => $currentPage,
                    'keyword' => $keyword,
                    'countTS' => 0,
                    'countPD' => 0,
                    'countIM' => 0,
                    'countRIM' => 0,
                    'countRTS' => 0,
                    'countRPD' => 0,
                    'countSPD' => 0,
                    'countTSPD' => 0,
                    'countSTS' => 0,
                    'countTSTS' => 0,
                    'countSIM' => 0,
                    'countTSIM' => 0
                ];
            }
        }

        $data['pengetahuandasarUser'] = $query->getResultArray();

        return view('pengetahuandasar/pengetahuandasarList', $data);
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
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $total = $this->builder->countAllResults();
        } else {
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $total = $this->builder->countAllResults();
        }

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.penyetuju');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_pengetahuan_dasar.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.engineer');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->where('opl_pengetahuan_dasar.id', $id);
        $query3 = $this->builder->get();


        if (in_groups('user')) {
            $data = [
                'title' => 'Detail OPL Pengetahuan Dasar',
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
                'realisasiPD' => $this->db->table('realisasi_pd')->select('realisasi_pd.*, users.username')->join('users', 'users.id = realisasi_pd.id_trainee')->getWhere(['id_pd' => $id])->getResultArray(),
                'pdUser' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
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
                'title' => 'Detail OPL Pengetahuan Dasar',
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
                'realisasiPD' => $this->db->table('realisasi_pd')->select('realisasi_pd.*, users.username')->join('users', 'users.id = realisasi_pd.id_trainee')->getWhere(['id_pd' => $id])->getResultArray(),
                'pdUser' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
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
                'title' => 'Detail OPL Pengetahuan Dasar',
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
                'realisasiPD' => $this->db->table('realisasi_pd')->select('realisasi_pd.*, users.username')->join('users', 'users.id = realisasi_pd.id_trainee')->getWhere(['id_pd' => $id])->getResultArray(),
                'pdUser' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
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
        } else {
            $data = [
                'title' => 'Detail OPL Pengetahuan Dasar',
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
                'realisasiPD' => $this->db->table('realisasi_pd')->select('realisasi_pd.*, users.username')->join('users', 'users.id = realisasi_pd.id_trainee')->getWhere(['id_pd' => $id])->getResultArray(),
                'realisasiTrainerPD' => $this->db->table('realisasi_pd')->select('realisasi_pd.*, users.username')->join('users', 'users.id = realisasi_pd.id_trainer')->getWhere(['id_pd' => $id])->getResultArray(),
                'pdUser' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'page' => $page,
                'perPage' => $perPage,
                'total' => $total,
                'offset' => $offset,
                'currentPage' => $currentPage,
                'countTS' => 0,
                'countPD' => 0,
                'countIM' => 0,
                'countRIM' => 0,
                'countRTS' => 0,
                'countRPD' => 0,
                'countSPD' => 0,
                'countTSPD' => 0,
                'countSTS' => 0,
                'countTSTS' => 0,
                'countSIM' => 0,
                'countTSIM' => 0
            ];
        }

        $data['pengetahuandasarUser'] = $query->getRowArray();

        $data['pengetahuandasarUser2'] = $query2->getRowArray();

        $data['pengetahuandasarUser3'] = $query3->getRowArray();

        // Jika data tidak ditemukan
        if (empty($data['pengetahuandasarUser'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('OPL Berkategori Pengetahuan Dasar Tidak Ada');
        }

        return view('pengetahuandasar/pengetahuandasarInputDetail', $data);
    }

    public function create()
    {
        // session();

        if (in_groups('user')) {
            $data = [
                'title' => 'Form Create OPL Pengetahuan Dasar',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'inputFotoPD' => $this->request->getVar('jumlahFoto'),
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
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
                'title' => 'Form Create OPL Pengetahuan Dasar',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'inputFotoPD' => $this->request->getVar('jumlahFoto'),
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
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
                'title' => 'Form Create OPL Pengetahuan Dasar',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'inputFotoPD' => $this->request->getVar('jumlahFoto'),
                'countOPL' => $this->builder->where('id_distribusi', user()->distribusi)->countAllResults(),
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


        return view('pengetahuandasar/pengetahuandasarInput', $data);
    }

    public function save()
    {

        // VALIDASI INPUT
        if (!$this->validate([
            'tema' => [
                'rules' => 'required|is_unique[opl_pengetahuan_dasar.tema]',
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
                    'required' => '{field} / prosedur harus diisi.'
                ]
            ],
            'department' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/ListPengetahuanDasar/CreatePengetahuanDasar')->withInput()->with('validation', $validation);
        }

        $sdwi = $this->request->getVar('sdwi');
        $sdwi_no = "";
        if ($sdwi == 'NA' || $sdwi == 'na' || $sdwi == 'tidak ada' || $sdwi == 'Tidak Ada' || $sdwi == 'Tidak ada') {
            $sdwi_no == ' ';
        } else {
            $sdwi_no = $sdwi;
        }

        // dd($sdwi_no);

        $this->pengetahuandasarModel->save([
            'tema' => $this->request->getVar('tema'),
            'tujuan' => $this->request->getVar('tujuan'),
            'fungsi' => $this->request->getVar('fungsi'),
            'penjelasan' => $this->request->getVar('penjelasan'),
            'dampak' => $this->request->getVar('dampak'),
            'mesin' => $this->request->getVar('mesin'),
            'sd/wi_no' => $sdwi_no,
            'status' => 'Created',
            'opl_no' => $this->request->getVar('counter'),
            'pembuat' => $this->request->getVar('pembuat'),
            'id_distribusi' => $this->request->getVar('department')
        ]);

        $id_pd = $this->pengetahuandasarModel->getInsertID();

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
                'id_pd' => $id_pd,
                'foto_pd'  => $namaFoto[$x],
                'keterangan'  => $keterangan,
                'pembuat'  => $pembuat
            ];
            $this->fotopdmodel->save($data);
        }

        return redirect()->to('ListPengetahuanDasar/' . user()->id)->with('pesan', 'OPL Berhasil Ditambahkan');
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
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', user()->id);
                $status = ['Created', 'Updated'];
                $this->builder->wherenotIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', user()->id);
                $status = ['Created', 'Updated'];
                $this->builder->wherenotIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        } else {

            if (in_groups('user')) {
                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', user()->id);
                $status = ['Created', 'Updated'];
                $this->builder->wherenotIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $query = $this->builder->get($limit, $offset);

                $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
                $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
                $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
                $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
                $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
                $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
                $this->builder->where('opl_pengetahuan_dasar.pembuat', user()->id);
                $status = ['Created', 'Updated'];
                $this->builder->wherenotIn('opl_pengetahuan_dasar.status', $status);
                $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
                $total = $this->builder->countAllResults();
            }
        }


        if (in_groups('user')) {
            $data = [
                'title' => 'List Updated Status OPL Pengetahuan Dasar',
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
                'title' => 'List Updated Status OPL Pengetahuan Dasar',
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
                'title' => 'List Updated Status OPL Pengetahuan Dasar',
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

        $data['pengetahuandasarUser'] = $query->getResultArray();

        return view('pengetahuandasar/pengetahuandasarStatus', $data);
    }

    public function editReturned($id)
    {
        // session();

        if (in_groups('user')) {
            $data = [
                'title' => 'Form Update Returned OPL Pengetahuan Dasar',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
                'fotoPD' => $this->fotopdmodel->getFotoPd($id),
                'countFotoPD' => $this->fotopdmodel->getCountFotoPd($id),
                'inputFotoPD' => $this->request->getVar('jumlahFoto'),
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
                'title' => 'Form Update Returned OPL Pengetahuan Dasar',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
                'inputFotoPD' => $this->request->getVar('jumlahFoto'),
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
                'title' => 'Form Update Returned OPL Pengetahuan Dasar',
                'validation' => \Config\Services::validation(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'mesin' => $this->mesinModel->getMesin(),
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
                'inputFotoPD' => $this->request->getVar('jumlahFoto'),
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


        return view('pengetahuandasar/pengetahuandasarEdit', $data);
    }

    public function updateReturned($id)
    {

        // CEK TEMA
        $oplLama = $this->pengetahuandasarModel->getPengetahuanDasar($id);
        if ($oplLama['tema'] == $this->request->getVar('tema')) {
            $rule_tema = 'required';
        } else {
            $rule_tema = 'required|is_unique[opl_pengetahuan_dasar.tema]';
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
                    'required' => '{field} / prosedur harus diisi.'
                ]
            ],
            'department' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} belum dipilih.'
                ]
            ]
        ])) {
            $validation = $this->validator->getErrors();
            return redirect()->to('/ListPengetahuanDasar/Edit/DetailsUserPengetahuanDasar/' . $id)->withInput()->with('validation', $validation);
        }

        $status = $this->request->getVar('status');
        if ($status == 'Returned Supervisor') {
            $status = 'Updated';
        } else {
            $status = 'Approved Supervisor';
        }

        $sdwi = $this->request->getVar('sdwi');
        $sdwi_no = "";
        if ($sdwi == 'NA' || $sdwi == 'na' || $sdwi == 'tidak ada' || $sdwi == 'Tidak Ada' || $sdwi == 'Tidak ada') {
            $sdwi_no == ' ';
        } else {
            $sdwi_no = $sdwi;
        }

        $this->pengetahuandasarModel->save([
            'id' => $id,
            'tema' => $this->request->getVar('tema'),
            'tujuan' => $this->request->getVar('tujuan'),
            'fungsi' => $this->request->getVar('fungsi'),
            'penjelasan' => $this->request->getVar('penjelasan'),
            'dampak' => $this->request->getVar('dampak'),
            'mesin' => $this->request->getVar('mesin'),
            'sd/wi_no' => $sdwi_no,
            'status' => $status,
            'revisi' => $this->request->getVar('revisi'),
            'id_distribusi' => $this->request->getVar('department')
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
                'foto_pd'  => $namaFoto[$x],
                'keterangan'  => $keterangan
            ];
            $this->fotopdmodel->save($data);
        }

        if ($status == 'Created' || $status == 'Updated') {
            return redirect()->to('ListPengetahuanDasar/' . user()->id)->with('pesan', 'OPL Berhasil Terupdate, Supervisor/Engineer Akan Memeriksa Ulang');
        } else {
            return redirect()->to('ListPengetahuanDasar/Status/' . user()->id)->with('pesan', 'OPL Berhasil Terupdate, Supervisor/Engineer Akan Memeriksa Ulang');
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

        $keyword = $this->request->getVar('keyword');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');

        if ($keyword) {

            // if (in_groups('supervisor')) {
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($month) {

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->where('MONTH(opl_pengetahuan_dasar.created_at)', $month);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->where('MONTH(opl_pengetahuan_dasar.created_at)', $month);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($year) {

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->where('YEAR(opl_pengetahuan_dasar.created_at)', $year);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->where('YEAR(opl_pengetahuan_dasar.created_at)', $year);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } elseif ($month && $year) {

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->where('MONTH(opl_pengetahuan_dasar.created_at)', $month);
            $this->builder->where('YEAR(opl_pengetahuan_dasar.created_at)', $year);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->where('MONTH(opl_pengetahuan_dasar.created_at)', $month);
            $this->builder->where('YEAR(opl_pengetahuan_dasar.created_at)', $year);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            // if (in_groups('supervisor')) {
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            // $this->builder->join('foto_pengetahuan_dasar', 'foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id_distribusi', user()->distribusi);
            $realisasi = ['TRUE', 'CLOSED'];
            $this->builder->whereIn('opl_pengetahuan_dasar.realisasi', $realisasi);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        }

        if (in_groups('user')) {
            $data = [
                'title' => 'List Sosialisasi OPL Pengetahuan Dasar',
                'pengetahuandasarUser' => $this->pengetahuandasarModel->getPengetahuanDasar(),
                'realisasi' => $this->realisasiPDModel->getRealisasiTrainee(),
                'foto_pdU' => $this->fotopdmodel->getSingleFotoPd($id),
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
                'title' => 'List Sosialisasi OPL Pengetahuan Dasar',
                'pengetahuandasarUser' => $this->pengetahuandasarModel->getPengetahuanDasar(),
                'realisasi' => $this->realisasiPDModel->getRealisasiTrainee(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'foto_pdU' => $this->fotopdmodel->getSingleFotoPd($id),
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
                'title' => 'List Sosialisasi OPL Pengetahuan Dasar',
                'pengetahuandasarUser' => $this->pengetahuandasarModel->getPengetahuanDasar(),
                'realisasi' => $this->realisasiPDModel->getRealisasiTrainee(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'foto_pdU' => $this->fotopdmodel->getSingleFotoPd($id),
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

        $data['pengetahuandasarUserMesin'] = $query->getResultArray();

        return view('pengetahuandasar/pengetahuandasarListRealisasi', $data);
    }

    public function OpenRealisasi($id = 0)
    {
        // dd($id);
        $this->pengetahuandasarModel->save([
            'id' => $id,
            'realisasi' => 'TRUE',
        ]);
        return redirect()->to('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/' . $id)->with('pesan', 'OPL Telah Berhasil Dibuka Kembali');
    }

    public function CloseRealisasi($id = 0)
    {
        // dd($id);
        $this->pengetahuandasarModel->save([
            'id' => $id,
            'realisasi' => 'CLOSED',
        ]);
        return redirect()->to('/ListPengetahuanDasar/DetailsUserPengetahuanDasar/' . $id)->with('pesan', 'OPL Telah Berhasil Ditutup');
    }

    public function realisasiListHistory($id = 0)
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

            // if (in_groups('supervisor')) {
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('realisasi_pd', 'realisasi_pd.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('realisasi_pd.id_trainee', user()->id);
            $this->builder->where('opl_pengetahuan_dasar.realisasi', 'TRUE');
            $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
            $this->builder->orlike('users.username', $keyword);
            $this->builder->orlike('opl_pengetahuan_dasar.created_at', $keyword);
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('realisasi_pd', 'realisasi_pd.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->like('opl_pengetahuan_dasar.tema', $keyword);
            $this->builder->orlike('users.username', $keyword);
            $this->builder->orlike('opl_pengetahuan_dasar.created_at', $keyword);
            $this->builder->where('realisasi_pd.id_trainee', user()->id);
            $this->builder->where('opl_pengetahuan_dasar.realisasi', 'TRUE');
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $total = $this->builder->countAllResults();
        } else {

            // if (in_groups('supervisor')) {
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('realisasi_pd', 'realisasi_pd.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('realisasi_pd.id_trainee', user()->id);
            $this->builder->where('opl_pengetahuan_dasar.realisasi', 'TRUE');
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $this->builder->distinct('foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $query = $this->builder->get($limit, $offset);

            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, mesin.nama_mesin, users.username');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('realisasi_pd', 'realisasi_pd.id_pd = opl_pengetahuan_dasar.id');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('realisasi_pd.id_trainee', user()->id);
            $this->builder->where('opl_pengetahuan_dasar.realisasi', 'TRUE');
            $this->builder->orderBy('opl_pengetahuan_dasar.created_at', 'DESC');
            $this->builder->distinct('foto_pengetahuan_dasar.id_pd = opl_pengetahuan_dasar.id');
            $total = $this->builder->countAllResults();
        }


        if (in_groups('user')) {
            $data = [
                'title' => 'List History Sosialisasi OPL Pengetahuan Dasar',
                'pengetahuandasarUser' => $this->pengetahuandasarModel->getPengetahuanDasar(),
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
                'title' => 'List History Sosialisasi OPL Pengetahuan Dasar',
                'pengetahuandasarUser' => $this->pengetahuandasarModel->getPengetahuanDasar(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
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
                'title' => 'List History Sosialisasi OPL Pengetahuan Dasar',
                'pengetahuandasarUser' => $this->pengetahuandasarModel->getPengetahuanDasar(),
                'distribusi' => $this->distribusiModel->getDistribusi(),
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
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

        $data['pengetahuandasarUserMesin'] = $query->getResultArray();

        return view('pengetahuandasar/pengetahuandasarHistory', $data);
    }

    public function detailRealisasi($id)
    {

        if (in_groups('user')) {
            $data = [
                'title' => 'Detail Sosialisasi OPL Pengetahuan Dasar',
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
                'pdUser' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
                'realisasi' => $this->realisasiPDModel->getRealisasi($id),
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
            // dd($id);
        } elseif (in_groups('supervisor')) {
            $data = [
                'title' => 'Detail Sosialisasi OPL Pengetahuan Dasar',
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
                'pdUser' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
                'realisasi' => $this->realisasiPDModel->getRealisasi($id),
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
                'title' => 'Detail Sosialisasi OPL Pengetahuan Dasar',
                'foto_pdU' => $this->db->table('foto_pengetahuan_dasar')->getWhere(['id_pd' => $id])->getResultArray(),
                'pdUser' => $this->pengetahuandasarModel->getPengetahuanDasar($id),
                'realisasi' => $this->realisasiPDModel->getRealisasi($id),
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
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $query = $this->builder->get();
        } else {
            $this->builder->select('opl_pengetahuan_dasar.*, distribusi.nama_distribusi, singkatan, users.username, mesin.nama_mesin');
            $this->builder->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin');
            $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.pembuat');
            $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
            $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
            $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
            $this->builder->where('opl_pengetahuan_dasar.id', $id);
            $query = $this->builder->get();
        }

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.penyetuju');
        $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('opl_pengetahuan_dasar.id', $id);
        $query2 = $this->builder->get();

        $this->builder->select('users.username');
        $this->builder->join('users', 'users.id = opl_pengetahuan_dasar.engineer');
        $this->builder->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi', 'distribusi.id = users.distribusi');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('opl_pengetahuan_dasar.id', $id);
        $query3 = $this->builder->get();

        $data['pengetahuandasarUser'] = $query->getRowArray();

        $data['pengetahuandasarUser2'] = $query2->getRowArray();

        $data['pengetahuandasarUser3'] = $query3->getRowArray();

        // Jika data tidak ditemukan
        if (empty($data['pengetahuandasarUser'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('OPL Berkategori Pengetahuan Dasar Tidak Ada');
        }

        return view('pengetahuandasar/pengetahuandasarDetailRealisasi', $data);
    }
}
