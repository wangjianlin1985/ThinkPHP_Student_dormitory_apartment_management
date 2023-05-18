<?php
namespace app\common\model;
use think\Model;

class SusheModel extends Model {
    /*关联表名*/
    protected $table  = 't_sushe';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加宿舍记录*/
    public function addSushe($sushe) {
        $this->insert($sushe);
    }

    /*更新宿舍记录*/
    public function updateSushe($sushe) {
        $this->update($sushe);
    }

    /*删除多条宿舍信息*/
    public function deleteSushes($susheIds){
        $susheIdArray = explode(",",$susheIds);
        foreach ($susheIdArray as $susheId) {
            $this->susheId = $susheId;
            $this->delete();
        }
        return count($susheIdArray);
    }
    /*根据主键获取宿舍记录*/
    public function getSushe($susheId) {
        $sushe = SusheModel::where("susheId",$susheId)->find();
        return $sushe;
    }

    /*按照查询条件分页查询宿舍信息*/
    public function querySushe($susheName, $guanliyuan, $addTime, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($susheName != "") $where['susheName'] = array('like','%'.$susheName.'%');
        if($guanliyuan != "") $where['guanliyuan'] = array('like','%'.$guanliyuan.'%');
        if($addTime != "") $where['addTime'] = array('like','%'.$addTime.'%');
        $susheRs = SusheModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = SusheModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $susheRs;
    }

    /*按照查询条件查询所有宿舍记录*/
  public function queryOutputSushe( $susheName,  $guanliyuan,  $addTime) {
        $where = null;
        if($susheName != "") $where['susheName'] = array('like','%'.$susheName.'%');
        if($guanliyuan != "") $where['guanliyuan'] = array('like','%'.$guanliyuan.'%');
        if($addTime != "") $where['addTime'] = array('like','%'.$addTime.'%');
        $susheRs = SusheModel::where($where)->select();
        return $susheRs;
    }

    /*查询所有宿舍记录*/
    public function queryAllSushe(){
        $susheRs = SusheModel::where(null)->select();
        return $susheRs;

    }

}
