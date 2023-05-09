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

        $filter = $this->request->getVar('filter');
        $distribusi = $this->request->getVar('distribusi');
        $mesin = $this->request->getVar('mesin');
        $users = $this->request->getVar('users');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $oplNoPD = $this->request->getVar('oplNoPD');
        $oplNoIM = $this->request->getVar('oplNoIM');
        $oplNoTS = $this->request->getVar('oplNoTS');
        // if ($users) {
        // if (in_groups('user')) {
        if ($month && $year && $users) {
            if (empty($mesin) && $users) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'oplNoPDNama' => $this->pengetahuandasarModel->getOPLnoPD($oplNoPD),
                    'oplNoIMNama' => $this->improvementModel->getOPLnoIM($oplNoIM),
                    'oplNoTSNama' => $this->troubleshootingModel->getOPLnoTS($oplNoTS),
                    'oplNoPDList' => $this->pengetahuandasarModel->getOPLnoPD(),
                    'oplNoIMList' => $this->improvementModel->getOPLnoIM(),
                    'oplNoTSList' => $this->troubleshootingModel->getOPLnoTS(),
                    'oplNoPD' => $oplNoPD,
                    'oplNoIM' => $oplNoIM,
                    'oplNoTS' => $oplNoTS,
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'filter' => $filter,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesinList' => $this->mesinModel->getMesin(),
                    'mesinNama' => $this->mesinModel->getMesin($mesin),
                    'mesin' => $mesin,
                    'countU' => $this->usersModel->getCountUsers(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthly($month, $year, $users),
                    'countMIM' => $this->improvementModel->getCountMonthly($month, $year, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthly($month, $year, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthly($month, $year, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthly($month, $year, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthly($month, $year, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotal($month, $year, $users),
                    'countTIM' => $this->improvementModel->getTotal($month, $year, $users),
                    'countTTS' => $this->troubleshootingModel->getTotal($month, $year, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            } elseif ($mesin && $users) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'oplNoPDNama' => $this->pengetahuandasarModel->getOPLnoPD($oplNoPD),
                    'oplNoIMNama' => $this->improvementModel->getOPLnoIM($oplNoIM),
                    'oplNoTSNama' => $this->troubleshootingModel->getOPLnoTS($oplNoTS),
                    'oplNoPDList' => $this->pengetahuandasarModel->getOPLnoPD(),
                    'oplNoIMList' => $this->improvementModel->getOPLnoIM(),
                    'oplNoTSList' => $this->troubleshootingModel->getOPLnoTS(),
                    'oplNoPD' => $oplNoPD,
                    'oplNoIM' => $oplNoIM,
                    'oplNoTS' => $oplNoTS,
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'filter' => $filter,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesinList' => $this->mesinModel->getMesin(),
                    'mesinNama' => $this->mesinModel->getMesin($mesin),
                    'mesin' => $mesin,
                    'countU' => $this->usersModel->getCountUsers(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthlyMesUs($month, $year, $mesin, $users),
                    'countMIM' => $this->improvementModel->getCountMonthlyMesUs($month, $year, $mesin, $users),
                    'countMTS' => $this->troubleshootingModel->getCountMonthlyMesUs($month, $year, $mesin, $users),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthlyMesUs($month, $year, $mesin, $users),
                    'countTMIM' => $this->improvementModel->getTotalMonthlyMesUs($month, $year, $mesin, $users),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthlyMesUs($month, $year, $mesin, $users),
                    'countTPD' => $this->pengetahuandasarModel->getTotalMesUs($month, $year, $mesin, $users),
                    'countTIM' => $this->improvementModel->getTotalMesUs($month, $year, $mesin, $users),
                    'countTTS' => $this->troubleshootingModel->getTotalMesUs($month, $year, $mesin, $users),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            }
        } elseif ($month && $year && $distribusi) {
            if (empty($mesin) && $distribusi) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'oplNoPDNama' => $this->pengetahuandasarModel->getOPLnoPD($oplNoPD),
                    'oplNoIMNama' => $this->improvementModel->getOPLnoIM($oplNoIM),
                    'oplNoTSNama' => $this->troubleshootingModel->getOPLnoTS($oplNoTS),
                    'oplNoPDList' => $this->pengetahuandasarModel->getOPLnoPD(),
                    'oplNoIMList' => $this->improvementModel->getOPLnoIM(),
                    'oplNoTSList' => $this->troubleshootingModel->getOPLnoTS(),
                    'oplNoPD' => $oplNoPD,
                    'oplNoIM' => $oplNoIM,
                    'oplNoTS' => $oplNoTS,
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'filter' => $filter,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesinList' => $this->mesinModel->getMesin(),
                    'mesinNama' => $this->mesinModel->getMesin($mesin),
                    'mesin' => $mesin,
                    'countU' => $this->usersModel->getCountUsers(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthlyDept($month, $year, $distribusi),
                    'countMIM' => $this->improvementModel->getCountMonthlyDept($month, $year, $distribusi),
                    'countMTS' => $this->troubleshootingModel->getCountMonthlyDept($month, $year, $distribusi),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthlyDept($month, $year, $distribusi),
                    'countTMIM' => $this->improvementModel->getTotalMonthlyDept($month, $year, $distribusi),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthlyDept($month, $year, $distribusi),
                    'countTPD' => $this->pengetahuandasarModel->getTotalDept($month, $year, $distribusi),
                    'countTIM' => $this->improvementModel->getTotalDept($month, $year, $distribusi),
                    'countTTS' => $this->troubleshootingModel->getTotalDept($month, $year, $distribusi),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            } elseif ($mesin && $distribusi) {
                $data = [
                    'title' => 'Dashboard',
                    'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                    'improvement' => $this->improvementModel->getImprovementUser(),
                    'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                    'oplNoPDNama' => $this->pengetahuandasarModel->getOPLnoPD($oplNoPD),
                    'oplNoIMNama' => $this->improvementModel->getOPLnoIM($oplNoIM),
                    'oplNoTSNama' => $this->troubleshootingModel->getOPLnoTS($oplNoTS),
                    'oplNoPDList' => $this->pengetahuandasarModel->getOPLnoPD(),
                    'oplNoIMList' => $this->improvementModel->getOPLnoIM(),
                    'oplNoTSList' => $this->troubleshootingModel->getOPLnoTS(),
                    'oplNoPD' => $oplNoPD,
                    'oplNoIM' => $oplNoIM,
                    'oplNoTS' => $oplNoTS,
                    'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                    'distribusiList' => $this->distribusiModel->getDistribusi(),
                    'distribusi' => $distribusi,
                    'month' => $month,
                    'year' => $year,
                    'filter' => $filter,
                    'usersNama' => $this->usersModel->getUsers($users),
                    'usersList' => $this->usersModel->getUsers(),
                    'users' => $users,
                    'mesinList' => $this->mesinModel->getMesin(),
                    'mesinNama' => $this->mesinModel->getMesin($mesin),
                    'mesin' => $mesin,
                    'countU' => $this->usersModel->getCountUsers(),
                    'countMPD' => $this->pengetahuandasarModel->getCountMonthlyMesDept($month, $year, $mesin, $distribusi),
                    'countMIM' => $this->improvementModel->getCountMonthlyMesDept($month, $year, $mesin, $distribusi),
                    'countMTS' => $this->troubleshootingModel->getCountMonthlyMesDept($month, $year, $mesin, $distribusi),
                    'countTMPD' => $this->pengetahuandasarModel->getTotalMonthlyMesDept($month, $year, $mesin, $distribusi),
                    'countTMIM' => $this->improvementModel->getTotalMonthlyMesDept($month, $year, $mesin, $distribusi),
                    'countTMTS' => $this->troubleshootingModel->getTotalMonthlyMesDept($month, $year, $mesin, $distribusi),
                    'countTPD' => $this->pengetahuandasarModel->getTotalMesDept($month, $year, $mesin, $distribusi),
                    'countTIM' => $this->improvementModel->getTotalMesDept($month, $year, $mesin, $distribusi),
                    'countTTS' => $this->troubleshootingModel->getTotalMesDept($month, $year, $mesin, $distribusi),
                    'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                    'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                    'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                    'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                    'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                    'countTSIM' => $this->improvementModel->getTotalSosialisasi()
                ];
            }
        } elseif ($month && $year && $mesin) {
            $data = [
                'title' => 'Dashboard',
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                'improvement' => $this->improvementModel->getImprovementUser(),
                'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                'oplNoPDNama' => $this->pengetahuandasarModel->getOPLnoPD($oplNoPD),
                'oplNoIMNama' => $this->improvementModel->getOPLnoIM($oplNoIM),
                'oplNoTSNama' => $this->troubleshootingModel->getOPLnoTS($oplNoTS),
                'oplNoPDList' => $this->pengetahuandasarModel->getOPLnoPD(),
                'oplNoIMList' => $this->improvementModel->getOPLnoIM(),
                'oplNoTSList' => $this->troubleshootingModel->getOPLnoTS(),
                'oplNoPD' => $oplNoPD,
                'oplNoIM' => $oplNoIM,
                'oplNoTS' => $oplNoTS,
                'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                'distribusiList' => $this->distribusiModel->getDistribusi(),
                'distribusi' => $distribusi,
                'month' => $month,
                'year' => $year,
                'filter' => $filter,
                'usersNama' => $this->usersModel->getUsers($users),
                'usersList' => $this->usersModel->getUsers(),
                'users' => $users,
                'mesinList' => $this->mesinModel->getMesin(),
                'mesinNama' => $this->mesinModel->getMesin($mesin),
                'mesin' => $mesin,
                'countU' => $this->usersModel->getCountUsers(),
                'countMPD' => $this->pengetahuandasarModel->getCountMonthlyMesin($month, $year, $mesin),
                'countMIM' => $this->improvementModel->getCountMonthlyMesin($month, $year, $mesin),
                'countMTS' => $this->troubleshootingModel->getCountMonthlyMesin($month, $year, $mesin),
                'countTMPD' => $this->pengetahuandasarModel->getTotalMonthlyMesin($month, $year, $mesin),
                'countTMIM' => $this->improvementModel->getTotalMonthlyMesin($month, $year, $mesin),
                'countTMTS' => $this->troubleshootingModel->getTotalMonthlyMesin($month, $year, $mesin),
                'countTPD' => $this->pengetahuandasarModel->getTotalMesin($month, $year, $mesin),
                'countTIM' => $this->improvementModel->getTotalMesin($month, $year, $mesin),
                'countTTS' => $this->troubleshootingModel->getTotalMesin($month, $year, $mesin),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } elseif ($month && $year && $oplNoIM || $oplNoPD || $oplNoTS) {
            $data = [
                'title' => 'Dashboard',
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarDistribusi(),
                'improvement' => $this->improvementModel->getImprovementUser(),
                'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                'oplNoPDNama' => $this->pengetahuandasarModel->getOPLnoPD($oplNoPD),
                'oplNoIMNama' => $this->improvementModel->getOPLnoIM($oplNoIM),
                'oplNoTSNama' => $this->troubleshootingModel->getOPLnoTS($oplNoTS),
                'oplNoPDList' => $this->pengetahuandasarModel->getOPLnoPD(),
                'oplNoIMList' => $this->improvementModel->getOPLnoIM(),
                'oplNoTSList' => $this->troubleshootingModel->getOPLnoTS(),
                'oplNoPD' => $oplNoPD,
                'oplNoIM' => $oplNoIM,
                'oplNoTS' => $oplNoTS,
                'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                'distribusiList' => $this->distribusiModel->getDistribusi(),
                'distribusi' => $distribusi,
                'month' => $month,
                'year' => $year,
                'filter' => $filter,
                'usersNama' => $this->usersModel->getUsers($users),
                'usersList' => $this->usersModel->getUsers(),
                'users' => $users,
                'mesinList' => $this->mesinModel->getMesin(),
                'mesinNama' => $this->mesinModel->getMesin($mesin),
                'mesin' => $mesin,
                'countU' => $this->usersModel->getCountUsers(),
                'countMPD' => $this->pengetahuandasarModel->getCountMonthlyOplNo($month, $year, $oplNoPD),
                'countMIM' => $this->improvementModel->getCountMonthlyOplNo($month, $year, $oplNoIM),
                'countMTS' => $this->troubleshootingModel->getCountMonthlyOplNo($month, $year, $oplNoTS),
                'countTMPD' => $this->pengetahuandasarModel->getTotalMonthlyOplNo($month, $year, $oplNoPD),
                'countTMIM' => $this->improvementModel->getTotalMonthlyOplNo($month, $year, $oplNoIM),
                'countTMTS' => $this->troubleshootingModel->getTotalMonthlyOplNo($month, $year, $oplNoTS),
                'countTPD' => $this->pengetahuandasarModel->getTotalOplNo($month, $year, $oplNoPD),
                'countTIM' => $this->improvementModel->getTotalOplNo($month, $year, $oplNoIM),
                'countTTS' => $this->troubleshootingModel->getTotalOplNo($month, $year, $oplNoTS),
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        } else {
            $data = [
                'title' => 'Dashboard',
                'pengetahuandasar' => $this->pengetahuandasarModel->getPengetahuanDasarUser(),
                'improvement' => $this->improvementModel->getImprovementUser(),
                'troubleshooting' => $this->troubleshootingModel->getTroubleShootingUser(),
                'oplNoPDNama' => $this->pengetahuandasarModel->getOPLnoPD($oplNoPD),
                'oplNoIMNama' => $this->improvementModel->getOPLnoIM($oplNoIM),
                'oplNoTSNama' => $this->troubleshootingModel->getOPLnoTS($oplNoTS),
                'oplNoPDList' => $this->pengetahuandasarModel->getOPLnoPD(),
                'oplNoIMList' => $this->improvementModel->getOPLnoIM(),
                'oplNoTSList' => $this->troubleshootingModel->getOPLnoTS(),
                'oplNoPD' => $oplNoPD,
                'oplNoIM' => $oplNoIM,
                'oplNoTS' => $oplNoTS,
                'distribusiNama' => $this->distribusiModel->getDistribusi($distribusi),
                'distribusiList' => $this->distribusiModel->getDistribusi(),
                'distribusi' => $distribusi,
                'month' => $month,
                'year' => $year,
                'filter' => $filter,
                'usersNama' => $this->usersModel->getUsers($users),
                'usersList' => $this->usersModel->getUsers(),
                'users' => $users,
                'mesinList' => $this->mesinModel->getMesin(),
                'mesinNama' => $this->mesinModel->getMesin($mesin),
                'mesin' => $mesin,
                'countU' => $this->usersModel->getCountUsers(),
                'countMPD' => '0',
                'countMIM' => '0',
                'countMTS' => '0',
                'countTMPD' => '0',
                'countTMIM' => '0',
                'countTMTS' => '0',
                'countTPD' => '0',
                'countTIM' => '0',
                'countTTS' => '0',
                'countSPD' => $this->pengetahuandasarModel->getSosialisasiOPL(),
                'countTSPD' => $this->pengetahuandasarModel->getTotalSosialisasi(),
                'countSTS' => $this->troubleshootingModel->getSosialisasiOPL(),
                'countTSTS' => $this->troubleshootingModel->getTotalSosialisasi(),
                'countSIM' => $this->improvementModel->getSosialisasiOPL(),
                'countTSIM' => $this->improvementModel->getTotalSosialisasi()
            ];
        }

        // =======================   BUAT CARD YANG MENAMPILKAN TOTAL PADA DASHBOARD ==========================

        if (in_groups('user')) {
            $data['countTS'] = $this->troubleshootingModel->getCountOPL();
            $data['countPD'] = $this->pengetahuandasarModel->getCountOPL();
            $data['countIM'] = $this->improvementModel->getCountOPL();
            $data['countRIM'] = $this->improvementModel->getCountReturned();
            $data['countRTS'] = $this->troubleshootingModel->getCountReturned();
            $data['countRPD'] = $this->pengetahuandasarModel->getCountReturned();
        } elseif (in_groups('supervisor')) {
            $data['countTS'] = $this->troubleshootingModel->getCountOPLSupervisor();
            $data['countPD'] = $this->pengetahuandasarModel->getCountOPLSupervisor();
            $data['countIM'] = $this->improvementModel->getCountOPLSupervisor();
            $data['countRIM'] = $this->improvementModel->getCountCreated();
            $data['countRTS'] = $this->troubleshootingModel->getCountCreated();
            $data['countRPD'] = $this->pengetahuandasarModel->getCountCreated();
        } elseif (in_groups('engineer')) {
            $data['countTS'] = $this->troubleshootingModel->getCountOPLEngineer();
            $data['countPD'] = $this->pengetahuandasarModel->getCountOPLEngineer();
            $data['countIM'] = $this->improvementModel->getCountOPLEngineer();
            $data['countRIM'] = $this->improvementModel->getCountApproved();
            $data['countRTS'] = $this->troubleshootingModel->getCountApproved();
            $data['countRPD'] = $this->pengetahuandasarModel->getCountApproved();
            $data['maxCIM1'] = $this->improvementModel->getCountMax();
            $data['maxCIM'] = max($data['maxCIM1']);
            $data['maxCPD1'] = $this->pengetahuandasarModel->getCountMax();
            $data['maxCPD'] = max($data['maxCPD1']);
            $data['maxCTS1'] = $this->troubleshootingModel->getCountMax();
            $data['maxCTS'] = max($data['maxCTS1']);
        } elseif (in_groups('admin')) {
            $data['countTS'] = $this->troubleshootingModel->countAllResults();
            $data['countPD'] = $this->pengetahuandasarModel->countAllResults();
            $data['countIM'] = $this->improvementModel->countAllResults();
            $data['countRIM'] = '0';
            $data['countRTS'] = '0';
            $data['countRPD'] = '0';
        }

        return view('dashboard', $data);
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
        } else {
            $data = [
                'title' => 'View My Profile',
                'users' => $users,
                'distribusi' => $this->distribusiModel->getDistribusi(),
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

        $this->builder->select('users.id as userid, username, email, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        return view('user/index', $data);
    }

    public function KritikSaran($id = null)
    {

        $data = [
            'title' => 'Form Kritik dan Saran',
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
        } else {
            $data = [
                'title' => 'Change User Password',
                'distribusi' => $this->distribusiModel->getDistribusi(),
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
            return redirect()->to('/change-password')->with('pesan', "Password Has Been Updated");
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

        $filter = $this->request->getVar('filter');
        $distribusi = $this->request->getVar('distribusi');
        $mesin = $this->request->getVar('mesin');
        $users = $this->request->getVar('users');
        $month = $this->request->getVar('month');
        $year = $this->request->getVar('year');
        $oplNoPD = $this->request->getVar('oplNoPD');
        $oplNoIM = $this->request->getVar('oplNoIM');
        $oplNoTS = $this->request->getVar('oplNoTS');


        if ($month && $year && $users) {
            if (empty($mesin) && $users) {
                $query1 = $this->db->table('opl_pengetahuan_dasar')->select('opl_pengetahuan_dasar.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin')->join('users', 'users.id = opl_pengetahuan_dasar.pembuat')->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi')->where('MONTH(opl_pengetahuan_dasar.created_at)', $month)->where('YEAR(opl_pengetahuan_dasar.created_at)', $year)->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();

                $query2 = $this->db->table('opl_improvement')->select('opl_improvement.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_improvement.mesin')->join('users', 'users.id = opl_improvement.pembuat')->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where('MONTH(opl_improvement.created_at)', $month)->where('YEAR(opl_improvement.created_at)', $year)->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();

                $query3 = $this->db->table('opl_trouble_shooting')->select('opl_trouble_shooting.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_trouble_shooting.mesin')->join('users', 'users.id = opl_trouble_shooting.pembuat')->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where('MONTH(opl_trouble_shooting.created_at)', $month)->where('YEAR(opl_trouble_shooting.created_at)', $year)->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();
            } elseif ($mesin && $users) {
                $query1 = $this->db->table('opl_pengetahuan_dasar')->select('opl_pengetahuan_dasar.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin')->join('users', 'users.id = opl_pengetahuan_dasar.pembuat')->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi')->where('MONTH(opl_pengetahuan_dasar.created_at)', $month)->where('YEAR(opl_pengetahuan_dasar.created_at)', $year)->where(['mesin' => $mesin])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();

                $query2 = $this->db->table('opl_improvement')->select('opl_improvement.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_improvement.mesin')->join('users', 'users.id = opl_improvement.pembuat')->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where('MONTH(opl_improvement.created_at)', $month)->where('YEAR(opl_improvement.created_at)', $year)->where(['mesin' => $mesin])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();

                $query3 = $this->db->table('opl_trouble_shooting')->select('opl_trouble_shooting.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_trouble_shooting.mesin')->join('users', 'users.id = opl_trouble_shooting.pembuat')->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where('MONTH(opl_trouble_shooting.created_at)', $month)->where('YEAR(opl_trouble_shooting.created_at)', $year)->where(['mesin' => $mesin])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->get();
            }
        } elseif ($month && $year && $distribusi) {
            if (empty($mesin) && $distribusi) {
                $query1 = $this->db->table('opl_pengetahuan_dasar')->select('opl_pengetahuan_dasar.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin')->join('users', 'users.id = opl_pengetahuan_dasar.pembuat')->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi')->where('MONTH(opl_pengetahuan_dasar.created_at)', $month)->where('YEAR(opl_pengetahuan_dasar.created_at)', $year)->where('id_distribusi', $distribusi)->get();

                $query2 = $this->db->table('opl_improvement')->select('opl_improvement.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_improvement.mesin')->join('users', 'users.id = opl_improvement.pembuat')->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where('MONTH(opl_improvement.created_at)', $month)->where('YEAR(opl_improvement.created_at)', $year)->where('id_distribusi', $distribusi)->get();

                $query3 = $this->db->table('opl_trouble_shooting')->select('opl_trouble_shooting.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_trouble_shooting.mesin')->join('users', 'users.id = opl_trouble_shooting.pembuat')->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where('MONTH(opl_trouble_shooting.created_at)', $month)->where('YEAR(opl_trouble_shooting.created_at)', $year)->where('id_distribusi', $distribusi)->get();
            } elseif ($mesin && $distribusi) {
                $query1 = $this->db->table('opl_pengetahuan_dasar')->select('opl_pengetahuan_dasar.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin')->join('users', 'users.id = opl_pengetahuan_dasar.pembuat')->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi')->where('MONTH(opl_pengetahuan_dasar.created_at)', $month)->where('YEAR(opl_pengetahuan_dasar.created_at)', $year)->where(['mesin' => $mesin])->where('id_distribusi', $distribusi)->get();

                $query2 = $this->db->table('opl_improvement')->select('opl_improvement.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_improvement.mesin')->join('users', 'users.id = opl_improvement.pembuat')->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where('MONTH(opl_improvement.created_at)', $month)->where('YEAR(opl_improvement.created_at)', $year)->where(['mesin' => $mesin])->where('id_distribusi', $distribusi)->get();

                $query3 = $this->db->table('opl_trouble_shooting')->select('opl_trouble_shooting.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_trouble_shooting.mesin')->join('users', 'users.id = opl_trouble_shooting.pembuat')->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where('MONTH(opl_trouble_shooting.created_at)', $month)->where('YEAR(opl_trouble_shooting.created_at)', $year)->where(['mesin' => $mesin])->where('id_distribusi', $distribusi)->get();
            }
        } elseif ($month && $year && $mesin) {

            $query1 = $this->db->table('opl_pengetahuan_dasar')->select('opl_pengetahuan_dasar.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin')->join('users', 'users.id = opl_pengetahuan_dasar.pembuat')->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi')->where('MONTH(opl_pengetahuan_dasar.created_at)', $month)->where('YEAR(opl_pengetahuan_dasar.created_at)', $year)->where(['mesin' => $mesin])->get();

            $query2 = $this->db->table('opl_improvement')->select('opl_improvement.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_improvement.mesin')->join('users', 'users.id = opl_improvement.pembuat')->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where('MONTH(opl_improvement.created_at)', $month)->where('YEAR(opl_improvement.created_at)', $year)->where(['mesin' => $mesin])->get();

            $query3 = $this->db->table('opl_trouble_shooting')->select('opl_trouble_shooting.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_trouble_shooting.mesin')->join('users', 'users.id = opl_trouble_shooting.pembuat')->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where('MONTH(opl_trouble_shooting.created_at)', $month)->where('YEAR(opl_trouble_shooting.created_at)', $year)->where(['mesin' => $mesin])->get();
        } elseif ($month && $year && $oplNoIM || $oplNoPD || $oplNoTS) {

            $query1 = $this->db->table('opl_pengetahuan_dasar')->select('opl_pengetahuan_dasar.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_pengetahuan_dasar.mesin')->join('users', 'users.id = opl_pengetahuan_dasar.pembuat')->join('distribusi', 'distribusi.id = opl_pengetahuan_dasar.id_distribusi')->where('MONTH(opl_pengetahuan_dasar.created_at)', $month)->where('YEAR(opl_pengetahuan_dasar.created_at)', $year)->where(['opl_pengetahuan_dasar.id' => $oplNoPD])->get();

            $query2 = $this->db->table('opl_improvement')->select('opl_improvement.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_improvement.mesin')->join('users', 'users.id = opl_improvement.pembuat')->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where('MONTH(opl_improvement.created_at)', $month)->where('YEAR(opl_improvement.created_at)', $year)->where(['opl_improvement.id' => $oplNoIM])->get();

            $query3 = $this->db->table('opl_trouble_shooting')->select('opl_trouble_shooting.*, mesin.nama_mesin, distribusi.nama_distribusi, users.fullname')->join('mesin', 'mesin.id = opl_trouble_shooting.mesin')->join('users', 'users.id = opl_trouble_shooting.pembuat')->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where('MONTH(opl_trouble_shooting.created_at)', $month)->where('YEAR(opl_trouble_shooting.created_at)', $year)->where(['opl_trouble_shooting.id' => $oplNoTS])->get();
        }


        $pengetahuandasar = $query1->getResultArray();
        $improvement = $query2->getResultArray();
        $troubleshooting = $query3->getResultArray();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kategori');
        $sheet->setCellValue('C1', 'OPL No.');
        $sheet->setCellValue('D1', 'Tema');
        $sheet->setCellValue('E1', 'Tujuan');
        $sheet->setCellValue('F1', 'Fungsi');
        $sheet->setCellValue('G1', 'Penjelasan');
        $sheet->setCellValue('H1', 'Dampak');
        $sheet->setCellValue('I1', 'Mesin');
        $sheet->setCellValue('J1', 'Pembuat');
        $sheet->setCellValue('K1', 'Department');
        $sheet->setCellValue('L1', 'Status OPL');
        $sheet->setCellValue('M1', 'Tanggal Dibuat');

        $column = 2;
        foreach ($pengetahuandasar as $PD) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, 'Pengetahuan Dasar');
            if (stripos($PD['opl_no'], 'OPL') !== FALSE) {     // INI UNTUK CEK KAYAK OPERATOR LIKE YANG ADA DI SQL
                $sheet->setCellValue('C' . $column, $PD['opl_no']);
            } else {
                $sheet->setCellValue('C' . $column, 'NA');
            }
            $sheet->setCellValue('D' . $column, $PD['tema']);
            $sheet->setCellValue('E' . $column, $PD['tujuan']);
            $sheet->setCellValue('F' . $column, $PD['fungsi']);
            $sheet->setCellValue('G' . $column, $PD['penjelasan']);
            $sheet->setCellValue('H' . $column, $PD['dampak']);
            $sheet->setCellValue('I' . $column, $PD['nama_mesin']);
            $sheet->setCellValue('J' . $column, $PD['fullname']);
            $sheet->setCellValue('K' . $column, $PD['nama_distribusi']);
            $sheet->setCellValue('L' . $column, $PD['status']);
            $sheet->setCellValue('M' . $column, $PD['created_at']);
            $column++;
        }

        foreach ($improvement as $IM) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, 'Improvement');
            if (stripos($IM['opl_no'], 'OPL') !== FALSE) {     // INI UNTUK CEK KAYAK OPERATOR LIKE YANG ADA DI SQL
                $sheet->setCellValue('C' . $column, $IM['opl_no']);
            } else {
                $sheet->setCellValue('C' . $column, 'NA');
            }
            $sheet->setCellValue('D' . $column, $IM['tema']);
            $sheet->setCellValue('E' . $column, $IM['tujuan']);
            $sheet->setCellValue('F' . $column, $IM['fungsi']);
            $sheet->setCellValue('G' . $column, $IM['penjelasan']);
            $sheet->setCellValue('H' . $column, $IM['dampak']);
            $sheet->setCellValue('I' . $column, $IM['nama_mesin']);
            $sheet->setCellValue('J' . $column, $IM['fullname']);
            $sheet->setCellValue('K' . $column, $IM['nama_distribusi']);
            $sheet->setCellValue('L' . $column, $IM['status']);
            $sheet->setCellValue('M' . $column, $IM['created_at']);
            $column++;
        }

        foreach ($troubleshooting as $TS) {
            $sheet->setCellValue('A' . $column, ($column - 1));
            $sheet->setCellValue('B' . $column, 'Trouble Shooting');
            if (stripos($TS['opl_no'], 'OPL') !== FALSE) {     // INI UNTUK CEK KAYAK OPERATOR LIKE YANG ADA DI SQL
                $sheet->setCellValue('C' . $column, $TS['opl_no']);
            } else {
                $sheet->setCellValue('C' . $column, 'NA');
            }
            $sheet->setCellValue('D' . $column, $TS['tema']);
            $sheet->setCellValue('E' . $column, $TS['tujuan']);
            $sheet->setCellValue('F' . $column, $TS['fungsi']);
            $sheet->setCellValue('G' . $column, $TS['penjelasan']);
            $sheet->setCellValue('H' . $column, $TS['dampak']);
            $sheet->setCellValue('I' . $column, $TS['nama_mesin']);
            $sheet->setCellValue('J' . $column, $TS['fullname']);
            $sheet->setCellValue('K' . $column, $TS['nama_distribusi']);
            $sheet->setCellValue('L' . $column, $TS['status']);
            $sheet->setCellValue('M' . $column, $TS['created_at']);
            $column++;
        }

        $sheet->getStyle('A1:M1')->getFont()->setBold(true);
        $sheet->getStyle('A1:M1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('93bd84');

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
        $sheet->getColumnDimension('M')->setAutoSize(true);

        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=export-OPL.xlsx');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
        exit();

        return redirect(base_url());
    }
}
