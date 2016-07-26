<?php
class GymUserBLL
{
	public static function getUserEntity($user_id)
	{
		$commonPRM = new CommonPRM();
    	$gymUserPRM = new GymUserPRM();
    	$gymUserPRM->id = $user_id;
    	$gymUserList = self::getUserList($commonPRM,$gymUserPRM);
    	$userinfoEntity = array();
		if(count($gymUserList)>0)
		{
			$gymUser = $gymUserList[0];
			$userinfoEntity['mpno']= $gymUser['mpno'];
			//userinfoEntity['name']
			$gymUserDetailPRM = new GymUserDetailPRM();
			$gymUserDetailPRM->user_id = $gymUser['id'];
			$gymUserDetailList = GymUserDetailBLL::getUserDetailList($commonPRM,$gymUserDetailPRM);
			if(count($gymUserDetailList)>0)
			{
				$gymUserDetail = $gymUserDetailList[0];
				$userinfoEntity['user_id'] = $user_id;
				$userinfoEntity['name'] = $gymUserDetail['name'];
				$userinfoEntity['sex'] = $gymUserDetail['sex'];
				$userinfoEntity['birthday'] = $gymUserDetail['birthday'];
				$userinfoEntity['address'] = $gymUserDetail['address'];
				$userinfoEntity['headpic'] = C('FILE_BASE_URL.0') . $gymUserDetail['headpic'];
			}
			//userinfoEntity['cardcode']
			$gymUserCardPRM = new GymUserCardPRM();
			$gymUserCardPRM->user_id = $gymUser['id'];
			$gymUserCardList = GymUserCardBLL::getUserCardList($commonPRM,$gymUserCardPRM);
			if(count($gymUserCardList)>0)
			{
				$userCard = $gymUserCardList[0];
				$userinfoEntity['card_id'] = $userCard['id'];
				$userinfoEntity['cardcode'] = $userCard['cardcode'];
			}
			return $userinfoEntity;
		}
		else
		{
			return false;
		}
		
	}
}