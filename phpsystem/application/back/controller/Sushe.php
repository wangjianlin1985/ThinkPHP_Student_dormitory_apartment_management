<?php
namespace app\back\controller;
use think\Request;
use think\Exception;
use app\common\model\SusheModel;

class Sushe extends BackBase {
    protected $susheModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->susheModel = new SusheModel();
    }

    /*添加宿舍信息*/
    public function add(){
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
            return view('sushe/sushe_add');
        }
    }

    /*跳转到更新界面*/
    public function modifyView() {
        $this->assign("susheId",input("susheId"));
        return view("sushe/sushe_modify");
    }

    /*ajax方式按照查询条件分页查询宿舍信息*/
    public function backList() {
        if($this->request->isPost()) {
            if($this->request->param("page") != null)
                $this->currentPage = $this->request->param("page");
            if($this->request->param("rows") != null)
                $this->susheModel->setRows($this->request->param("rows"));
            $susheName = input("susheName")==null?"":input("susheName");
            $guanliyuan = input("guanliyuan")==null?"":input("guanliyuan");
            $addTime = input("addTime")==null?"":input("addTime");
            $susheRs = $this->susheModel->querySushe($susheName, $guanliyuan, $addTime, $this->currentPage);
            $expTableData = [];
            foreach($susheRs as $susheRow) {
                $expTableData[] = $susheRow;
            }
            $data["rows"] = $susheRs;
            /*当前查询条件下总记录数*/
            $data["total"] = $this->susheModel->recordNumber;
            echo json_encode($data);
        } else {
            return view("sushe/sushe_query");
        }
    }

    /*ajax方式查询宿舍信息*/
    public function listAll() {
        $susheRs = $this->susheModel->queryAllSushe();
        echo json_encode($susheRs);
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

    /*按照查询条件导出宿舍信息到Excel*/
    public function outToExcel() {
        $susheName = input("susheName")==null?"":input("susheName");
        $guanliyuan = input("guanliyuan")==null?"":input("guanliyuan");
        $addTime = input("addTime")==null?"":input("addTime");
        $susheRs = $this->susheModel->queryOutputSushe($susheName,$guanliyuan,$addTime);
        $expTableData = [];
        foreach($susheRs as $susheRow) {
            $expTableData[] = $susheRow;
        }
        $xlsName = "Sushe";
        $xlsCell = array(
            array('susheId','宿舍ID','int'),
            array('susheName','宿舍名称','string'),
            array('totalBedNum','床位总数','int'),
            array('usedBedNum','已用床位','int'),
            array('guanliyuan','宿舍管理员','string'),
            array('addTime','创建时间','string'),
        );//查出字段输出对应Excel对应的列名
        //公共方法调用
        $this->export_excel($xlsName,$xlsCell,$expTableData);
    }

}

