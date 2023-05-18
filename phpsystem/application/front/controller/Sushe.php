<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\SusheModel;

class Sushe extends Base {
    protected $susheModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->susheModel = new SusheModel();
    }

    /*添加宿舍信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $sushe = $this->getSusheForm(true);
            try {
                $this->susheModel->addSushe($sushe);
                $message = "宿舍添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "宿舍添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('sushe/sushe_frontAdd');
        }
    }

    /*前台修改宿舍信息*/
    public function frontModify() {
        $this->assign("susheId",input("susheId"));
        return $this->fetch("sushe/sushe_frontModify");
    }

    /*前台按照查询条件分页查询宿舍信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $susheName = input("susheName")==null?"":input("susheName");
        $guanliyuan = input("guanliyuan")==null?"":input("guanliyuan");
        $addTime = input("addTime")==null?"":input("addTime");
        $susheRs = $this->susheModel->querySushe($susheName, $guanliyuan, $addTime, $this->currentPage);
        $this->assign("susheRs",$susheRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->susheModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->susheModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->susheModel->rows);
        $this->assign("susheName",$susheName);
        $this->assign("guanliyuan",$guanliyuan);
        $this->assign("addTime",$addTime);
        return $this->fetch('sushe/sushe_frontlist');
    }

    /*ajax方式查询宿舍信息*/
    public function listAll() {
        $susheRs = $this->susheModel->queryAllSushe();
        echo json_encode($susheRs);
    }
    /*前台查询根据主键查询一条宿舍信息*/
    public function frontshow() {
        $susheId = input("susheId");
        $sushe = $this->susheModel->getSushe($susheId);
       $this->assign("sushe",$sushe);
        return $this->fetch("sushe/sushe_frontshow");
    }

    /*更新宿舍信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $sushe = $this->getSusheForm(false);
            try {
                $this->susheModel->updateSushe($sushe);
                $message = "宿舍更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "宿舍更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取宿舍对象*/
            $susheId = input("susheId");
            $sushe = $this->susheModel->getSushe($susheId);
            echo json_encode($sushe);
        }
    }

    /*删除多条宿舍记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $susheIds = input("susheIds");
        try {
            $count = $this->susheModel->deleteSushes($susheIds);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

