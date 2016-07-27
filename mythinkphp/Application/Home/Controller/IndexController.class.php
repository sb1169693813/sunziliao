<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		echo "HomeIndexController";
	}

	//参数绑定
	public function read($id=0)
	{
		echo $id;
	}

	public function model()
	{
		//z字符串查询(不推荐使用)
		//$user = M('User');
		//        $result = $user->where("id = 1")->select();
		//        dump($result);

		//数组查询
		//$conditon['id'] = 1;
		//$conditon['user'] = 'sb';
		//$conditon['_logic'] = 'OR';

		//对象查询
		$conditon = new \stdClass();
		$conditon->user = 'sunbin';
		$result  = $user->where($conditon)->select();

		//表达式查询
		//$map['id'] = array('EQ',2);
		//$map['id'] = array('NEQ',2);
		//$map['id'] = array('egt',2);
		//$map['user'] = array('like','%s%');
		//$map['user'] = array('like',array('%s%','%b%'),'AND');
		//        $map['id'] = array('between',array('1','3'));
		//        $result  = $user->where($map)->select();
		//        dump($result);
		
	//	M方法也可以支持跨库操作，例如：
	// 使用M方法实例化 操作db_name数据库的ot_user表
	//	$User = M('db_name.User','ot_');
	//	// 执行其他的数据操作
	//	$User->select();
	}

	public function model2()
	{
		$user = M('User');

		//区间查询
		//$map['id'] = array(array('egt',1),array('elt',3));
		//$map['id'] = array(array('egt',1),array('elt',3),'AND');
		//$result  = $user->where($map)->select();

		//字符串
		//        $map['id'] = array(array('eq',1));
		//        $map['_string'] = 'user ="sb"';
		//        $map['_logic'] = 'OR';
		//        $result  = $user->where($map)->select();

		//复合查询
		//        $map['id'] = array(array('eq',1));
		//        $where['id'] = 2;
		//        $map['_complex'] = $where;
		//        $map['_logic']= 'OR';
		//        $result  = $user->where($map)->select();


		//统计查询
		//$result = $user->count(0);
		//$result = $user->max('id');


		//动态查询
		// $result = $user->getByUser('sb');
		//  $result = $user->getFieldByUser('sb',id);

		//原生sql查询
		//读
		$result = $user->query('SELECT * FROM think_user');

		//写
		$result = $user->execute('INSERT INTO think_user(user,email) VALUES("jianfei","97979@qq.com")');
		dump($result);
	}

	//连贯操作
	public function model3()
	{
		$user= M('User');
		//$map['id'] = array('gt',1);
		//$result = $user->where($map)->order("date DESC")->limit(2)->select();
		//$result = $user->order(array('id'=>'DESC'))->select();
		// $result = $user->field('id,user')->select();

		//分页
		//$result = $user->page(3,2)->select();

		//切换表
		// $result = $user->table("think_info")->select();
		//简化表名
		//$result = $user->table('__USER__')->select();

		//设置数据表的别名
		// $result = $user->alias('a')->select();

		//注释
		//$result  = $user->comment("chazhao")->select();

		//join
		// $result = $user->join('think_info ON think_user.id = think_info.id','LEFT')->select();

		//union
		//$result = $user->union('SELECT * FORM think_info')->select();

		//缓存
		$result = $user->cache(true)->select();
		dump($result);
	}

	//
	public function model4()
	{


	}

	//空操作是指系统在找不到请求的操作方法的时候，会定位到空操作（_empty）方法来执行，利用这个机制，我们可以实现错误页面和一些URL的优化。
	public function _empty($name)
	{
		//把所有城市的操作解析到city方法
		$this->city($name);
	}

	//注意 city方法 本身是 protected 方法
	protected function city($name)
	{
		//和$name这个城市相关的处理
		echo '当前城市' . $name;
	}

}