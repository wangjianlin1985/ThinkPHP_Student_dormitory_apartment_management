<?php
namespace app\front\controller;
use think\Request;
use think\Exception;
use app\common\model\ClassInfoModel;
use app\common\model\SusheModel;
use app\common\model\StudentModel;

class Student extends Base {
    protected $classInfoModel;
    protected $susheModel;
    protected $studentModel;

    //控制层对象初始化：注入业务逻辑层对象等
    public function _initialize() {
        parent::_initialize();
        $this->request = Request::instance();
        $this->classInfoModel = new ClassInfoModel();
        $this->susheModel = new SusheModel();
        $this->studentModel = new StudentModel();
    }

    /*添加学生信息*/
    public function frontAdd(){
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $student = $this->getStudentForm(true);
            $this->uploadPhoto($student,"studentPhoto","studentPhotoFile"); //处理学生照片上传
            try {
                $this->studentModel->addStudent($student);
                $message = "学生添加成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学生添加失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            return $this->fetch('student/student_frontAdd');
        }
    }

    /*前台修改学生信息*/
    public function frontModify() {
        $this->assign("studentNo",input("studentNo"));
        return $this->fetch("student/student_frontModify");
    }

    /*前台按照查询条件分页查询学生信息*/
    public function frontlist() {
        if($this->request->param("currentPage") != null)
            $this->currentPage = $this->request->param("currentPage");
        $studentNo = input("studentNo")==null?"":input("studentNo");
        $name = input("name")==null?"":input("name");
        $birthday = input("birthday")==null?"":input("birthday");
        $qq = input("qq")==null?"":input("qq");
        $mobile = input("mobile")==null?"":input("mobile");
        $classObj["classNo"] = input("classObj_classNo")==null?"":input("classObj_classNo");
        $susheObj["susheId"] = input("susheObj_susheId")==null?0:input("susheObj_susheId");
        $addTime = input("addTime")==null?"":input("addTime");
        $studentRs = $this->studentModel->queryStudent($studentNo, $name, $birthday, $qq, $mobile, $classObj, $susheObj, $addTime, $this->currentPage);
        $this->assign("studentRs",$studentRs);
        /*获取到总的页码数目*/
        $this->assign("totalPage",$this->studentModel->totalPage);
        /*当前查询条件下总记录数*/
        $this->assign("recordNumber",$this->studentModel->recordNumber);
        $this->assign("currentPage",$this->currentPage);
        $this->assign("rows",$this->studentModel->rows);
        $this->assign("studentNo",$studentNo);
        $this->assign("name",$name);
        $this->assign("birthday",$birthday);
        $this->assign("qq",$qq);
        $this->assign("mobile",$mobile);
        $this->assign("classObj",$classObj);
        $this->assign("classInfoList",$this->classInfoModel->queryAllClassInfo());
        $this->assign("susheObj",$susheObj);
        $this->assign("susheList",$this->susheModel->queryAllSushe());
        $this->assign("addTime",$addTime);
        return $this->fetch('student/student_frontlist');
    }

    /*ajax方式查询学生信息*/
    public function listAll() {
        $studentRs = $this->studentModel->queryAllStudent();
        echo json_encode($studentRs);
    }
    /*前台查询根据主键查询一条学生信息*/
    public function frontshow() {
        $studentNo = input("studentNo");
        $student = $this->studentModel->getStudent($studentNo);
       $this->assign("student",$student);
        return $this->fetch("student/student_frontshow");
    }

    /*更新学生信息*/
    public function update() {
        $message = "";
        $success = false;
        if($this->request->isPost()) {
            $student = $this->getStudentForm(false);
            $this->uploadPhoto($student,"studentPhoto","studentPhotoFile"); //处理学生照片上传
            try {
                $this->studentModel->updateStudent($student);
                $message = "学生更新成功!";
                $success = true;
                $this->writeJsonResponse($success, $message);
            } catch (Exception $ex) {
                $message = "学生更新失败!";
                $this->writeJsonResponse($success,$message);
            }
        } else {
            /*根据主键获取学生对象*/
            $studentNo = input("studentNo");
            $student = $this->studentModel->getStudent($studentNo);
            echo json_encode($student);
        }
    }

    /*删除多条学生记录*/
    public function deletes() {
        $message = "";
        $success = false;
        $studentNos = input("studentNos");
        try {
            $count = $this->studentModel->deleteStudents($studentNos);
            $success = true;
            $message = $count."条记录删除成功";
            $this->writeJsonResponse($success, $message);
        } catch (Exception $ex) {
            $message = "有记录存在外键约束,删除失败";
            $this->writeJsonResponse($success, $message);
        }
    }

}

