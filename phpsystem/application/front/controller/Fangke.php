<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\StudentModel;
use app\common\model\FangkeModel;

class Fangke extends Base {
    protected $studentModel;
    protected $fangkeModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->studentModel = new StudentModel();
        $this->fangkeModel = new FangkeModel();
    }

    /*添加访客信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $fangke = $this->getFangkeForm(true);
            try {
                $this->fangkeModel->addFangke($fangke);
                $message = "访客添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "访客添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('fangke/fangke_frontAdd');
        }
    }

    /*前台修改访客信息*/
    public function frontModify() {
        $this->assign("fangkeId",input("fangkeId"));
        return $this->fetch("fangke/fangke_frontModify");
    }

    /*前台按照查询条件分页查询访客信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $fangkeName = input("fangkeName")==null?"":input("fangkeName");
        $studentObj["studentNo"] = input("studentObj_studentNo")==null?"":input("studentObj_studentNo");
        $inTime = input("inTime")==null?"":input("inTime");
        $leaveTime = input("leaveTime")==null?"":input("leaveTime");
        $fangkeRs = $this->fangkeModel->queryFangke($fangkeName, $studentObj, $inTime, $leaveTime, $this->currentPage);
        $this->assign("fangkeRs",$fangkeRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->fangkeModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->fangkeModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->fangkeModel->rows);
        $this->assign("fangkeName",$fangkeName);
        $this->assign("studentObj",$studentObj);
        $this->assign("studentList",$this->studentModel->queryAllStudent());
        $this->assign("inTime",$inTime);
        $this->assign("leaveTime",$leaveTime);
        return $this->fetch('fangke/fangke_frontlist');
    }

    /*ajax方式查询访客信息*/
    public function listAll() {
        $fangkeRs = $this->fangkeModel->queryAllFangke();
        echo json_encode($fangkeRs);
    }
    /*前台查询根据主键查询一条访客信息*/
    public function frontshow() {
        $fangkeId = input("fangkeId");
        $fangke = $this->fangkeModel->getFangke($fangkeId);
       $this->assign("fangke",$fangke);
        return $this->fetch("fangke/fangke_frontshow");
    }

    /*更新访客信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $fangke = $this->getFangkeForm(false);
            try {
                $this->fangkeModel->updateFangke($fangke);
                $message = "访客更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "访客更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取访客对象*/
            $fangkeId = input("fangkeId");
            $fangke = $this->fangkeModel->getFangke($fangkeId);
            echo json_encode($fangke);
        }
    }

    /*删除多条访客记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $fangkeIds = input("fangkeIds");
        try {
            $count = $this->fangkeModel->deleteFangkes($fangkeIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

