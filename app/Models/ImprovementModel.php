<?php

namespace App\Models;

use CodeIgniter\Model;

class ImprovementModel extends Model
{
    protected $table      = 'opl_improvement';
    protected $useTimeStamps      = True;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $allowedFields = ['tema', 'tujuan', 'fungsi', 'dampak', 'penjelasan', 'id_foto', 'mesin', 'opl_no', 'sd/wi_no', 'status', 'alasan', 'revisi', 'pembuat', 'penyetuju', 'engineer', 'returner', 'rejecter', 'checked_at', 'approved_at', 'rejected_at', 'returned_at', 'id_distribusi', 'realisasi'];

    public function getImprovement($id = false)
    {
        if ($id == false) {
            return $this->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    public function getImprovementUser()
    {

        return $this->join('distribusi', 'distribusi.id = opl_improvement.id_distribusi')->where(['pembuat' => user_id()])->orderBy('opl_improvement.created_at', 'DESC')->findAll();
    }

    public function search($keyword)
    {
        return $this->table('opl_improvement')->like('tema', $keyword);
    }

    public function getCountIM($id = false)
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

    public function getCountYearly()
    {
        return $this->selectCount('id')->where('YEAR(created_at)', date('Y'))->where(['pembuat' => user()->id])->like('status', 'Created')->groupBy('MONTH(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalYearly()
    {
        return $this->selectCount('id')->where('YEAR(created_at)', date('Y'))->where(['pembuat' => user()->id])->like('status', 'Created')->groupBy('MONTH(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }



    public function getCountOPLSupervisor($id = false)
    {
        return $this->where('penyetuju', user()->id)->like('status', 'Approved')->countAllResults();
    }

    public function getCountCreated($id = false)
    {
        return $this->where('status', 'Created')->where('id_distribusi', user()->distribusi)->countAllResults();
    }

    public function getCountMonthly($month, $year, $distribusi, $users)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['id_distribusi' => $distribusi])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->findAll();
    }

    public function getTotalMonthly($month, $year, $distribusi, $users)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['id_distribusi' => $distribusi])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->groupBy('WEEK(created_at)')->orderBy('created_at', 'ASC')->countAllResults();
    }

    public function getTotal($month, $year, $distribusi, $users)
    {
        return $this->selectCount('id')->where('MONTH(created_at)', $month)->where('YEAR(created_at)', $year)->where(['id_distribusi' => $distribusi])->where(['pembuat' => $users])->orwhere(['penyetuju' => $users])->orwhere(['engineer' => $users])->orderBy('created_at', 'ASC')->countAllResults();
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
        return $this->distinct('opl_improvement.id')->select('opl_improvement.id')->join('realisasi_im', 'realisasi_im.id_im = opl_improvement.id')->where('id_trainee', user_id())->countAllResults();
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
