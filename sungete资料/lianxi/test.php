<?php
$user_id = 1;
$data = array();
					$data[] = array(
						'user_id' => $user_id,
						'type' => 1,
						'alive_flag' => 0,
						'illhealth' => 0,
						'disease_type' => 0,
						'disease_name' => '',
						'birthday' => '19280504',
						'age' => '',
					);
		
					$data[] = array(
						'user_id' => $user_id,
						'type' => 2,
						'alive_flag' => 0,
						'illhealth' => 0,
						'birthday' => '19280504',
						'age' => 86,
					);
		
					$data[] = array(
						'user_id' => $user_id,
						'type' => 3,
						'alive_flag' => 0,
						'illhealth' => 0,
						'birthday' => '19280504',
						'age' => 86,
					);
					$heredityList = json_encode($data);
					$heredityEntityList = json_decode($heredityList,true);
					echo "<pre>";
					print_r($heredityEntityList);
					echo "/<pre>";
        
