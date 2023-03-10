<?php

namespace App\Controllers;

use App\Controllers;
use Config\Services;
use App\Models\UsersModel;
use Myth\Auth\Entities\User;
use App\Models\DistribusiModel;
use App\Models\TroubleShootingModel;
use App\Models\FotoTsModel;
use App\Models\MesinModel;
use App\Models\PengetahuanDasarModel;
use App\Models\FotoPdModel;
use App\Models\ImprovementModel;
use App\Models\FotoImModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Users extends BaseController
{
    protected $db, $builder, $builder1, $builder2, $builder3, $usersModel;
    protected $distribusiModel;
    protected $fototsmodel;
    protected $troubleshootingModel;
    protected $pengetahuandasarModel;
    protected $mesinModel;
    protected $fotopdmodel;
    protected $improvementModel;
    protected $fotoimmodel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->usersModel = new UsersModel();
        $this->distribusiModel = new DistribusiModel();
        $this->pengetahuandasarModel = new PengetahuanDasarModel();
        $this->mesinModel = new MesinModel();
        $this->fotopdmodel = new FotoPdModel();
        $this->improvementModel = new ImprovementModel();
        $this->fotoimmodel = new FotoImModel();
        $this->troubleshootingModel = new TroubleShootingModel();
        $this->fototsmodel = new FotoTsModel();
    }

    public function index($id = false)
    {

        $distribusi = $this->request->getVar('distribusi');
        $users = $this->request->getVar('users');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        if ($distribusi || $users || $month || $year) {
            if (in_groups('user')) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesin' => $this->mesinModel->getMesin(),
                    'countTS' => $this->troubleshootingModel->getCountOPL(),
                    'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                    'countIM' => $this->improvementModel->getCountOPL(),
                    'countRIM' => $this->improvementModel->getCountReturned(),
                    'countRTS' => $this->troubleshootingModel->getCountReturned(),
                    'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMIM' => $this->improvementModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotal($month, $year, $distribusi, $users),
                    'countTIM' => $this->improvementModel->getTotal($month, $year, $distribusi, $users),
                    'countTTS' => $this->troubleshootingModel->getTotal($month, $year, $distribusi, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            } elseif (in_groups('supervisor')) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesin' => $this->mesinModel->getMesin(),
                    'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                    'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                    'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                    'countRIM' => $this->improvementModel->getCountCreated(),
                    'countRTS' => $this->troubleshootingModel->getCountCreated(),
                    'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMIM' => $this->improvementModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotal($month, $year, $distribusi, $users),
                    'countTIM' => $this->improvementModel->getTotal($month, $year, $distribusi, $users),
                    'countTTS' => $this->troubleshootingModel->getTotal($month, $year, $distribusi, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            } elseif (in_groups('engineer')) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->gettgetTroubleShootingUser(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesin' => $this->mesinModel->getMesin(),
                    'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                    'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                    'countIM' => $this->improvementModel->getCountOPLEngineer(),
                    'countRIM' => $this->improvementModel->getCountApproved(),
                    'countRTS' => $this->troubleshootingModel->getCountApproved(),
                    'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMIM' => $this->improvementModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotal($month, $year, $distribusi, $users),
                    'countTIM' => $this->improvementModel->getTotal($month, $year, $distribusi, $users),
                    'countTTS' => $this->troubleshootingModel->getTotal($month, $year, $distribusi, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            }
        } else {
            if (in_groups('user')) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarUser(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesin' => $this->mesinModel->getMesin(),
                    'countTS' => $this->troubleshootingModel->getCountOPL(),
                    'countPD' => $this->pengetahuandasarModel->getCountOPL(),
                    'countIM' => $this->improvementModel->getCountOPL(),
                    'countRIM' => $this->improvementModel->getCountReturned(),
                    'countRTS' => $this->troubleshootingModel->getCountReturned(),
                    'countRPD' => $this->pengetahuandasarModel->getCountReturned(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMIM' => $this->improvementModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotal($month, $year, $distribusi, $users),
                    'countTIM' => $this->improvementModel->getTotal($month, $year, $distribusi, $users),
                    'countTTS' => $this->troubleshootingModel->getTotal($month, $year, $distribusi, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            } elseif (in_groups('supervisor')) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarUser(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesin' => $this->mesinModel->getMesin(),
                    'countTS' => $this->troubleshootingModel->getCountOPLSupervisor(),
                    'countPD' => $this->pengetahuandasarModel->getCountOPLSupervisor(),
                    'countIM' => $this->improvementModel->getCountOPLSupervisor(),
                    'countRIM' => $this->improvementModel->getCountCreated(),
                    'countRTS' => $this->troubleshootingModel->getCountCreated(),
                    'countRPD' => $this->pengetahuandasarModel->getCountCreated(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMIM' => $this->improvementModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotal($month, $year, $distribusi, $users),
                    'countTIM' => $this->improvementModel->getTotal($month, $year, $distribusi, $users),
                    'countTTS' => $this->troubleshootingModel->getTotal($month, $year, $distribusi, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            } elseif (in_groups('engineer')) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarUser(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesin' => $this->mesinModel->getMesin(),
                    'countTS' => $this->troubleshootingModel->getCountOPLEngineer(),
                    'countPD' => $this->pengetahuandasarModel->getCountOPLEngineer(),
                    'countIM' => $this->improvementModel->getCountOPLEngineer(),
                    'countRIM' => $this->improvementModel->getCountApproved(),
                    'countRTS' => $this->troubleshootingModel->getCountApproved(),
                    'countRPD' => $this->pengetahuandasarModel->getCountApproved(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMIM' => $this->improvementModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthly($month, $year, $distribusi, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthly($month, $year, $distribusi, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotal($month, $year, $distribusi, $users),
                    'countTIM' => $this->improvementModel->getTotal($month, $year, $distribusi, $users),
                    'countTTS' => $this->troubleshootingModel->getTotal($month, $year, $distribusi, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            }
        }

        return view('dashboard', $data);
    }

    public function distribusiUsers()
    {
        $distribusi = $this->request->getVar('distribusi');
        $users = $this->usersModel->getDistribusiUsers($distribusi);
        echo '<option selected hidden disabled>Choose User</option>';
        foreach ($users as $uPD) {
            echo "<option value=" . $uPD['userid'] . ">" . $uPD['fullname'] . "</option>";
        }
    }

    public function countNotif()
    {

        if (in_groups('user')) {
            $data = [
                'title' => 'Dashboard',
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
                'title' => 'Dashboard',
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
                'title' => 'Dashboard',
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
        return view('/header/index', $data);
    }

    public function view_profile()
    {
        $users = $this->usersModel->findAll();

        if (in_groups('user')) {
            $data = [
                'title' => 'View My Profile',
                'users' => $users,
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
                'title' => 'View My Profile',
                'users' => $users,
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
                'title' => 'View My Profile',
                'users' => $users,
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

        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        return view('user/index', $data);
    }

    public function edit_my_profile($id = null)
    {

        $data['title'] = 'Edit My Profile';

        return view('/edit_my_profile', $data);
    }

    public function changePassword()
    {

        if (in_groups('user')) {
            $data = [
                'title' => 'Change User Password',
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
                'title' => 'Change User Password',
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
                'title' => 'Change User Password',
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
        return view('auth/password', $data);
    }

    public function updatePassword()
    {

        //Rules for the update password form
        $rules = [
            'old-password' => [
                // 'rules'  => 'required|checkOldPasswords',
                'rules'  => 'required',
                'errors' => [
                    // 'checkOldPasswords' => 'Password Lama Tidak Sesuai',
                    'required' => 'Password Lama Harus Diisi',
                ]
            ],
            'new-password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password Baru Harus Diisi',

                ]
            ],
            'password' => [
                'rules'  => 'required|matches[new-password]',
                'errors' => [
                    'required' => 'Konfirmasi Password Baru Harus Diisi',
                    'matches' => 'Password Tidak Sesuai Dengan Password Baru'
                ]
            ],
        ];

        if ($this->request->getMethod() === 'post' && $this->validate($rules)) {

            //Create new instance of the MythAuth UserModel
            $users = model(UserModel::class);

            //Get the id of the current user
            $user_id = user_id();

            //Create new user entity
            $entity = new User();

            //Get current password from input field
            $newPassword = $this->request->getVar('password');

            //Hash password using the "setPassword" function of the User entity
            $entity->setPassword($newPassword);

            //Save the hashed password in the variable "hash"
            $hash  = $entity->password_hash;

            //update the current users password_hash in the database with the new hashed password.
            $users->update($user_id, ['password_hash' => $hash]);

            //Return back with success message
            return redirect()->to('/change-password')->with('success', "Password Has Been Updated");
        } else {
            $validation = $this->validator->listErrors();
            //Return with errors
            return redirect()->to('/change-password')->withInput()->with('validation', $validation);
        }
    }

    public function export()
    {
        $this->builder1 = $this->db->table('opl_pengetahuan_dasar');
        $this->builder2 = $this->db->table('opl_improvement');
        $this->builder3 = $this->db->table('opl_trouble_shooting');

        $totalPD = $this->request->getVar('oplTPD');
        $totalIM = $this->request->getVar('oplTIM');
        $totalTS = $this->request->getVar('oplTTS');
        $distribusi = $this->request->getVar('distribusi');
        $users = $this->request->getVar('users');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        if ($distribusi || $users || $month || $year) {
            $query1 = $this->db->table('opl_pengetahuan_dasar')->select('opl_pengetahuan_dasar.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin')->join('users', 'users.id = opl_pengetahuan_dasar.pembuat')->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi')->where('MONTH(opl_pengetahuan_dasar.created_at)', $month)->where('YEAR(opl_pengetahuan_dasar.created_at)', $year)->where(['id_distribusi' => $distribusi])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();

            $query2 = $this->db->table('opl_improvement')->select('opl_improvement.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_improvement.mesin')->join('users', 'users.id = opl_improvement.pembuat')->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where('MONTH(opl_improvement.created_at)', $month)->where('YEAR(opl_improvement.created_at)', $year)->where(['id_distribusi' => $distribusi])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();

            $query3 = $this->db->table('opl_trouble_shooting')->select('opl_trouble_shooting.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_trouble_shooting.mesin')->join('users', 'users.id = opl_trouble_shooting.pembuat')->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where('MONTH(opl_trouble_shooting.created_at)', $month)->where('YEAR(opl_trouble_shooting.created_at)', $year)->where(['id_distribusi' => $distribusi])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();
        }
        $pengetahuandasar = $query1->getResultArray();
        $improvement = $query2->getResultArray();
        $troubleshooting = $query3->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Kategori');
        $sheet->setCellValue('B1', 'No');
        $sheet->setCellValue('C1', 'Tema');
        $sheet->setCellValue('D1', 'Tujuan');
        $sheet->setCellValue('E1', 'Fungsi');
        $sheet->setCellValue('F1', 'Penjelasan');
        $sheet->setCellValue('G1', 'Dampak');
        $sheet->setCellValue('H1', 'Mesin');
        $sheet->setCellValue('I1', 'Pembuat');
        $sheet->setCellValue('J1', 'Department');
        $sheet->setCellValue('K1', 'Status OPL');
        $sheet->setCellValue('L1', 'Tanggal Dibuat');

        $column = 2;
        foreach ($pengetahuandasar as $PD) {
            $sheet->setCellValue('A' . $column, 'Pengetahuan Dasar');
            $sheet->setCellValue('B' . $column, ($column - 1));
            $sheet->setCellValue('C' . $column, $PD['tema']);
            $sheet->setCellValue('D' . $column, $PD['tujuan']);
            $sheet->setCellValue('E' . $column, $PD['fungsi']);
            $sheet->setCellValue('F' . $column, $PD['penjelasan']);
            $sheet->setCellValue('G' . $column, $PD['dampak']);
            $sheet->setCellValue('H' . $column, $PD['nama_mesin']);
            $sheet->setCellValue('I' . $column, $PD['fullname']);
            $sheet->setCellValue('J' . $column, $PD['nama_distribusi']);
            $sheet->setCellValue('K' . $column, $PD['status']);
            $sheet->setCellValue('L' . $column, $PD['created_at']);
            $column++;
        }

        foreach ($improvement as $IM) {
            $sheet->setCellValue('A' . $column, 'Improvement');
            $sheet->setCellValue('B' . $column, ($column - 1));
            $sheet->setCellValue('C' . $column, $IM['tema']);
            $sheet->setCellValue('D' . $column, $IM['tujuan']);
            $sheet->setCellValue('E' . $column, $IM['fungsi']);
            $sheet->setCellValue('F' . $column, $IM['penjelasan']);
            $sheet->setCellValue('G' . $column, $IM['dampak']);
            $sheet->setCellValue('H' . $column, $IM['nama_mesin']);
            $sheet->setCellValue('I' . $column, $IM['fullname']);
            $sheet->setCellValue('J' . $column, $IM['nama_distribusi']);
            $sheet->setCellValue('K' . $column, $IM['status']);
            $sheet->setCellValue('L' . $column, $IM['created_at']);
            $column++;
        }

        foreach ($troubleshooting as $TS) {
            $sheet->setCellValue('A' . $column, 'Trouble Shooting');
            $sheet->setCellValue('B' . $column, ($column - 1));
            $sheet->setCellValue('C' . $column, $TS['tema']);
            $sheet->setCellValue('D' . $column, $TS['tujuan']);
            $sheet->setCellValue('E' . $column, $TS['fungsi']);
            $sheet->setCellValue('F' . $column, $TS['penjelasan']);
            $sheet->setCellValue('G' . $column, $TS['dampak']);
            $sheet->setCellValue('H' . $column, $TS['nama_mesin']);
            $sheet->setCellValue('I' . $column, $TS['fullname']);
            $sheet->setCellValue('J' . $column, $TS['nama_distribusi']);
            $sheet->setCellValue('K' . $column, $TS['status']);
            $sheet->setCellValue('L' . $column, $TS['created_at']);
            $column++;
        }

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=export-OPL.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();

        return redirect(base_url());
    }
}
