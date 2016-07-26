<?php
class V1Action  extends BodytobeBaseAction{
	//获取推荐运动计划
	public function getadviceplan()
	{
		$code = 0;
		$param = array();
		//用户id
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		//器械
		$equipment = isset($_POST['equipmenttype'])?$_POST['equipmenttype']:null;
		//运动时间
		$timetype = isset($_POST['timetype'])?$_POST['timetype']:null;
		//身体部位
		//$bodypart = isset($_POST['bodypart'])?$_POST['bodypart']:null;
		//1推荐计划  2自定义
		$type = isset($_POST['type'])?$_POST['type']:null;
		//解密
		$userId = Crypt::decryptDesForMobile($userId);
		//验证
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户id";
		}
		if (String::isNullOrEmpty($equipment))
		{
			$code = 9001;
			$param[0] = "器械";
		}
		if (String::isNullOrEmpty($timetype))
		{
			$code = 9001;
			$param[0] = "运动时间";
		}
		if (String::isNullOrEmpty($type))
		{
			$code = 9001;
			$param[0] = "类型";
		}

		if ($code == 0)
		{
			//获得体质报告,得出身体最弱的两个部分数值
			if($type == 1)
			{
				$user = MclUserBLL::getUserEntitybyBodyToBe($userId,C('IMG_HOST'));
				$mpno=$user["mpno"];
				$bodyreport = BtbInbodyBLL::getInbodyinfo($mpno);
				$bodyreport = $bodyreport['sectargetlist'];
				//上肢
				$bodyUpLeft = $bodyreport[0];
				$bodyUpRight = $bodyreport[1];
				//求出level的最弱值
				$bodyUpMin = $bodyUpLeft;
				if ($bodyUpRight['level'] < $bodyUpMin['level'])
				{
					$bodyUpMin = $bodyUpRight;
				}
				$bodyUp['bodytype'] = 1;
				$bodyUp['level'] =  $bodyUpMin['level'];
				//最弱部分列表
				$bodyreportList = array();
				$bodyreportList[] = $bodyUp;
				//下肢
				$bodyDownLeft = $bodyreport[2];
				$bodyDownRight = $bodyreport[3];
				//求出level的最弱值
				$bodyDownMin = $bodyDownLeft;
				if ($bodyDownRight['level'] < $bodyDownMin['level'])
				{
					$bodyDownMin = $bodyDownRight;
				}
				$bodyDown['bodytype'] = 2;
				$bodyDown['level'] =  $bodyDownMin['level'];
				$bodyreportList[] = $bodyDown;
				//躯干
				$bodyMainMin = $bodyreport[4];
				$bodyMain['bodytype'] = 3;
				$bodyMain['level'] = $bodyMainMin['level'];
				$bodyreportList[] = $bodyMain;

				//按照上肢，下肢，躯干的levle最小值排序
				$levelList = array();
				foreach($bodyreportList as $brlist)
				{
					$levelList[] = $brlist['level'];
				}
				//asort($bodyreportList);
				//按level升序排序
				array_multisort($levelList,SORT_ASC,$bodyreportList);
				$bodyreportList = array_slice($bodyreportList,0,2);
				//身体部位数组
				$bodytype = array();
				foreach($bodyreportList as $brlist)
				{
					$bodytype[] = $brlist['bodytype'];
				}
				//把身体部分转换为字符串
				//$bodytypeString= implode(',',$bodytype);
			}
			$CommonPRM = new CommonPRM();
			$BtbTrainingplanPRM = new BtbTrainingplanPRM();
			//设置BtbTrainingplanList缓存
			$BtbTrainingplanListCacheName = 'BtbTrainingplanListCacheName_'.$equipment.'_'.$timetype;
			if (S($BtbTrainingplanListCacheName) === false)
			{
				$BtbTrainingplanPRM->equipment = $equipment;
				$BtbTrainingplanPRM->timetype = $timetype;
				$BtbTrainingplanList = BtbTrainingplanBLL::getTrainingplanList($CommonPRM,$BtbTrainingplanPRM);
				S($BtbTrainingplanListCacheName,$BtbTrainingplanList,array('expire'=>3600));
			}
			else
			{
				$BtbTrainingplanList = S($BtbTrainingplanListCacheName);
			}
			$list = array();
			$flag = null;
			foreach ($BtbTrainingplanList as $tplist)
			{
				$flag = true;
				//判断最弱身体部分是否在trainingplan表里,有才查
				if ($type == 1)
				{
					$tplistarr= explode(',', $tplist);
					foreach($bodytype as $btlist)
					{
						if (in_array($btlist, $tplistarr))
						{
							$flag = true;
						}
						else
						{
							$flag = false;
							break;
						}
					}
				}
				if($flag == true)
				{
					//planEntity运动计划实体类
					$trainingplan_id= $tplist['id'];
					//设置$BtbTrainingplanCacheName缓存
					$BtbTrainingplanCacheName = 'BtbTrainingplanCacheName_'.$trainingplan_id;
					if (S($BtbTrainingplanCacheName) === false)
					{
						$planEntity['id'] = $tplist['id'];
						$planEntity['name'] = $tplist['name'];
						$planEntity['pic'] = C('IMG_HOST') . $tplist['pic'];
						$planEntity['key'] = null;
						$planEntity['day'] = $tplist['daycount'];
						$planEntity['equipment'] = $tplist['equipment'];
						$planEntity['time'] = $tplist['time'];
						$planEntity['kcal'] = $tplist['kcal'];
						//coachEntity教练实体类
						$coach_id = $tplist['coach_id'];
						$BtbCoachPRM = new BtbCoachPRM();
						$BtbCoachPRM->id = $coach_id;
						$BtbCoachList = BtbCoachBLL::getCoachList($CommonPRM,$BtbCoachPRM);
						if (count($BtbCoach)>0)
						{
							$BtbCoach = $BtbCoachList[0];
							$coachEntity['name'] = $BtbCoach['name'];
							$coachEntity['headpic'] = C('IMG_HOST') . $BtbCoach['head'];
							$coachEntity['url'] = "http://www.baidu.com/";
						}
						$planEntity['coach'] = $coachEntity;
						//daysportitemEntity每天运动项实体类
						//查btb_trainingplan_detail表
						$BtbTrainingplanDetailPRM = new BtbTrainingplanDetailPRM();
						$BtbTrainingplanDetailPRM->trainingplan_id = $trainingplan_id;
						$BtbTrainingplanDetailList= BtbTrainingplanDetailBLL::getTrainingplanDetailList($CommonPRM,$BtbTrainingplanDetailPRM);
						$daysportitemEntityList = array();
						foreach($BtbTrainingplanDetailList as $tpdlist)
						{
							$trainingplan_detail_id = $tpdlist['id'];
							$daysportitemEntity['name'] = $tpdlist['name'];
							//sportitemEntity运动项实体类
							//查BtbTrainingplanDetailSportitem表
							$BtbTrainingplanDetailSportitemPRM = new BtbTrainingplanDetailSportitemPRM();
							$BtbTrainingplanDetailSportitemPRM->trainingplan_detail_id = $trainingplan_detail_id;
							//联表Sportitem查询
							$BtbTrainingplanDetailSportitemList = BtbTrainingplanDetailSportitemBLL::getTrainingplanDetailSportitemWithSportitemList();
							$sportitemEntityList = array();
							foreach($BtbTrainingplanDetailSportitemList as $tpdslist)
							{
								$sportitemEntity['item_id']= $tpdslist['id'];
								$sportitemEntity['name']= $tpdslist['name'];
								$sportitemEntity['intro']= $tpdslist['intro'];
								$sportitemEntity['pic']= C('IMG_HOST') . $tpdslist['pic'];
								$sportitemEntity['video']= $tpdslist['video'];
								$sportitemEntity['content']= $tpdslist['content'];
								$sportitemEntity['resttime']= $tpdslist['resttime'];
								$sportitemEntityList[] = $sportitemEntity;
							}
							$daysportitemEntity['sportitem'] = $sportitemEntityList;
							$daysportitemEntityList[] = $daysportitemEntity;
						}
						$planEntity['list'] = $daysportitemEntityList;
						S($BtbTrainingplanCacheName,$planEntity,array('expire'=>3600));
					}
					else
					{
						$planEntity = S($BtbTrainingplanCacheName);
					}
					$list[] = $planEntity;
				}
			}
			$jsonData['list'] = $list;
		}
		//生成返回数据
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code, $param);
		exit(self::toJSON($jsonData));
	}

	/**
	 * 2.24获取今日任务
	 */
	public function gettodayplan()
	{
		$code = 0;
		$param = array();
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		//解密
		$userId = Crypt::decryptDesForMobile($userId);
		//验证
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户id";
		}
		if ($code == 0)
		{
			$CommonPRM = new CommonPRM();
			$BtbUserSportplanPRM = new BtbUserSportplanPRM();
			$BtbUserSportplanPRM->user_id = $userId;
			$BtbUserSportplanList = BtbUserSportplanBLL::getUserSportplanList($CommonPRM,$BtbUserSportplanPRM);
			if(count($BtbUserSportplanList) > 0)
			{
				$BtbUserSportplan= $BtbUserSportplanList[0];
				$trainingplan_id = $BtbUserSportplan['id'];
				//训练到第几天
				$curday = $BtbUserSportplan['curday'];
				//是否完成
				$isfinish = $BtbUserSportplan['isfinish'];
				//如果以完成，置0 ，天数+1
				if ($isfinish == 1)
				{
					$BtbTrainingplanPRM = new BtbTrainingplanPRM();
					$BtbTrainingplanPRM->id = $trainingplan_id;
					$BtbTrainingplanList = BtbTrainingplanBLL::getTrainingplanList($CommonPRM,$BtbTrainingplanPRM);
					if (count($BtbTrainingplanList) > 0)
					{
						$BtbTrainingplan = $BtbTrainingplanList[0];
						$daycount = $BtbTrainingplan['daycount'];

					}
					//当前第几天
					if ($curday < $daycount)
					{
						$BtbUserSportplanFinishLogPRM = new BtbUserSportplanFinishLogPRM();
						$BtbUserSportplanFinishLogPRM->user_id = $userId;
						$BtbUserSportplanFinishLogPRM->type = 1;
						$BtbUserSportplanFinishLogPRM->obj_createdate_gt = date('Y-m-d',time());
						$BtbUserSportplanFinishLogPRM->obj_createdate_lt = date('Y-m-d',time()+3600*24);
						$BtbUserSportplanFinishLogList = BtbUserSportplanFinishLogBLL::getBtbUserSportplanFinishLogList($CommonPRM,$BtbUserSportplanFinishLogPRM);
						if (count($BtbUserSportplanFinishLogList) == 0)
						{
							$data['isfinish'] = 0;
							$data['curday']  = $BtbTrainingplan['curday']+1;
							BtbUserSportplanBLL::btbUserSportplanUpdate($data);
						}
					}
				}
				//trainingtime
				$BtbUserSportplanFinishLogPRM = new BtbUserSportplanFinishLogPRM();
				$BtbUserSportplanFinishLogPRM->user_id = $userId;
				$BtbUserSportplanFinishLogPRM->obj_createdate_gt = date('Y-m-d',time());
				$BtbUserSportplanFinishLogPRM->obj_createdate_lt = date('Y-m-d',time()+3600*24);
				//联 trainingplan表查今日训练计划time
				$TrainingplanTime = BtbUserSportplanFinishLogBLL::getTrainingplanSumtime($CommonPRM,$BtbUserSportplanFinishLogPRM);
				//联 oncetrainingplan表今日单次训练时间
				$OncetrainingplanTime = BtbUserSportplanFinishLogBLL::getOncetrainingplanSumtime($CommonPRM,$BtbUserSportplanFinishLogPRM);
				$trainingtime = $TrainingplanTime + $OncetrainingplanTime;
				//monthfinishcount
				$BtbUserSportplanFinishLogPRM->obj_createdate_gt = date('Y-m-01',strtotime(time()));
				$BtbUserSportplanFinishLogPRM->getCount = true;
				$monthfinishcount= BtbUserSportplanFinishLogBLL::getUserSportplanFinishLogList($CommonPRM,$BtbUserSportplanFinishLogPRM);

				//planEntity运动计划实体类
				//查trainingplan表
				if(count($BtbTrainingplanList) >0 )
				{
					$BtbTrainingplan = $BtbTrainingplanList[0];
					$planEntity['id'] = $BtbTrainingplan['id'];
					$planEntity['name'] = $BtbTrainingplan['name'];
					$planEntity['pic'] = C('IMG_HOST').$BtbTrainingplan['pic'];
					$planEntity['key'] = $BtbTrainingplan['key'];
					$planEntity['day'] = $BtbTrainingplan['daycount'];
					$planEntity['equipment'] = $BtbTrainingplan['equipment'];
					$planEntity['time'] = $BtbTrainingplan['time'];
					$planEntity['kcal'] = $BtbTrainingplan['kcal'];
					//coachEntity实例
					$BtbCoachPRM = new BtbCoachPRM();
					$BtbCoachList = BtbCoachBLL::getCoachList($CommonPRM,$BtbCoachPRM);
					if (count($BtbCoachList) > 0)
					{
						$BtbCoach = $BtbCoachList[0];
						$coachEntity['name'] = $BtbCoach['name'];
						$coachEntity['headpic'] = $BtbCoach['head'];
						$coachEntity['url'] = 'http://www.baidu.com/';
					}
					$planEntity['coach'] = $coachEntity;
					//daysportitemEntity每天运动项实体类
					//查btb_trainingplan_detail表
					$BtbTrainingplanDetailPRM = new BtbTrainingplanDetailPRM();
					$BtbTrainingplanDetailPRM->trainingplan_id = $trainingplan_id;
					$BtbTrainingplanDetailList= BtbTrainingplanDetailBLL::getTrainingplanDetailList($CommonPRM,$BtbTrainingplanDetailPRM);
					$daysportitemEntityList = array();
					foreach($BtbTrainingplanDetailList as $tpdlist)
					{
						$trainingplan_detail_id = $tpdlist['id'];
						$daysportitemEntity['name'] = $tpdlist['name'];
						//sportitemEntity运动项实体类
						//查BtbTrainingplanDetailSportitem表
						$BtbTrainingplanDetailSportitemPRM = new BtbTrainingplanDetailSportitemPRM();
						$BtbTrainingplanDetailSportitemPRM->trainingplan_detail_id = $trainingplan_detail_id;
						//联表Sportitem查询
						$BtbTrainingplanDetailSportitemList = BtbTrainingplanDetailSportitemBLL::getTrainingplanDetailSportitemWithSportitemList();
						$sportitemEntityList = array();
						foreach($BtbTrainingplanDetailSportitemList as $tpdslist)
						{
							$sportitemEntity['item_id']= $tpdslist['id'];
							$sportitemEntity['name']= $tpdslist['name'];
							$sportitemEntity['intro']= $tpdslist['intro'];
							$sportitemEntity['pic']= C('IMG_HOST') . $tpdslist['pic'];
							$sportitemEntity['video']= $tpdslist['video'];
							$sportitemEntity['content']= $tpdslist['content'];
							$sportitemEntity['resttime']= $tpdslist['resttime'];
							$sportitemEntityList[] = $sportitemEntity;
						}
						$daysportitemEntity['sportitem'] = $sportitemEntityList;
						$daysportitemEntityList[] = $daysportitemEntity;
					}
					$planEntity['list'] = $daysportitemEntityList;
					$plan = $planEntity;
				}
			}
			$jsonData['plan'] = $plan;
		}
		//生成返回数据
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code, $param);
		exit(self::toJSON($jsonData));
	}


	//2.22 finishtraining
	public function finishtraining()
	{
		$code = 0;
		$param = array();
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		//1 运动计划 2单次训练
		$type = isset($_POST['type'])?$_POST['type']:null;
		//运动计划ID 或单次训练ID
		$id = isset($_POST['id'])?$_POST['id']:null;
		//解密
		$userId = Crypt::decryptDesForMobile($userId);
		//验证
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户id";
		}
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "类型";
		}
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "id";
		}

		if ($code == 0)
		{
			$data = array();
			$data['user_id'] = $userId;
			$data['type'] = $type;
			$data['trainingplan_detail_id'] = $id;
			BtbUserSportplanFinishLog::btbUserSportplanFinishLogInsert($data);
			if($type == 1)
			{
				$CommonPRM = new CommonPRM();
				$BtbUserSportplanPRM = new BtbUserSportplanPRM();
				$BtbUserSportplanPRM->user_id = $userId;
				$BtbUserSportplanList = BtbUserSportplanBLL::getUserSportplanList($CommonPRM,$BtbUserSportplanPRM);
				if (count($BtbUserSportplanList) > 0)
				{
					$newdata = array();
					$BtbUserSportplan = $BtbUserSportplanList[0];
					$newdata['id'] = $BtbUserSportplan['id'];
					$newdata['isfinish'] = 0;
					BtbUserSportplanBLL::btbUserSportplanUpdate($data);
				}
			}
		}
		else
		{
			Log::write(self::formatMessage($code,$param)."\n".var_export($_POST,true));
		}
		//生成返回数据
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code, $param);
		exit(self::toJSON($jsonData));
	}

	//2.30 获取动态列表
	public function getselectedweekpiclist()
	{
		$code = 0;
		$param = array();
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		//解密
		$userId = Crypt::decryptDesForMobile($userId);
		//验证
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户id";
		}
		if ($code == 0)
		{
			//精选列表
			$CommonPRM = new CommonPRM();
			$selectedlistCacheName = 'selectedlistCacheName';
			if (S($selectedlistCacheName) === false)
			{
				$BtbWonderfulweekpicPRM = new BtbWonderfulweekpicPRM();
				//联表
				$selectweekpiclist = BtbWonderfulweekpic::getWonderfulweekpicwithlogList($CommonPRM,$BtbWonderfulweekpicPRM);
				$dynamicpicEntityList = array();
				foreach($selectweekpiclist as $slist)
				{
					//dynamicpicEntity动态实体类
					$dynamicpicEntity['id'] = $slist['id'];
					$log_id= $slist['log_id'];
					$BtbUserweekpicDetailPRM = new BtbUserweekpicDetailPRM();
					$BtbUserweekpicDetailPRM->log_id = $log_id;
					$UserweekpicDetailList = BtbUserweekpicDetailBLL::getUserweekpicDetailList($CommonPRM,$BtbUserweekpicDetailPRM);
					$piclist = array();
					foreach($UserweekpicDetailList as $udlist)
					{
						$piclist[] = C('IMG_HOST') . $udlist['pic'];
						if ($udlist['id'] == $slist['detail_id'])
						{
							$coverpic = C('IMG_HOST') . $udlist['pic'];
						}
					}
					$dynamicpicEntity['piclist'] = $piclist;
					$dynamicpicEntity['content']= $slist['content'];
					$dynamicpicEntity['coverpic'] = $coverpic;
					$dynamicpicEntityList[] = $dynamicpicEntity;
				}
				S($selectedlistCacheName,$dynamicpicEntityList,array('expire'=>3600));
			}
			else
			{
				$dynamicpicEntityList = S($selectedlistCacheName);
			}
			$jsonData['selectedlist'] = $dynamicpicEntityList;
			//最近列表
			$newlistCacheName = "newlistCacheName";
			if (S($newlistCacheName) === false)
			{
				$limit = 10;
				$BtbUserweekpicLogPRM = new BtbUserweekpicLogPRM();
				$BtbUserweekpicLogPRM->user_id = $userId;
				$BtbUserweekpicLogPRM->limit = $limit;
				$BtbUserweekpicLogPRM->order_by = 'obj_createdate desc';
				$BtbUserweekpicLogList = BtbUserweekpicLogBLL::getUserweekpicLogList($CommonPRM,$BtbUserweekpicLogPRM);
				foreach($BtbUserweekpicLogList as $ulllist)
				{
					//dynamicpicEntity动态实体类
					$dynamicpicEntity['id'] = $ulllist['id'];
					$log_id = $ulllist['id'];
					$BtbUserweekpicDetailPRM = new BtbUserweekpicDetailPRM();
					$BtbUserweekpicDetailPRM->log_id = $log_id;
					$UserweekpicDetailList = BtbUserweekpicDetailBLL::getUserweekpicDetailList($CommonPRM,$BtbUserweekpicDetailPRM);
					$piclist = array();
					foreach ($UserweekpicDetailList as $udlist)
					{
						$piclist[] = C('IMG_HOST') . $udlist['pic'];
						if ($udlist['id'] == $ulllist['detail_id'] )
						{
							$coverpic = C('IMG_HOST') . $udlist['pic'];
						}
					}
					$dynamicpicEntity['piclist'] = $piclist;
					$dynamicpicEntity['content'] = $ulllist['content'];
					$dynamicpicEntity['coverpic'] = $coverpic;
					$dynamicpicEntityList[] = $dynamicpicEntity;
				}
				S($newlistCacheName,$dynamicpicEntityList,array('expire'=>300));
			}
			else
			{
				$dynamicpicEntityList = S($newlistCacheName);
			}
			$jsonData['newlist'] = $dynamicpicEntityList;
		}
		//生成返回数据
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code, $param);
		exit(self::toJSON($jsonData));
	}

	//获取用户实体
	public static function getUserEntity($user_id,$headpicPrefix=null)
	{
		//查user表
		$commonPRM = new CommonPRM();
		$userPRM = new UserPRM();
		$userPRM->id = $user_id;

		//查user_base表
		$userBasePRM = new UserBasePRM();
		$userBasePRM->user_id = $user_id;

		$userEntity = array();
		$userList = MclUserBLL::getUserList($commonPRM,$userPRM);
		//自己类中用self   用户主表信息
		//$userList = self::getUserList($commonPRM,$userPRM);
		if (count($userList) > 0)
		{
			$user = $userList[0];
			//用户实体类
			$userEntity['id'] = $user['id'];
			$userEntity['username'] = $user['username'];
			$userEntity['nickname'] = $user['nickname'];
			$userEntity['mpno'] = $user['mpno'];
		}
		else
		{
			return false;
		}
		//用户基础信息表数据
		$userBaseList = MclUserBaseBLL::getUserBaseList($commonPRM,$userBasePRM);
		if(count($userBaseList)>0)
		{
			$userBase = $userBaseList[0];
			$userEntity['sex'] = $userBase['sex'];
			$userEntity['birthday'] = $userBase['birthday'];
			$userEntity['height'] = $userBase['height'];
			//$userEntity['weight'] = $userBase['weight'];
			$userEntity['weight'] = floatval($userBase['weight']);
			$userEntity['location'] = $userBase['location'];
			//!='0000-00-00'有这个日期，并且有这个变量
			//$userEntity['birthday'] = ($userBase['birthday'] != '0000-00-00' && isset($userBase['birthday'])) ? date('Ymd',strtotime($userBase['birthday'])) : '';

			//
			//头像链接地址
			if(is_null($headpicPrefix))
			{
				$prefix = "";
			}
			else
			{
				$prefix = $headpicPrefix;
			}
			//$userEntity['headpic'] = $prefix.$userBase["headpic"];
			$userEntity['headpic'] = String::isNullOrEmpty($userBase['headpic']) ? '' : $prefix . $userBase['headpic'];

		}
		return $userEntity;
	}

	/**
	 *	2.25 获取用户热量消耗情况
	 */
	public function getuserkcalinfo()
	{
		$code = 0;
		$param = array();
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		$userId = Crypt::decryptDesForMobile($userId);
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户id";
		}
		if ($code ==0)
		{
			$kcalinfo=array();
			$user = MclUserBLL::getUserEntitybyBodyToBe($userId,C('IMG_HOST'));
			$mpno = $user["mpno"];
			$bodyreport = BtbInbodyBLL::getInbodyinfo($mpno);
			//基础代谢
			$kcalinfo["basalmetabolicrate"]=$bodyreport["bodyfat"]["basalmetabolicrate"];

			$today = date('Y-m-d');
			$commonPRM = new CommonPRM();
			$BtbUserCalcontrolPRM = new BtbUserCalcontrolPRM();
			$BtbUserCalcontrolPRM->user_id = $userId;
			$BtbUserCalcontrolPRM->date = $today;
			$BtbUserCalcontrolList =  BtbUserCalcontrolBLL::getUserCalcontrolList($commonPRM,$BtbUserCalcontrolPRM);
			foreach($BtbUserCalcontrolList as $CalcontrolList)
			{
				switch($CalcontrolList['type'])
				{
					//运动消耗热量
					case 1:
						$kcalinfo['sport'] = $CalcontrolList['value'];
						break;
						//饮食摄入热量
					case 2:
						$kcalinfo['food'] = $CalcontrolList['value'];
						break;
				}
			}
			//运动计划完成消耗热量
			$kcalinfo['plansport'] = null;
			//建议摄入蛋白质
			$kcalinfo['protein'] = null;

			$jsonData['kcalinfo'] = $kcalinfo;
		}
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code,$param);
		exit(self::toJSON($jsonData));
	}

	//获取版本
	public function getversion()
	{
		$code = 0;
		$param = array();
		$entity = array();
		if ($code ==0)
		{
			//返回类 SimpleXMLElement 的一个对象,该对象的属性包含 XML 文档中的数据.如果失败,则返回false.
			$xml = simplexml_load_file('Bodytobe.xml');
			if(is_null($xml))
			{
				$code = 3056;
				$message = "获取版本信息失败";
				Log::write($message);
			}
			else
			{
				$item = $xml->consult[0];
				$entity['last_version'] = $item['last_version'];
				$entity['min_version'] = $item['min_version'];
				$entity['update_url'] = $item['update_url'];
			}
		}
		//生成返回数据
		$jsonData['code'] = $code;
		$jsonData['meaasge'] = self::formatMessage($code,$param);
		$jsonData['version'] = $entity;
		exit(self::toJSON($jsonData));
	}

	//退出登录
	public static function logout($user_id,$device_type,$device_code,$version)
	{
		//公共查询参数
		$commonPRM　= new CommonPRM();
		//用户设备表PRM
		$userDevicePRM = new UserDevicePRM();
		$userDevicePRM->user_id = $user_id;
		//获取用户设备数据
		$userDeviceList = MclUserBLL::getuserDeviceList($commonPRM,$userDevicePRM);
		if (count($userDeviceList) > 0)
		{
			//更新device的online-status为0
			$deviceData = array();
			$userDevice = $userDeviceList[0];
			$deviceData['id'] = $userDevice['id'];
			$deviceData['online-status'] = 0;
			//UserDeviceBLL::mclUserDeviceUpdate($deviceData);
			//更改在线状态
			self::mclUserDeviceUpdate($deviceData);
			//设备日志
			$userDeviceLogData = array();
			$userDeviceLogData['user_id'] = $user_id;
			$userDeviceLogData['device_type'] = $device_type;
			$userDeviceLogData['device_code'] = $device_code;
			$userDeviceLogData['version'] = $version;
			//$lastId= MclUserBLL::mclUserDevicelogInsert($userDeviceLogData);
			//写日志
			self::mclUserDevicelogInsert($userDeviceLogData);
			return true;
		}
		return false;
	}


	//2.20 修改我的运动计划
	public function myplanmodifyitem()
	{
		$code = 0;
		$param = array();
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		$newid = isset($_POST['newid'])?$_POST['newid']:null;
		$userId = Crypt::decryptDesForMobile($userId);
		if(String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = '用户id';
		}
		if(String::isNullOrEmpty($newid))
		{
			$code = 9001;
			$param[0] = '新运动计划id';
		}
		if ($code == 0)
		{
			//公共查询参数
			$commonPRM = new CommonPRM();
			//用户运动计划PRM
			$BtbUserSportplanPRM = new BtbUserSportplanPRM();
			$BtbUserSportplanPRM->user_id = $userId;
			$today = date('Y-m-d');
			$UserSportplanList = BtbUserSportplanBLL::getUserSportplanList($commonPRM,$BtbUserSportplanPRM);
			if (count($UserSportplanList) > 0)
			{
				$data['id'] = $UserSportplanList[0]['id'];
				$data['enddate'] = $today;
				$data['obj_status'] = 0;
				BtbUserSportplanBLL::btbUserSportplanUpdate($data);
			}
			else
			{
				$newdata['user_id'] = $userId;
				$newdata['trainingplan_id'] = $newid;
				$newdata['curday'] = 1;
				$newdata['isfinish'] = 0;
				BtbUserSportplanBLL::btbUserSportplanInsert($newdata);
			}
		}
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code,$param);
		exit(self::toJSON($jsonData));
	}

	//忘记密码
	public function resetpassword()
	{
		$code = 0;
		$param = array();
		//用户ID
		$user_id = isset($_POST['user_id']) ? trim($_POST['user_id']) : null;
		//新密码
		$password= isset($_POST['password']) ? trim($_POST['password']) : null;
		//旧密码
		$oldPassword= isset($_POST['oldpassword']) ? trim($_POST['oldpassword']) : null;
		//版本号
		$version= isset($_POST['version']) ? trim($_POST['version']) : null;
		$user_id = Crypt::decryptDesForMobile($user_id);
		$password = Crypt::decryptDesForMobile($password);
		$oldPassword = Crypt::decryptDesForMobile($oldPassword);

		//验证
		if(String::isNullOrEmpty($user_id) || intval($user_id) == 0)
		{
			$code = 9001;
			$param[0] = '用户ID格式不正确';
		}
		else if(String::isNullOrEmpty($password))
		{
			$code = 3004;
		}

		if ($code == 0)
		{
			$commonPRM = new CommonPRM();
			$userPRM = new MclUserPRM();
			$userPRM->id = $user_id;
			$userList = MclUserBLL::getUserList($commonPRM,$userPRM);
			if (count($userList)>0)
			{
				$user = $userList[0];
				//判断原始密码是否相同
				if (md5($oldpassword) == $user['password'])
				{
					//更新现有的密码
					$userData = array();
					$userData['id'] = $user['id'];
					$userData['password'] = md5($password);
					$affectRows = MclUserBLL::mclUserUpdate($userData);

					//添加用户日志
					$userLogData = array();
					$userLogData['user_id'] = $user_id;
					$userLogData['version'] = $version;
					$userLogData['actiontype'] = 1;
					MclUserBLL::mclUserLogInsert($userLogData);
					//密码修改失败
					if($affectRows <= 0)
					{
						$code = 3012;
					}
				}
				else
				{
					//原始密码不对
					$code = 3022;
				}
			}
			else
			{
				//用户不存在
				$code = 3023;
			}
		}
		else
		{
			Log::write(self::formatMessage($code,$param).'\n'.var_export($_POST,true));
		}
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code,$param);
		exit(self::toJSON($jsonData));
	}

	//用户热量情况修改
	public function usercalinfomodify()
	{
		$code = 0;
		$param = array();
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		//1 运动消耗 2饮食
		$type = isset($_POST['type'])?$_POST['type']:null;
		//消耗的卡路里数值
		$value = isset($_POST['value'])?$_POST['value']:null;
		//解密
		$userId = Crypt::decryptDesForMobile($userId);
		//验证
		if(String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户id";
		}
		if($code == 0)
		{
			$today = date('Y-m-d');
			$commonPRM = new CommonPRM();
			$BtbUserCalcontrolPRM = new BtbUserCalcontrolPRM();
			$BtbUserCalcontrolPRM->user_id = $userId;
			$BtbUserCalcontrolPRM->date = $today;
			$BtbUserCalcontrolPRM->type = $type;
			$BtbUserCalcontrolList = BtbUserCalcontrolBLL::getUserCalcontrolList($commonPRM,$BtbUserCalcontrolPRM);
			if (count($BtbUserCalcontrolList) > 0)
			{
				$data['id']= $BtbUserCalcontrolList[0]['id'];
				$data['value']= $value;
				BtbUserCalcontrolBLL::btbUserCalcontrolUpdate($data);
			}
			else
			{
				$data['user_id']= $userId;
				$data['value']= $value;
				$data['type']= $type;
				$data['date']= $today;
				BtbUserCalcontrolBLL::btbUserCalcontrolInsert($data);
			}
		}
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code,$param);
		exit(self::toJSON($jsonData));
	}

	//修改用户城市信息
	public function setusercity()
	{
		$code = 0;
		$param = array();
		//用户ID
		$userId = isset($_POST['user_id'])?$_POST['user_id']:null;
		//城市
		$location = isset($_POST['location'])?$_POST['location']:null;
		//解密
		$userId = Crypt::decryptDesForMobile($userId);
		//验证
		if(String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户id";
		}
		if(String::isNullOrEmpty($location))
		{
			$code = 9001;
			$param[0] = "城市编号";
		}
		if($code == 0)
		{
			//公共PRM
			$commonPRM = new CommonPRM();
			//用户基础信息表
			$userBasePRM = new UserBasePRM();
			$userBasePRM->user = $userId;
			//查用户基础信息表
			$userBaseList = MclUserBaseBLL::getUserBaseList($commonPRM,$userBasePRM);
			if (count($userBaseList) > 0)
			{
				//更改城市信息
				$userBase = $userBaseList[0];
				$userBaseData = array();
				$userBaseData['id'] = $userBase['id'];
				$userBaseData['location'] = $userBase['location'];
				MclUserBLL::mclUserBaseUpdate($userBaseData);
			}
			else
			{
				$code = 9090;
			}
		}
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code,$param);
		exit(self::toJSON($jsonData));
	}

	/**
	 * 2.14 用户反馈 (收集用户反馈信息)
	 */
	public function feedback()
	{
		$code = 0;
		$param = array();

		//用户id
		$userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
		// 内容
		$content = isset($_POST['content']) ? $_POST['content'] : null;

		//解密
		$userId = Crypt::decryptDesForMobile($userId);

		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户ID";
		}
		if (String::isNullOrEmpty($content))
		{
			$code = 9001;
			$param[0] = "内容";
		}

		if($code == 0)
		{
			$feedbackData = array();
			$feedbackData['id'] = $userId;
			$feedbackData['content'] = $content;
			MclUserBLL::mclUserFeedbackInsert($feedbackData);

		}
		//如果code不等于0 写日志
		if ($code != 0)
		{
			Log::write(self::formatMessage($code,$param)."\n".var_export($_POST,true));
		}
		//生成返回的数据
		$jsonData["code"] = $code;
		$jsonData['message'] = self::formatMessage($code,$param);
		exit(self::toJSON($jsonData));
	}

	/*
	 *2.16获取最新的体质报告
	 */
	public function getlastuserbodyreport()
	{
		$code = 0;
		$param = array();

		//用户id
		$userId = isset($_POST['user_id']) ? $_POST['user_id'] : null;
		//解密
		$userId = Crypt::decryptDesForMobile($userId);
		//验证
		if (String::isNullOrEmpty($userId))
		{
			$code = 9001;
			$param[0] = "用户ID";
		}

		if ($code == 0)
		{
			//查用户实体类，取出手机号码
			$user = MclUserBLL::getUserEntitybyBodyToBe($userId,C("IMG_POST"));
			//忽略的    实体类user不为空
			if ($user!=false)
			{
				$mpno = $user['mpno'];
				//根据手机号，查bodyreport
				$bodyreport = BtbInbodyBLL::getInbodyinfo($mpno);
				//肌肉控制
				$musclecontrol = $bodyreport['musclecontrol'];
				//体重
				$weight = $bodyreport['bodycomposition']['weight'];
				//节食处方($musclecontrol,$weight)
				$dietprescription = BtbInbodyBLL::getdietprescription($musclecontrol,$weight);
				$jsonData['bodyreport'] = $bodyreport;
				$jsonData['dietprescription'] = $dietprescription;
			}
		}
		$jsonData['code'] = $code;
		$jsonData['message'] = self::formatMessage($code,$param);
		exit(self::toJSON($jsonData));
	}
}