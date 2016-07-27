<?php
/**
 * Created by PhpStorm.
 * User: sunbin
 * Date: 16/7/16
 * Time: 下午7:11
 */
namespace Home\Controller;
//use Home\Model\UserModel;
use Think\Controller;
use Think\Model;
class UserController extends Controller{
    public function index()
    {
        echo "user index";
    }
    public function test()
    {
        echo "user test";
    }
    public function model()
    {
//        $pdo = new PDO();
//        dump($pdo);
        $user =  new Model('User');
        //$user = new UserModel();
        //$user = M('User');
        var_dump($user->select());
    }
}