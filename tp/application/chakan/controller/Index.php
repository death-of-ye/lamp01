<?php
namespace app\chakan\controller;
use think\Controller;
use think\Db;
class Index extends Controller{
     public function index(){
         $db=Db::name("cha");
         $res=$db->select();
         $this->assign("list",$res);
        return $this->fetch("lian/show");
     }
    public function tian(){
        return $this->fetch("lian/add");
    }
    public function  add(){
        $db=Db::name("cha");
        $title=$_POST['title'];
        $content=$_POST['content'];
        $res=$db->insert([
            "title" => $title,
            "content" => $content
        ]);
        if($res){
            return $this->redirect("Index/index");
        }else{
            echo 1;
        }
    }
    public function del(){
        $id=$_GET['id'];
        $db=Db::name("cha");
        $res=$db->where("id",$id)->delete();
        if($res){
            return $this->redirect("Index/index");
        }else{
            echo 1;
        }
    }
}
