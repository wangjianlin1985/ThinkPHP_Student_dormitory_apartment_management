<?php
namespace app\common\model;
use think\Model;

class FangkeModel extends Model {
    /*关联表名*/
    protected $table  = 't_fangke';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    //受访学生复合属性的获取: 多对一关系
    public function studentObjF(){
        return $this->belongsTo('StudentModel','studentObj');
    }

    /*添加访客记录*/
    public function addFangke($fangke) {
        $this->insert($fangke);
    }

    /*更新访客记录*/
    public function updateFangke($fangke) {
        $this->update($fangke);
    }

    /*删除多条访客信息*/
    public function deleteFangkes($fangkeIds){
        $fangkeIdArray = explode(",",$fangkeIds);
        foreach ($fangkeIdArray as $fangkeId) {
            $this->fangkeId = $fangkeId;
            $this->delete();
        }
        return count($fangkeIdArray);
    }
    /*根据主键获取访客记录*/
    public function getFangke($fangkeId) {
        $fangke = FangkeModel::where("fangkeId",$fangkeId)->find();
        return $fangke;
    }

    /*按照查询条件分页查询访客信息*/
    public function queryFangke($fangkeName, $studentObj, $inTime, $leaveTime, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($fangkeName != "") $where['fangkeName'] = array('like','%'.$fangkeName.'%');
        if($studentObj['studentNo'] != "") $where['studentObj'] = $studentObj['studentNo'];
        if($inTime != "") $where['inTime'] = array('like','%'.$inTime.'%');
        if($leaveTime != "") $where['leaveTime'] = array('like','%'.$leaveTime.'%');
        $fangkeRs = FangkeModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = FangkeModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $fangkeRs;
    }

    /*按照查询条件查询所有访客记录*/
  public function queryOutputFangke( $fangkeName,  $studentObj,  $inTime,  $leaveTime) {
        $where = null;
        if($fangkeName != "") $where['fangkeName'] = array('like','%'.$fangkeName.'%');
        if($studentObj['studentNo'] != "") $where['studentObj'] = $studentObj['studentNo'];
        if($inTime != "") $where['inTime'] = array('like','%'.$inTime.'%');
        if($leaveTime != "") $where['leaveTime'] = array('like','%'.$leaveTime.'%');
        $fangkeRs = FangkeModel::where($where)->select();
        return $fangkeRs;
    }

    /*查询所有访客记录*/
    public function queryAllFangke(){
        $fangkeRs = FangkeModel::where(null)->select();
        return $fangkeRs;

    }

}
