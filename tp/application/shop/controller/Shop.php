<?php
namespace app\shop\controller;
use think\Controller;
use think\Db;
class Shop extends Controller
{
    public function  index(){
        $db=Db::table('yk_user')->alias('a')
            ->join('yk_shop b','a.id = b.uid')
            ->field('a.name,b.id,b.shopname,b.pic,b.info,b.price')
            ->select();

        $this->assign('re',$db);
        return $this->fetch('shopp/index');
    }
    public function tianjia(){
        return $this->fetch("shopp/add");
    }
  public function add(){
        $shopname=$_POST["shopname"];
       $info=$_POST["info"];
      $uid=$_POST['uid'];
      $price=$_POST["price"];
      $list=$this->upload();
      $pic=$list[1];
      $db=DB::name("shop");
      $res=$db->insert([
          "shopname" => $shopname,
          "info" =>$info,
          "price" =>$price,
          "pic" =>$pic,
          "uid" =>$uid
      ]);
      if($res){
          return $this->redirect("Shop/index");
      }
  }
    public function upload()
    {
        $file = request()->file("pic");
        $info = $file->move(ROOT_PATH . "public" . DS . "uploads");
        if ($info) {
            $file1 = $info->getSaveName();
            //echo $file1;
            $file2 = explode("\\", $file1);
            // dump($file2);
            $big = $file2[0] . "/" . $file2[1];
            $newfile = $file2[0] . "/smail_" . $file2[1];
            //echo $newfile;
            $image = \think\Image::open("./uploads/" . $big);
            $image->thumb(80, 80)->save("./uploads/" . $newfile);
            $info = array($big, $newfile);
            return $info;
        } else {
            $file->getError();
        }
    }
}
