<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\StudentModel;
use app\common\model\FangkeModel;

class Fangke extends BackBase {
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
    public function add(){
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
            return view('fangke/fangke_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("fangkeId",input("fangkeId"));
        return view("fangke/fangke_modify");
    }

    /*ajax方式按照查询条件分页查询访客信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->fangkeModel->setRows($this->request->param("rows"));
            $fangkeName = input("fangkeName")==null?"":input("fangkeName");
            $studentObj["studentNo"] = input("studentObj_studentNo")==null?"":input("studentObj_studentNo");
            $inTime = input("inTime")==null?"":input("inTime");
            $leaveTime = input("leaveTime")==null?"":input("leaveTime");
            $fangkeRs = $this->fangkeModel->queryFangke($fangkeName, $studentObj, $inTime, $leaveTime, $this->currentPage);
            $expTableData = [];
            foreach($fangkeRs as $fangkeRow) {
                $fangkeRow["studentObj"] = $this->studentModel->getStudent($fangkeRow["studentObj"])["name"];
                $expTableData[] = $fangkeRow;
            }
            $data["rows"] = $fangkeRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->fangkeModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("fangke/fangke_query");
        }
    }

    /*ajax方式查询访客信息*/
    public function listAll() {
        $fangkeRs = $this->fangkeModel->queryAllFangke();
        echo json_encode($fangkeRs);
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

    /*按照查询条件导出访客信息到Excel*/
    public function outToExcel() {
        $fangkeName = input("fangkeName")==null?"":input("fangkeName");
        $studentObj["studentNo"] = input("studentObj_studentNo")==null?"":input("studentObj_studentNo");
        $inTime = input("inTime")==null?"":input("inTime");
        $leaveTime = input("leaveTime")==null?"":input("leaveTime");
        $fangkeRs = $this->fangkeModel->queryOutputFangke($fangkeName,$studentObj,$inTime,$leaveTime);
        $expTableData = [];
        foreach($fangkeRs as $fangkeRow) {
            $fangkeRow["studentObj"] = $this->studentModel->getStudent($fangkeRow["studentObj"])["name"];
            $expTableData[] = $fangkeRow;
        }
        $xlsName = "Fangke";
        $xlsCell = array(
            array('fangkeId','访客ID','int'),
            array('fangkeName','访客姓名','string'),
            array('studentObj','受访学生','string'),
            array('guanxi','关系','string'),
            array('inTime','进入时间','string'),
            array('leaveTime','离开时间','string'),
            array('addTime','创建时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

