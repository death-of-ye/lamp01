<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Index extends Controller
{
    public function index(){
        $db=DB::name("user");
        $res=$db->select();
        $this->assign("list",$res);
     return    $this->fetch("user/index");
    }
    
    public function add(){
          $name=$_POST["title"];
          $pass=$_POST['desc'];
          $db=DB::name("user");
          $res=$db->insert([
              "name" => $name,
              "pass" => $pass
        ]);
         if($res){
            return 0;
         }else{
			return 1;
		 }
    }
	public function del(){
		$id=$_POST["id"];
		$db=DB::name("user");
		$res=$db->where('id',$id)->delete();
		if($res){
		   return 0;
		}else{
		   return 1;
		}
	}
	public function show(){
		$id=$_POST["id"];
		$db=DB::name("user");
		$res=$db->where('id',$id)->select();
		return $res;
	}
   
    
}
