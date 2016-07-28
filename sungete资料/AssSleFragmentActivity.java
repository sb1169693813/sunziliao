package com.cinkate.rmd.activity;

import java.util.ArrayList;

import net.iaf.framework.controller.BaseController.CommonUpdateViewAsyncCallback;
import net.iaf.framework.exception.IException;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;
import android.support.v4.view.ViewPager.OnPageChangeListener;
import android.view.KeyEvent;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.cinkate.rmd.R;
import com.cinkate.rmd.controller.GetCheckNormResourceController;
import com.cinkate.rmd.fragment.AssSleResultFragment;
import com.cinkate.rmd.fragment.AssSleSelectSingleListFragment;
import com.cinkate.rmd.fragment.AssSleSelectSpecialGridFragment;
import com.cinkate.rmd.fragment.AssSleSelectSpecialListFragment;
import com.cinkate.rmd.fragment.AssSleWriteNumberComplementFragment;
import com.cinkate.rmd.fragment.AssSleWriteNumberFragment;
import com.cinkate.rmd.fragment.BaseFragment;
import com.cinkate.rmd.globals.ActivityParams;
import com.cinkate.rmd.globals.ValidIntervals;
import com.cinkate.rmd.models.AnswerEntity;
import com.cinkate.rmd.models.ChecknormDetailEntity;
import com.cinkate.rmd.models.QuestionEntity;
import com.cinkate.rmd.models.RequestAnswerEntity;
import com.cinkate.rmd.models.UserCheckReportDetailEntity;
import com.cinkate.rmd.models.UserCheckReportEntity;
import com.cinkate.rmd.models.UserCheckReportPicEntity;
import com.cinkate.rmd.models.UserEvaluateReportEntity;
import com.cinkate.rmd.requestmodels.GetCheckNormResourceRequestEntity;
import com.cinkate.rmd.resource.EvaSleUtil;
import com.cinkate.rmd.resource.UserCheckReportHelper;
import com.cinkate.rmd.resource.UserEvaluateReportHelper;
import com.cinkate.rmd.util.Utils;
import com.cinkate.rmd.widget.CustomPagerView;

/**
 * 系统性红斑狼疮评估
 * @author jgpeng
 *
 */
public class AssSleFragmentActivity extends BaseFragmentActivity implements OnClickListener{

	public final static int SUBMIT_DATA_OK = 1; //数据提交成功
	public final static int SUBMIT_DATA_ERROR = 2; //数据提交失败

	/**以下用于系统性红斑狼疮评估自动生成检验报告使用*/
	public final static int CHECKNORM_ID_PRO = 36;    //24h尿蛋白
	public final static int CHECKNORM_ID_C3 = 33;    //补体C3
	public final static int CHECKNORM_ID_C4 = 34;   //补体C4
	public final static int CHECKNORM_ID_PLT = 4;     //血小板
	public final static int CHECKNORM_ID_WBC = 1;     //白细胞

	
	private TextView mTextTitle; // 标题
	private Button mBtnLast; //上一步 / 向顾问咨询
	private Button mBtnNext; //下一步 / 提交 / 查看报告
	
	private CustomPagerView mCustomPagerView; // 分页PagerView 
	private MyPageAdapter mPageAdapter; // 分页适配器
	
	private int mStep = 0; //当前步骤 0-25
	private ArrayList<BaseFragment> mArrayFragmentPages = new ArrayList<BaseFragment>(); // 分布view容器
	private ArrayList<QuestionEntity> mArrayEvaSledaiQuestion; // SLEDAI题目列表
	/**SLEDAI评估结果*/
	private UserEvaluateReportEntity mUserEvaluateReportInfo;
	/**检查指标实体类列表*/
	private ArrayList<ChecknormDetailEntity> mCheckNormDetailListInfo = null;
	// 从用户检验报告列表中获取的特定指标值列表，（评估中特定填空初始化值使用）
	private ArrayList<UserCheckReportDetailEntity> mArrayCheckUserDetailReportInfo = null; 
	
	// private MyThread myThread = new MyThread();
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_assess_operation);
		// 初始化view
		initView();
		// 获取SLEDAI题目
		getEvaSledaiQuestion(savedInstanceState);
		// 初始化检验子报告
		initArrayCheckUserDetailReportInfo();
		// 初始化对应的fragment分类添加
		initAddFragment();
		// 设置操作按钮显示状态
    	setControlButtonShowType();
    	// 设置题目标题
    	setQuestionTitle();
    	// 初始化分页view
    	initCustomPagerView();
    	// 初始化获取检查指标资源库
    	initGetCheckNormResource();
	}

	@Override
	public void onSaveInstanceState(Bundle outState) {
    	super.onSaveInstanceState(outState);
    	outState.putInt(ActivityParams.PARAM_EVA_STEP, mStep);
    	if (mArrayEvaSledaiQuestion != null) {
    		outState.putSerializable(ActivityParams.PARAM_EVA_QUESTION_LIST, mArrayEvaSledaiQuestion);
		}
    	if (mUserEvaluateReportInfo != null) {
    		outState.putSerializable(ActivityParams.PARAM_USER_EVALUATE_REPORT, mUserEvaluateReportInfo);
    	}
	}
	
	@Override
	protected void onResume() {
		super.onResume();
	}
	
	@Override
	public void onPause() {
		super.onPause();
	}
	
	@Override
	protected void onDestroy() {
		super.onDestroy();
//		if (myThread != null) {
//			myThread.interrupt();
//		}
	}
	
	@Override
	public boolean onKeyDown(int keyCode, KeyEvent event) {
		//禁止使用手机返回键
		return true;
	}

	@Override
	public void onClick(View v) {
		// TODO Auto-generated method stub
		switch (v.getId()) {
		case R.id.btn_quit_bottom: { // 返回主菜单
			Intent intent= new Intent(this, MainActivity.class);  
			intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);  
			startActivity(intent); 
		}
			break;
			
		case R.id.btn_right: //帮助
			
			break;
			
		case R.id.btn_middle_bottom: {
			if (mStep > 0 ) {  // 上一步
				if (mStep < (mArrayFragmentPages.size()-1)) {
					// 判断
					if (mStep == 15) { // 脱发(16/25) mStep = 15
						// 若尿常规或24小时尿蛋白(11/25) 是:继续  否:跳转到 尿常规或24小时尿蛋白(11/25) mStep = 10 
						QuestionEntity questionInfo = mArrayEvaSledaiQuestion.get(10);
		                for (AnswerEntity itemAnswer : questionInfo.answer_list) {
		                    if(itemAnswer.select_type == 1) {
		                    	if (itemAnswer.item_id == 2) {//若选否
	                            	mStep = 10;
	                            	setControlButtonShowType();
	            					mCustomPagerView.setCurrentItem(mStep, true);
	                                return;
	                            }
		                        break;
		                    }
		                }
					}
					mStep--;
					setControlButtonShowType();
					mCustomPagerView.setCurrentItem(mStep, true);
				} else { // 向顾问咨询
					Intent intent= new Intent(this, ConsultSwitchActivity.class);  
					intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);  
					startActivity(intent); 
					finish(false);
				}
			}
		}
			break;
			
		case R.id.btn_right_bottom: { // 下一步/提交
			if (mStep < (mArrayFragmentPages.size()-1) ) {
				if(checkDataVaild()) {
					if (mStep == mArrayFragmentPages.size()-2) { // 提交
						//待显示结果页，提交数据
						saveSubmitUserEvaluateSledaiToLocal();
						return;
					} 
					// 下一步
					// 判断
		            if (mStep == 10) {
		                //尿常规或24小时尿蛋白(11/25) 是:继续  否:跳转到 脱发(16/25) mStep = 15  	
		            	QuestionEntity questionInfo = mArrayEvaSledaiQuestion.get(mStep);
		                for (AnswerEntity itemAnswer : questionInfo.answer_list) {
		                    if(itemAnswer.select_type == 1) {
	                            if (itemAnswer.item_id == 2) { //若选否
	                            	mStep = 15;
	                            	setControlButtonShowType();
	            					mCustomPagerView.setCurrentItem(mStep, true);
	                                return;
	                            }
		                        break;
		                    }
		                }						
					}
					mStep++;
					setControlButtonShowType();
					mCustomPagerView.setCurrentItem(mStep, true);
				}
			} else { // 查看报告
				Intent intent= new Intent(this, AssSleReportFragmentActivity.class); 
				Bundle bundle = new Bundle();
				bundle.putSerializable(ActivityParams.PARAM_EVA_QUESTION_INFO, mArrayEvaSledaiQuestion);
				bundle.putSerializable(ActivityParams.PARAM_USER_EVALUATE_REPORT, mUserEvaluateReportInfo);
				intent.putExtras(bundle);
				startActivity(intent); 
				//finish(false);
			}
		}
			break;
			
		default:
			break;
		}
		
	}

	/** 初始化view*/
	private void initView() {
		// TODO Auto-generated method stub
		Button mBtnMenu = (Button) findViewById(R.id.btn_quit_bottom); //返回主菜单
    	mBtnMenu.setOnClickListener(this);
    	mBtnMenu.setBackgroundResource(R.drawable.style_topbtn_menu);
    	ImageView mImgTypeIcon = (ImageView) findViewById(R.id.icon_type); //类型icon
    	mImgTypeIcon.setVisibility(View.VISIBLE);
    	mImgTypeIcon.setImageResource(R.drawable.icon_assess);
    	mTextTitle = (TextView) findViewById(R.id.txt_title); // 标题
    	mBtnLast = (Button) findViewById(R.id.btn_middle_bottom);  //上一步
    	mBtnLast.setOnClickListener(this);
    	mBtnLast.setVisibility(View.INVISIBLE);
    	mBtnNext = (Button) findViewById(R.id.btn_right_bottom); //下一步或提交
    	mBtnNext.setOnClickListener(this);
    	mBtnLast.setText(this.getResources().getString(R.string.btn_last));
    	mBtnNext.setText(this.getResources().getString(R.string.btn_next));
    	
    	mCustomPagerView = (CustomPagerView)findViewById(R.id.pagerview_ass);
    	mCustomPagerView.setCanScroll(false);		
	}
	/** 获取SLEDAI题目*/
	@SuppressWarnings("unchecked")
	private void getEvaSledaiQuestion(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		if(savedInstanceState == null) { 
    		//获取SLEDAI题目
    		mArrayEvaSledaiQuestion = EvaSleUtil.getEvaSleQuestion();
    	} else {
    		mStep = savedInstanceState.getInt(ActivityParams.PARAM_EVA_STEP, 0);
    		mArrayEvaSledaiQuestion = (ArrayList<QuestionEntity>)savedInstanceState.getSerializable(ActivityParams.PARAM_EVA_QUESTION_LIST);
    		mUserEvaluateReportInfo = (UserEvaluateReportEntity) savedInstanceState.getSerializable(ActivityParams.PARAM_USER_EVALUATE_REPORT);
    	}
	}
	
	/** 获取用户检查子报告(此列表只用于狼疮评估填空题) 
	 * @return */
	private ArrayList<UserCheckReportDetailEntity> getArrayCheckUserDetailReportInfo() {
		// TODO Auto-generated method stub
		ArrayList<UserCheckReportDetailEntity> tempArrayCheckUserDetailReportInfo = new ArrayList<UserCheckReportDetailEntity>();
		// 根据检查报告实体填写填空题的默认值
		UserCheckReportDetailEntity userCheckDetailInfoPRO = null;
		UserCheckReportDetailEntity userCheckDetailInfoC3 = null;
		UserCheckReportDetailEntity userCheckDetailInfoC4 = null;
		UserCheckReportDetailEntity userCheckDetailInfoPLT = null;
		UserCheckReportDetailEntity userCheckDetailInfoWBC = null;
		ArrayList<UserCheckReportEntity> arrayUserCheckReport = new UserCheckReportHelper().parseXmlToUserCheckReportList();
		int count = 0; // 只比对前10条数据
		for (UserCheckReportEntity userCheckReportInfo : arrayUserCheckReport) {
			if (userCheckReportInfo.usercheckreportdetail_list != null && userCheckReportInfo.usercheckreportdetail_list.size() != 0) {
				for (UserCheckReportDetailEntity userDetailInfo : userCheckReportInfo.usercheckreportdetail_list) {
					if (userCheckDetailInfoPRO == null && userDetailInfo.norm_id == CHECKNORM_ID_PRO) {
                        userCheckDetailInfoPRO = new UserCheckReportDetailEntity();
                        userCheckDetailInfoPRO.norm_id = userDetailInfo.norm_id;
                        userCheckDetailInfoPRO.value = userDetailInfo.value;
                        tempArrayCheckUserDetailReportInfo.add(userCheckDetailInfoPRO);
                        if (userCheckDetailInfoC3 != null && userCheckDetailInfoC4 != null && userCheckDetailInfoPLT != null && userCheckDetailInfoWBC != null ) {
                            break;
                        }
					} else if (userCheckDetailInfoC3 == null && userDetailInfo.norm_id == CHECKNORM_ID_C3) {
						userCheckDetailInfoC3 = new UserCheckReportDetailEntity();
                        userCheckDetailInfoC3.norm_id = userDetailInfo.norm_id;
                        userCheckDetailInfoC3.value = userDetailInfo.value;
                        tempArrayCheckUserDetailReportInfo.add(userCheckDetailInfoC3);
                        if (userCheckDetailInfoPRO != null && userCheckDetailInfoC4 != null && userCheckDetailInfoPLT != null && userCheckDetailInfoWBC != null) {
                            break;
                        }
					} else if (userCheckDetailInfoC4 == null && userDetailInfo.norm_id == CHECKNORM_ID_C4) {
                        userCheckDetailInfoC4 = new UserCheckReportDetailEntity();
                        userCheckDetailInfoC4.norm_id = userDetailInfo.norm_id;
                        userCheckDetailInfoC4.value = userDetailInfo.value;
                        tempArrayCheckUserDetailReportInfo.add(userCheckDetailInfoC4);
                        if (userCheckDetailInfoPRO != null && userCheckDetailInfoC3 != null && userCheckDetailInfoPLT != null && userCheckDetailInfoWBC != null) {
                            break;
                        }
					} else if (userCheckDetailInfoPLT == null && userDetailInfo.norm_id == CHECKNORM_ID_PLT) {
                        userCheckDetailInfoPLT = new UserCheckReportDetailEntity();
                        userCheckDetailInfoPLT.norm_id = userDetailInfo.norm_id;
                        userCheckDetailInfoPLT.value = userDetailInfo.value;
                        tempArrayCheckUserDetailReportInfo.add(userCheckDetailInfoPLT);
                        if (userCheckDetailInfoPRO != null && userCheckDetailInfoC3 != null && userCheckDetailInfoC4 != null && userCheckDetailInfoWBC != null) {
                            break;
                        }
					} else if (userCheckDetailInfoWBC == null && userDetailInfo.norm_id == CHECKNORM_ID_WBC) {
                        userCheckDetailInfoWBC = new UserCheckReportDetailEntity();
                        userCheckDetailInfoWBC.norm_id = userDetailInfo.norm_id;
                        userCheckDetailInfoWBC.value = userDetailInfo.value;
                        tempArrayCheckUserDetailReportInfo.add(userCheckDetailInfoWBC);
                        if (userCheckDetailInfoPRO != null && userCheckDetailInfoC3 != null && userCheckDetailInfoC4 != null && userCheckDetailInfoPLT != null) {
                            break;
                        }
					}
				}
			}
			count++;
            if (count >= 10) {
                break;
            }
		}
		return tempArrayCheckUserDetailReportInfo;
	}

	/** 获取用户检验报告详情指标值*/
	private String getUserCheckReportDetailNormValue(int checkNormId) {
		// TODO Auto-generated method stub
		String value = "";
		if (mArrayCheckUserDetailReportInfo != null && mArrayCheckUserDetailReportInfo.size() != 0) {
            for (UserCheckReportDetailEntity userDetailInfo : mArrayCheckUserDetailReportInfo) {
                if (userDetailInfo.norm_id == checkNormId) {
                	value = userDetailInfo.value;
                }
            }
        }
		return value;
	}
	
	/** 初始化检验子报告(线程)*/
	private void initArrayCheckUserDetailReportInfo() {
		// TODO Auto-generated method stub
		// 获取用户检查子报告(此列表只用于狼疮评估填空题)
        mArrayCheckUserDetailReportInfo = getArrayCheckUserDetailReportInfo();
//		myThread.setDaemon(true); // 设置为后台进程(守护线程)
//		myThread.start();
	}	
	
	/** fragment分类添加*/
	private void initAddFragment() {
		// TODO Auto-generated method stub
		if (mArrayFragmentPages == null) {
			mArrayFragmentPages = new ArrayList<BaseFragment>();
		}
		if (mArrayEvaSledaiQuestion != null) {
			for (int i = 0; i < mArrayEvaSledaiQuestion.size(); i++) {
				QuestionEntity itemQuestion = mArrayEvaSledaiQuestion.get(i);
				if (itemQuestion.item_type == QuestionEntity.QTYPE_SELECT_PECIAL) { // 特殊多选
					if (itemQuestion.answer_list.size() <= 4) {
//						AssSleSelectSpecialListFragment mSelectSpecialFragment = new AssSleSelectSpecialListFragment();
//						Bundle bundle = new Bundle();
//						bundle.putSerializable(ActivityParams.PARAM_EVA_QUESTION_INFO, itemQuestion);
//						mSelectSpecialFragment.setArguments(bundle);
//						mArrayFragmentPages.add(mSelectSpecialFragment);
						mArrayFragmentPages.add(AssSleSelectSpecialListFragment.newInstance(itemQuestion));
					} else {
//						AssSleSelectSpecialGridFragment mSelectSpecialFragment = new AssSleSelectSpecialGridFragment();
//						Bundle bundle = new Bundle();
//						bundle.putSerializable(ActivityParams.PARAM_EVA_QUESTION_INFO, itemQuestion);
//						mSelectSpecialFragment.setArguments(bundle);
//						mArrayFragmentPages.add(mSelectSpecialFragment);
						mArrayFragmentPages.add(AssSleSelectSpecialGridFragment.newInstance(itemQuestion));
					}
				} else if (itemQuestion.item_type == QuestionEntity.QTYPE_SELECT_SINGLE) { // 单选
//					AssSleSelectSingleListFragment mSingleListFragment = new AssSleSelectSingleListFragment();
//					Bundle bundle = new Bundle();
//					bundle.putSerializable(ActivityParams.PARAM_EVA_QUESTION_INFO, itemQuestion);
//					mSingleListFragment.setArguments(bundle);
//					mArrayFragmentPages.add(mSingleListFragment);
					mArrayFragmentPages.add(AssSleSelectSingleListFragment.newInstance(itemQuestion));
				} else if (itemQuestion.item_type == QuestionEntity.QTYPE_NUM_FILL) { // 数字填空
					if (itemQuestion.item_id == EvaSleUtil.QUE_SLE_QUESTION21_ID) {  // 补体c3
						// 写死下一道为补体c4
						QuestionEntity itemQuestion2 = mArrayEvaSledaiQuestion.get(++i);
//						String normValue = getUserCheckReportDetailNormValue(CHECKNORM_ID_C3);
//						String normValue2 = getUserCheckReportDetailNormValue(CHECKNORM_ID_C4);
//						AssSleWriteNumberComplementFragment mWriteNumberFragment = new AssSleWriteNumberComplementFragment();
//						Bundle bundle = new Bundle();
//						bundle.putSerializable(ActivityParams.PARAM_EVA_QUESTION_INFO_C3, itemQuestion);
//						bundle.putSerializable(ActivityParams.PARAM_EVA_QUESTION_INFO_C4, itemQuestion2);
//						mWriteNumberFragment.setArguments(bundle);
//						mArrayFragmentPages.add(mWriteNumberFragment);
//						mArrayFragmentPages.add(AssSleWriteNumberComplementFragment.newInstance(itemQuestion, itemQuestion2, normValue, normValue2));
						mArrayFragmentPages.add(AssSleWriteNumberComplementFragment.newInstance(itemQuestion, itemQuestion2));
					} else {
//						String normValue = "";
//						if (itemQuestion.item_id == EvaSleUtil.QUE_SLE_QUESTION14_ID) { // 24h尿蛋白
//							// 获取用户检验报告详情指标值
//							normValue = getUserCheckReportDetailNormValue(CHECKNORM_ID_PRO);
//						} else if (itemQuestion.item_id == EvaSleUtil.QUE_SLE_QUESTION25_ID){
//							normValue = getUserCheckReportDetailNormValue(CHECKNORM_ID_PLT);
//						} else if (itemQuestion.item_id == EvaSleUtil.QUE_SLE_QUESTION26_ID){
//							normValue = getUserCheckReportDetailNormValue(CHECKNORM_ID_WBC);
//						}
//						AssSleWriteNumberFragment mWriteNumberFragment = new AssSleWriteNumberFragment();
//						Bundle bundle = new Bundle();
//						bundle.putSerializable(ActivityParams.PARAM_EVA_QUESTION_INFO, itemQuestion);
//						mWriteNumberFragment.setArguments(bundle);
//						mArrayFragmentPages.add(mWriteNumberFragment);
//						mArrayFragmentPages.add(AssSleWriteNumberFragment.newInstance(itemQuestion, normValue));
						mArrayFragmentPages.add(AssSleWriteNumberFragment.newInstance(itemQuestion));
					}
				}
			}
			// 结果页
			AssSleResultFragment mSleResultFragment = new AssSleResultFragment();
			mArrayFragmentPages.add(mSleResultFragment);
		}
	}
	
	/** 设置操作按钮显示状态*/
	private void setControlButtonShowType() {
		// TODO Auto-generated method stub
		if (mStep == mArrayFragmentPages.size()-1) {
			//结果页
			mBtnLast.setVisibility(View.VISIBLE);
			mBtnLast.setText(this.getResources().getString(R.string.btn_consult)); // 向顾问咨询
			mBtnNext.setText(this.getResources().getString(R.string.btn_report)); // 查看报告

		} else {
			if (mStep == 0) {
				mBtnLast.setVisibility(View.INVISIBLE);
			} else {
				mBtnLast.setVisibility(View.VISIBLE);
			}
			if (mStep == mArrayFragmentPages.size()-2) {
				//待显示最后道题目，按钮显示提交
				mBtnNext.setText(this.getResources().getString(R.string.btn_submit)); // 提交
			} else {
				mBtnNext.setText(this.getResources().getString(R.string.btn_next)); // 下一步
			}
		}
	}
	
	/** 设置题目标题*/
	private void setQuestionTitle() {
		// TODO Auto-generated method stub
		switch(mStep) {
		case 0: //癫痫样发作(1/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_1));
			break;
			
		case 1: //精神症状(2/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_2));
			break;
								
		case 2: //器质性脑病(3/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_3));
			break;
			
		case 3: //视觉障碍(4/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_4));
			break;
			
		case 4: //颅神经病变(5/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_5));
			break;
			
		case 5: //狼疮性头痛(6/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_6));
			break;
			
		case 6: //脑血管意外(7/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_7));
			break;
			
		case 7: //血管炎(8/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_8));
			break;
			
		case 8: //关节炎(9/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_9));
			break;
			
		case 9: //肌炎(10/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_10));
			break;
			
		case 10: //尿常规或24小时尿蛋白(11/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_11));
			break;
			
		case 11: //管型尿(12/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_12));
			break;
			
		case 12: //尿常规(红细胞)(13/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_13));
			break;
			
		case 13: //尿蛋白(14/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_14));
			break;
			
		case 14: //尿常规(白细胞)(15/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_15));
			break;
			
		case 15: //脱发(16/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_16));
			break;
			
		case 16: //皮疹(17/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_17));
			break;
			
		case 17: //粘膜溃疡(18/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_18));
			break;
			
		case 18: //胸膜炎(19/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_19));
			break;
			
		case 19: //心包炎(20/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_20));
			break;
			
		case 20: //低补体(21/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_21));
			break;
			
		case 21: //抗ds-DNA增加(22/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_22));
			break;
			
		case 22: //发热(23/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_23));
			break;
			
		case 23: //血小板(24/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_24));
			break;
			
		case 24: //白细胞(25/25)
			mTextTitle.setText(this.getResources().getString(R.string.ass_sledai_step_25));
			break;
			
		default: // 结果页
			mTextTitle.setText(this.getResources().getString(R.string.ass_result));
			break;
		}
	}

	/** 初始化分页view*/
	private void initCustomPagerView() {
		// TODO Auto-generated method stub
    	mPageAdapter = new MyPageAdapter(getSupportFragmentManager(), mArrayFragmentPages);
    	mCustomPagerView.setAdapter(mPageAdapter);
    	mCustomPagerView.setOnPageChangeListener(new OnPageChangeListener(){

    		@Override
    		public void onPageScrollStateChanged(int state) {
    			// TODO Auto-generated method stub
    			//状态有三个0空闲，1是正在滑行中，2目标加载完毕
    	        /**
    	         * Indicates that the pager is in an idle, settled state. The current page
    	         * is fully in view and no animation is in progress.
    	         */
    	        //public static final int SCROLL_STATE_IDLE = 0;
    	        /**
    	         * Indicates that the pager is currently being dragged by the user.
    	         */
    	        //public static final int SCROLL_STATE_DRAGGING = 1;
    	        /**
    	         * Indicates that the pager is in the process of settling to a final position.
    	         */
    	        //public static final int SCROLL_STATE_SETTLING = 2;
    		}

    		@Override
    		public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {
    			// TODO Auto-generated method stub
    			//从1到2滑动，在1滑动前调用
    			
    		}

    		@Override
    		public void onPageSelected(int position) {
    			// TODO Auto-generated method stub
    			//从1到2滑动，2被加载后掉用此方法
				setQuestionTitle();
    		}
    	});
	}

	/** 初始化获取检查指标资源库*/
	private void initGetCheckNormResource() {
		// TODO Auto-generated method stub
        GetCheckNormResourceController getCheckNormResourceController = new GetCheckNormResourceController(ValidIntervals.CACEH_TIME_FOREVER);
        getCheckNormResourceController.sendGetCheckNormResource(new UpdateGetUserCheckNormResourceView());
	}

	/** 设置用户检验检验报告数据*/
	protected void setUserCheckReport(ArrayList<RequestAnswerEntity> arrayRequsetAnswer) {
		// TODO Auto-generated method stub
		UserCheckReportEntity userCheckReportInfo = new UserCheckReportEntity();
        userCheckReportInfo.has_fulldata = 1; // 默认为含有所有数据
        userCheckReportInfo.usercheckreportdetail_list = new ArrayList<UserCheckReportDetailEntity>();
        userCheckReportInfo.usercheckreportpic_list = new ArrayList<UserCheckReportPicEntity>();
        userCheckReportInfo.delpic_list = new ArrayList<UserCheckReportPicEntity>();
        if (mCheckNormDetailListInfo != null) {
        	for (RequestAnswerEntity reqItem : arrayRequsetAnswer ) {
        		ChecknormDetailEntity tempChecknormDetailInfo = null;
        		switch (reqItem.req_question_id) {
        		case EvaSleUtil.QUE_SLE_QUESTION14_ID: { // 24h尿蛋白
        			tempChecknormDetailInfo = saveTempCheckNormDetailInfo(reqItem, CHECKNORM_ID_PRO); // 暂存临时检验指标详情信息
        		}
        			break;
        		case EvaSleUtil.QUE_SLE_QUESTION21_ID: { // C3
        			tempChecknormDetailInfo = saveTempCheckNormDetailInfo(reqItem, CHECKNORM_ID_C3);
        		}
        			break;
        		case EvaSleUtil.QUE_SLE_QUESTION22_ID: { // C4
        			tempChecknormDetailInfo = saveTempCheckNormDetailInfo(reqItem, CHECKNORM_ID_C4);
        		}
        			break;
        		case EvaSleUtil.QUE_SLE_QUESTION25_ID: { // 血小板
        			tempChecknormDetailInfo = saveTempCheckNormDetailInfo(reqItem, CHECKNORM_ID_PLT);
        		}
        			break;
        		case EvaSleUtil.QUE_SLE_QUESTION26_ID: { // 白细胞
        			tempChecknormDetailInfo = saveTempCheckNormDetailInfo(reqItem, CHECKNORM_ID_WBC);
        		}
        			break;
        		default:
        			break;
        		}
        		if (tempChecknormDetailInfo != null) {
        			UserCheckReportDetailEntity userCheckReportDetailInfo = new UserCheckReportDetailEntity();
        			userCheckReportDetailInfo.norm_id = tempChecknormDetailInfo.checknorm_id;
        			userCheckReportDetailInfo.value = tempChecknormDetailInfo.value;
        			userCheckReportDetailInfo.maxvalue = tempChecknormDetailInfo.maxvalue;
        			userCheckReportDetailInfo.minvalue = tempChecknormDetailInfo.minvalue;
        			userCheckReportDetailInfo.sex = tempChecknormDetailInfo.sex;
        			userCheckReportDetailInfo.mode = tempChecknormDetailInfo.mode;
        			userCheckReportDetailInfo.category_id = tempChecknormDetailInfo.category_id;
        			userCheckReportInfo.usercheckreportdetail_list.add(userCheckReportDetailInfo);
        		}
        	}
        	//创建时间
        	userCheckReportInfo.checkdate = Utils.getTimeString();
        	//含有指标标记位
        	if (userCheckReportInfo.usercheckreportdetail_list.size() > 0) {
        		userCheckReportInfo.hasdetail = 1;
        	}
        	//图片数量
        	userCheckReportInfo.piccount = 0;
        	// 新增用户检验报告数据(更新本地缓存列表及待上传数据列表)
        	new UserCheckReportHelper().addUserCheckReportInfo(userCheckReportInfo);
		}
	}
	
	/** 暂存临时检验指标详情信息
	 * @param reqItem 
	 * @param checknormId */
	private ChecknormDetailEntity saveTempCheckNormDetailInfo(RequestAnswerEntity reqItem, int checkNormId) {
		// TODO Auto-generated method stub
		for (ChecknormDetailEntity checknormDetailInfo : mCheckNormDetailListInfo) {
			if (checknormDetailInfo.checknorm_id == checkNormId) {
				checknormDetailInfo.value = reqItem.req_answer_content;
				return checknormDetailInfo;
			}
		}
		return null;
	}

	/** 检验当前页面数据是否有效*/
	private boolean checkDataVaild() {
		// TODO Auto-generated method stub
		QuestionEntity questionInfo1 = null;
		QuestionEntity questionInfo2 = null;
		if (mStep >= 0 && mStep < 20) {
			questionInfo1 = mArrayEvaSledaiQuestion.get(mStep);
			if (questionInfo1 != null) {
				return isQuestionSelectType(questionInfo1);
			}
		}
		if (mStep == 20) {
			questionInfo1 = mArrayEvaSledaiQuestion.get(mStep);
			questionInfo2 = mArrayEvaSledaiQuestion.get(mStep+1);
			if (questionInfo1 != null && questionInfo2 != null) {
				if (isQuestionSelectType(questionInfo1) && isQuestionSelectType(questionInfo2)) {
					return true;
				} else {
					return false;
				}
			}
		}
		if (mStep > 20 && mStep <= 24) {
			questionInfo2 = mArrayEvaSledaiQuestion.get(mStep+1);
			if (questionInfo2 != null) {
				return isQuestionSelectType(questionInfo2);
			}
		}
		return false;
	}
	
	/** 判断问题选项选中状态*/
	private boolean isQuestionSelectType(QuestionEntity questionInfo) {
		// TODO Auto-generated method stub
		if (questionInfo.item_type == QuestionEntity.QTYPE_SELECT_PECIAL || questionInfo.item_type == QuestionEntity.QTYPE_SELECT_SINGLE) {
			for (AnswerEntity itemAnswer : questionInfo.answer_list) {
				if (itemAnswer.select_type == 1) {
					return true;
				}
			}
			showMsgToast(this.getResources().getString(R.string.dia_error_noanswer_sel));
			return false;
		} else if (questionInfo.item_type == QuestionEntity.QTYPE_NUM_FILL) {
			if (questionInfo.answer_list != null && questionInfo.answer_list.size() > 0) {
				AnswerEntity answerInfo = questionInfo.answer_list.get(0);
				if (answerInfo.select_number > 0) {
					return true;
				}
			}
			showMsgToast(this.getResources().getString(R.string.dia_error_noanswer_fill));
			return false;
		} else {
			// 其他步骤
			return false;
		}
	}

	/** 提交评估*/
	private void saveSubmitUserEvaluateSledaiToLocal() {
		// TODO Auto-generated method stub
		// "数据提交中，请稍等..."
		showPd(AssSleFragmentActivity.this.getResources().getString(R.string.oper_processing));
			new Thread(new Runnable() {   
				@Override
				public void run() {
					boolean needDeleteUrineAnswerInfo = false; // 需要删除尿常规或尿蛋白相关的标注位
					ArrayList<RequestAnswerEntity> arrayRequsetAnswer = new ArrayList<RequestAnswerEntity>();
					for (QuestionEntity itemQuestion : mArrayEvaSledaiQuestion) {
						RequestAnswerEntity requsetAnswerInfo = new RequestAnswerEntity();
						requsetAnswerInfo.req_question_id = itemQuestion.item_id;
						requsetAnswerInfo.req_type = AnswerEntity.ANSWER_TYPE_SLE;
						if (itemQuestion.item_type == QuestionEntity.QTYPE_SELECT_PECIAL) { // 特殊多选
							requsetAnswerInfo.req_answer_content = "";
							StringBuffer stringBuffer = new StringBuffer();
							for (AnswerEntity itemAnswer : itemQuestion.answer_list) {
								if (itemAnswer.select_type == 1) {
									stringBuffer.append(itemAnswer.item_id+",");
								}
							}
							int location = stringBuffer.lastIndexOf(",", stringBuffer.length());
							stringBuffer.deleteCharAt(location);
							//stringBuffer.delete(stringBuffer.length()-1, stringBuffer.length()); // 去除最后的","
							requsetAnswerInfo.req_answer_content = String.valueOf(stringBuffer);
						} else if (itemQuestion.item_type == QuestionEntity.QTYPE_SELECT_SINGLE) { // 单选
							requsetAnswerInfo.req_answer_content = "";
							for (AnswerEntity itemAnswer : itemQuestion.answer_list) {
								if (itemAnswer.select_type == 1) {
									requsetAnswerInfo.req_answer_content = String.valueOf(itemAnswer.item_id);
									break;
								}
							}
						} else if (itemQuestion.item_type == QuestionEntity.QTYPE_NUM_FILL) { // 数字填空
							requsetAnswerInfo.req_answer_content = "";
							if (itemQuestion.answer_list != null && itemQuestion.answer_list.size() > 0) {
								AnswerEntity answerInfo = itemQuestion.answer_list.get(0);
								// 这里为了防止输入100; 结果显示100.0 的现象 
								if (answerInfo.select_number == (int)answerInfo.select_number) {
									requsetAnswerInfo.req_answer_content = String.valueOf((int)answerInfo.select_number);
								} else {
									requsetAnswerInfo.req_answer_content = String.valueOf(answerInfo.select_number);
								}
							}
						}
						
						//您最近是否做过尿常规或24小时尿蛋白检查？
						if (itemQuestion.item_id == EvaSleUtil.QUE_SLE_QUESTION11_ID) { 
				            for (AnswerEntity itemAnswer : itemQuestion.answer_list) {
				                if (itemAnswer.select_type == 1 
				                		&& itemAnswer.item_id == 2) { //否
				                    needDeleteUrineAnswerInfo = true;
				                }
				            }
				        }
						
						arrayRequsetAnswer.add(requsetAnswerInfo);
					}
					
					if (needDeleteUrineAnswerInfo) {
				    	//若需要删除尿常规或尿蛋白相关
				    	ArrayList<RequestAnswerEntity> arrayTemp = new ArrayList<RequestAnswerEntity>();
				        for (RequestAnswerEntity itemRequestAnswer : arrayRequsetAnswer) {
				            if (itemRequestAnswer.req_question_id == EvaSleUtil.QUE_SLE_QUESTION12_ID 
				            		|| itemRequestAnswer.req_question_id == EvaSleUtil.QUE_SLE_QUESTION13_ID
				            		|| itemRequestAnswer.req_question_id == EvaSleUtil.QUE_SLE_QUESTION14_ID
				            		|| itemRequestAnswer.req_question_id == EvaSleUtil.QUE_SLE_QUESTION15_ID ) {
				                // 管型尿(12/25) || 尿常规(红细胞)(13/25) || 尿蛋白(14/25) || 尿常规(白细胞)(15/25)
				            	arrayTemp.add(itemRequestAnswer);
				            }
				        }
				        arrayRequsetAnswer.removeAll(arrayTemp);
				    }
					
					//设置用户检验检验报告数据
					setUserCheckReport(arrayRequsetAnswer);
					
					//获取狼疮评估结果
					mUserEvaluateReportInfo = EvaSleUtil.getSleEvaluateReport(mArrayEvaSledaiQuestion, arrayRequsetAnswer);
					UserEvaluateReportHelper userEvaluateReportHelper = new UserEvaluateReportHelper();
					int result = userEvaluateReportHelper.addUserEvaluateReportInfo(mUserEvaluateReportInfo,true);
					
					dismissPd();
					
					String strResultInfo;
				    switch (result) {
				        case 1:
				            //提交成功
				        	Message msg = mtHandler.obtainMessage();   
			                msg.what = SUBMIT_DATA_OK;
			                mtHandler.sendMessage(msg);
				            return;
				        case -1:
				        	//您的存储空间可能已满，请尝试删除些其他应用或重新登录
				        	strResultInfo = AssSleFragmentActivity.this.getResources().getString(R.string.oper_error_save);
				            break;
				        case -2:
				            //离线数据过多，请连接网络
				        	strResultInfo = AssSleFragmentActivity.this.getResources().getString(R.string.oper_error_moresyndata);
				            break;
				        default:
				            //操作失败
				        	strResultInfo = AssSleFragmentActivity.this.getResources().getString(R.string.oper_error_default);
				    }
				    Message msg = mtHandler.obtainMessage();   
		            msg.obj = strResultInfo;
		            msg.what = SUBMIT_DATA_ERROR;
		            mtHandler.sendMessage(msg);  
				}
			}).start();
	}

	private Handler mtHandler = new Handler() {
		@Override
		public void handleMessage(Message msg) {
			switch (msg.what) {
			    		
			case SUBMIT_DATA_OK: {
				//展示结果页
				mStep = mArrayFragmentPages.size() - 1;
				setControlButtonShowType();
				//刷新痛风评估结果
				mPageAdapter.notifyDataSetChanged();
				mCustomPagerView.setCurrentItem(mStep, true);
			}				
				break;
				
			case SUBMIT_DATA_ERROR: {
				String errorInfo = (String) msg.obj;
				showMsgToast(errorInfo);
			}	
				break;
				
			default:
				break;
			}
		}
	};
	
	/**
	 * FragmentPager适配器,用于整个题目切换
	 * @author jgpeng
	 */
	class MyPageAdapter extends FragmentPagerAdapter{

		private ArrayList<BaseFragment> mList;
		
		public MyPageAdapter(FragmentManager fm) {
			super(fm);
			// TODO Auto-generated constructor stub
		}
		
		public MyPageAdapter(FragmentManager fm , ArrayList<BaseFragment> aList) {
			super(fm);
			// TODO Auto-generated constructor stub
			mList = aList;
		}

		@Override
		public Fragment getItem(int index) {
			// TODO Auto-generated method stub
			return mList.get(index);
		}

		@Override
		public int getCount() {
			// TODO Auto-generated method stub
			return mList.size();
		}
		
		@Override
		public int getItemPosition(Object object) {
			return POSITION_NONE;
		}
		
		@Override
		public Object instantiateItem(ViewGroup container, int position) {
			if (position == mList.size()-1) { // 结果页
				// 获取当前的Fragment
				AssSleResultFragment mAssResultFragment = (AssSleResultFragment) super.instantiateItem(container, position);
				// 刷新评估结果数据
				mAssResultFragment.refreshData(mUserEvaluateReportInfo);
				return mAssResultFragment;
			} else if (position == 13) { //尿蛋白(14/25)指标值
				// 获取当前的NumberFragment
				AssSleWriteNumberFragment mAssSleWriteNumberFragment = (AssSleWriteNumberFragment) super.instantiateItem(container, position);
				// 刷新指标值数据
				mAssSleWriteNumberFragment.refreshData(getUserCheckReportDetailNormValue(CHECKNORM_ID_PRO));
				return mAssSleWriteNumberFragment;
			} else if (position == 23) { //血小板(24/25)
				// 获取当前的NumberFragment
				AssSleWriteNumberFragment mAssSleWriteNumberFragment = (AssSleWriteNumberFragment) super.instantiateItem(container, position);
				// 刷新指标值数据
				mAssSleWriteNumberFragment.refreshData(getUserCheckReportDetailNormValue(CHECKNORM_ID_PLT));
				return mAssSleWriteNumberFragment;
			} else if (position == 24) { //白细胞(25/25)
				// 获取当前的NumberFragment
				AssSleWriteNumberFragment mAssSleWriteNumberFragment = (AssSleWriteNumberFragment) super.instantiateItem(container, position);
				// 刷新指标值数据
				mAssSleWriteNumberFragment.refreshData(getUserCheckReportDetailNormValue(CHECKNORM_ID_WBC));	
				return mAssSleWriteNumberFragment;
			} else if (position == 20) { //低补体(21/25)
				// 获取当前的NumberFragment
				AssSleWriteNumberComplementFragment mAssSleWriteNumberComplementFragment = (AssSleWriteNumberComplementFragment) super.instantiateItem(container, position);
				String normValue = getUserCheckReportDetailNormValue(CHECKNORM_ID_C3);
				String normValue2 = getUserCheckReportDetailNormValue(CHECKNORM_ID_C4);
				// 刷新指标值数据
				mAssSleWriteNumberComplementFragment.refreshData(normValue, normValue2);
				return mAssSleWriteNumberComplementFragment;
			}
			return super.instantiateItem(container, position);
		}

	}
	
//	/**
//	 * 开启线程获取用户检查相关指标数据
//	 * @author jgpeng
//	 *
//	 */
//	class MyThread extends Thread{
//		
//		@Override
//		public void run() {
//			// TODO Auto-generated method stub
//            // 获取用户检查子报告(此列表只用于狼疮评估填空题)
//            mArrayCheckUserDetailReportInfo = getArrayCheckUserDetailReportInfo();
//		}
//	}

	/**
	 * 获取检查指标资源库回调
	 * @author jgpeng
	 *
	 */
	class UpdateGetUserCheckNormResourceView extends CommonUpdateViewAsyncCallback<GetCheckNormResourceRequestEntity> {

		@Override
		public void onPostExecute(GetCheckNormResourceRequestEntity result) {
			// TODO Auto-generated method stub
			dismissPd();
			if (result != null) {
				mCheckNormDetailListInfo = result.checknormdetail_list;
			}
		}

		@Override
		public void onException(IException ie) {
			// TODO Auto-generated method stub
			dismissPd();
		}
	}
}
