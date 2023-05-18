<?php
namespace app\common\model;
use think\Model;

class ClassInfoModel extends Model {
    /*关联表名*/
    protected $table  = 't_classInfo';
    /*每页显示记录数目*/
    public $rows = 8;
    /*保存查询后总的页数*/
    public $totalPage;
    /*保存查询到的总记录数*/
    public $recordNumber;

    public function setRows($rows) {
        $this->rows = $rows;
    }

    /*添加班级记录*/
    public function addClassInfo($classInfo) {
        $this->insert($classInfo);
    }

    /*更新班级记录*/
    public function updateClassInfo($classInfo) {
        $this->update($classInfo);
    }

    /*删除多条班级信息*/
    public function deleteClassInfos($classNos){
        $classNoArray = explode(",",$classNos);
        foreach ($classNoArray as $classNo) {
            $this->classNo = $classNo;
            $this->delete();
        }
        return count($classNoArray);
    }
    /*根据主键获取班级记录*/
    public function getClassInfo($classNo) {
        $classInfo = ClassInfoModel::where("classNo",$classNo)->find();
        return $classInfo;
    }

    /*按照查询条件分页查询班级信息*/
    public function queryClassInfo($classNo, $className, $fudaoyuan, $addTime, $currentPage) {
        $startIndex = ($currentPage-1) * $this->rows;
        $where = null;
        if($classNo != "") $where['classNo'] = array('like','%'.$classNo.'%');
        if($className != "") $where['className'] = array('like','%'.$className.'%');
        if($fudaoyuan != "") $where['fudaoyuan'] = array('like','%'.$fudaoyuan.'%');
        if($addTime != "") $where['addTime'] = array('like','%'.$addTime.'%');
        $classInfoRs = ClassInfoModel::where($where)->limit($startIndex,$this->rows)->select();
        /*计算总的页数和总的记录数*/
        $this->recordNumber = ClassInfoModel::where($where)->count();
        $mod = $this->recordNumber % $this->rows;
        $this->totalPage = (int)($this->recordNumber / $this->rows);
        if($mod != 0) $this->totalPage++;
        return $classInfoRs;
    }

    /*按照查询条件查询所有班级记录*/
  public function queryOutputClassInfo( $classNo,  $className,  $fudaoyuan,  $addTime) {
        $where = null;
        if($classNo != "") $where['classNo'] = array('like','%'.$classNo.'%');
        if($className != "") $where['className'] = array('like','%'.$className.'%');
        if($fudaoyuan != "") $where['fudaoyuan'] = array('like','%'.$fudaoyuan.'%');
        if($addTime != "") $where['addTime'] = array('like','%'.$addTime.'%');
        $classInfoRs = ClassInfoModel::where($where)->select();
        return $classInfoRs;
    }

    /*查询所有班级记录*/
    public function queryAllClassInfo(){
        $classInfoRs = ClassInfoModel::where(null)->select();
        return $classInfoRs;

    }

}
