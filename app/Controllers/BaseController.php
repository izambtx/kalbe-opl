<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\TroubleShootingModel;
use App\Models\ImprovementModel;
use App\Models\PengetahuanDasarModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $improvementModel;
    protected $pengetahuandasarModel;
    protected $troubleshootingModel;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['auth'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    protected $config;

    /**
     * Constructor.
     */

    public function __construct()
    {
        $this->troubleshootingModel = new TroubleShootingModel();
        $this->pengetahuandasarModel = new PengetahuanDasarModel();
        $this->improvementModel = new ImprovementModel();
    }
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        session();
        date_default_timezone_set("ASIA/JAKARTA");


        $countTS = $this->troubleshootingModel->getCountOPL();
        $countPD = $this->pengetahuandasarModel->getCountOPL();
        $countIM = $this->improvementModel->getCountOPL();
        $countRIM = $this->improvementModel->getCountReturned();
        $countRTS = $this->troubleshootingModel->getCountReturned();
        $countRPD = $this->pengetahuandasarModel->getCountReturned();
        $countTS = $this->troubleshootingModel->getCountOPLSupervisor();
        $countPD = $this->pengetahuandasarModel->getCountOPLSupervisor();
        $countIM = $this->improvementModel->getCountOPLSupervisor();
        $countRIM = $this->improvementModel->getCountCreated();
        $countRTS = $this->troubleshootingModel->getCountCreated();
        $countRPD = $this->pengetahuandasarModel->getCountCreated();
        $countTS = $this->troubleshootingModel->getCountOPLEngineer();
        $countPD = $this->pengetahuandasarModel->getCountOPLEngineer();
        $countIM = $this->improvementModel->getCountOPLEngineer();
        $countRIM = $this->improvementModel->getCountApproved();
        $countRTS = $this->troubleshootingModel->getCountApproved();
        $countRPD = $this->pengetahuandasarModel->getCountApproved();
        $countSPD = $this->pengetahuandasarModel->getSosialisasiOPL();
        $countTSPD = $this->pengetahuandasarModel->getTotalSosialisasi();
        $countSTS = $this->troubleshootingModel->getSosialisasiOPL();
        $countTSTS = $this->troubleshootingModel->getTotalSosialisasi();
        $countSIM = $this->improvementModel->getSosialisasiOPL();
        $countTSIM = $this->improvementModel->getTotalSosialisasi();
    }
}
