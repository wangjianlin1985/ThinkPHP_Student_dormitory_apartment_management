<?php
namespace app\front\controller;
use think\Controller;

class Base extends Controller
{
    protected $currentPage = 1;
    protected $request = null;

    //向客户端输出ajax响应结果
    public function writeJsonResponse($success, $message) {
        $response = array(
            "success" => $success,
            "message" => $message,
        );
        echo json_encode($response);
    }

    /**
     * @param $obj:  保存图片路径的对象
     * @param $indexName 索引名称
     * @param $photoFiledName 提交的图片表单名称
     */
    public function uploadPhoto(&$obj,$indexName,$photoFiledName) {
        if($_FILES[$photoFiledName]['tmp_name']){
            $file = $this->request->file($photoFiledName);
            //控制上传的文件类型，大小
            if(!(($_FILES[$photoFiledName]["type"]=="image/jpeg"
                    || $_FILES[$photoFiledName]["type"]=="image/jpg"
                    || $_FILES[$photoFiledName]["type"]=="image/png") && $_FILES[$photoFiledName]["size"] < 1024000)) {
                $message = "图书图片请选择jpg或png格式的图片!";
                $this->writeJsonResponse(false,$message);
                exit;
            }
            $file->setRule("short"); //文件路径采用简短方式
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            $obj[$indexName]='upload/'.$info->getSaveName();
        }
    }

    /**
     * @param $obj:  保存文件路径的对象
     * @param $indexName 索引名称
     * @param $resourceFiledName 提交的文件表单名称
     */
    public function uploadFile(&$obj,$indexName,$resourceFiledName) {
        if($_FILES[$resourceFiledName]['tmp_name']){
            $file = $this->request->file($resourceFiledName);
            $file->setRule("short"); //文件路径采用简短方式
            $info = $file->move(ROOT_PATH . 'public' . DS . 'upload');
            $obj[$indexName]='upload/'.$info->getSaveName();
        }
    }

    //接收提交的Student信息参数
    public function getStudentForm($insertFlag) {
        $student = [
            'studentNo'=> input("student_studentNo"), //学号
            'name'=> input("student_name"), //姓名
            'sex'=> input("student_sex"), //性别
            'studentPhoto' => $insertFlag==true?"upload/NoImage.jpg":input("student_studentPhoto"), //学生照片
            'birthday'=> input("student_birthday"), //生日
            'qq'=> input("student_qq"), //联系qq
            'mobile'=> input("student_mobile"), //手机
            'classObj'=> input("student_classObj_classNo"), //所在班级
            'susheObj'=> input("student_susheObj_susheId"), //所在宿舍
            'addTime'=> input("student_addTime"), //添加时间
        ];
        return $student;
    }

    //接收提交的ClassInfo信息参数
    public function getClassInfoForm($insertFlag) {
        $classInfo = [
            'classNo'=> input("classInfo_classNo"), //班级编号
            'className'=> input("classInfo_className"), //班级名称
            'fudaoyuan'=> input("classInfo_fudaoyuan"), //辅导员
            'addTime'=> input("classInfo_addTime"), //创建时间
        ];
        return $classInfo;
    }

    //接收提交的Sushe信息参数
    public function getSusheForm($insertFlag) {
        $sushe = [
            'susheId'=> input("sushe_susheId"), //宿舍ID
            'susheName'=> input("sushe_susheName"), //宿舍名称
            'totalBedNum'=> input("sushe_totalBedNum"), //床位总数
            'usedBedNum'=> input("sushe_usedBedNum"), //已用床位
            'guanliyuan'=> input("sushe_guanliyuan"), //宿舍管理员
            'beizhu'=> input("sushe_beizhu"), //宿舍备注
            'addTime'=> input("sushe_addTime"), //创建时间
        ];
        return $sushe;
    }

    //接收提交的Fangke信息参数
    public function getFangkeForm($insertFlag) {
        $fangke = [
            'fangkeId'=> input("fangke_fangkeId"), //访客ID
            'fangkeName'=> input("fangke_fangkeName"), //访客姓名
            'studentObj'=> input("fangke_studentObj_studentNo"), //受访学生
            'guanxi'=> input("fangke_guanxi"), //关系
            'inTime'=> input("fangke_inTime"), //进入时间
            'leaveTime'=> input("fangke_leaveTime"), //离开时间
            'addTime'=> input("fangke_addTime"), //创建时间
        ];
        return $fangke;
    }

}

