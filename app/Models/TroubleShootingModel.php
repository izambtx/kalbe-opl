<?php

namespace App\Models;

use CodeIgniter\Model;

class TroubleShootingModel extends Model
{
    protected $table      = 'opl_trouble_shooting';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['tema', 'tujuan', 'fungsi', 'dampak', 'penjelasan', 'id_foto', 'mesin', 'opl_no', 'sd/wi_no', 'status', 'alasan', 'revisi', 'pembuat', 'penyetuju', 'engineer', 'returner', 'rejecter', 'checked_at', 'approved_at', 'rejected_at', 'returned_at', 'id_distribusi', 'realisasi'];

    public function getTroubleShooting($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getTroubleShootingUser()
    {
        return $this->join('distribusi', 'distribusi.id = opl_trouble_shooting.id_distribusi')->where(['pembuat' => user_id()])->orderBy('opl_trouble_shooting.created_at', 'DESC')->findAll();
    }

    public function search($keyword)
    {
        return $this->table('opl_trouble_shooting')->like('tema', $keyword);
    }

    public function getCountTS($id = false)
    {
        return $this->countAllResults();
    }

    public function getCountOPL($id = false)
    {
        return $this->where('pembuat', user()->id)->countAllResults();
    }

    public function getCountReturned($id = false)
    {
        return $this->like('status', 'Returned')->where('pembuat', user()->id)->countAllResults();
    }



    public function getCountOPLSupervisor($id = false)
    {
        return $this->where('penyetuju', user()->id)->like('status', 'Approved')->countAllResults();
    }

    public function getCountCreated($id = false)
    {
        return $this->where('status', 'Created')->where('id_distribusi', user()->distribusi)->countAllResults();
    }

    public function getCountMonthly($month, $year, $users)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthly($month, $year, $users)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotal($month, $year, $users)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getCountMonthlyDept($month, $year, $distribusi)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['id_distribusi' => $distribusi])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthlyDept($month, $year, $distribusi)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['id_distribusi' => $distribusi])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotalDept($month, $year, $distribusi)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['id_distribusi' => $distribusi])->orderBy('created_at', 'ASC')->countAllResults();
    }


    public function getTotalSosialisasi()
    {
        return $this->where(['realisasi' => 'TRUE'])->where(['id_distribusi' => user()->distribusi])->countAllResults();
    }

    public function getSosialisasiOPL()
    {
        return $this->distinct('opl_trouble_shooting.id')->select('opl_trouble_shooting.id')->join('realisasi_ts', 'realisasi_ts.id_ts = opl_trouble_shooting.id')->where('id_trainee', user_id())->countAllResults();
    }


    public function getCountOPLEngineer($id = false)
    {
        return $this->where('engineer', user()->id)->countAllResults();
    }

    public function getCountApproved($id = false)
    {
        $mesin = [1];
        return $this->where('status', 'Approved Supervisor')->whereNotIn('mesin', $mesin)->countAllResults();
    }
}
