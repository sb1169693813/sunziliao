<?php
/**
 * 翻页共通
 * @author liuwenliang
 * 修改为使用GET方式传递参数 (原来的)
 */
class CLinkPager {

	// 分页栏每页显示的页数
	public $rollPage = 5;
	// 默认列表每页显示行数
	public $listRows = 20;
	// 起始行数
	public $firstRow    ;
	// 分页总页面数
	protected $totalPages  ;
	// 总行数
	protected $totalRows  ;
	// 当前页数
	protected $nowPage    ;
	// 分页的栏的总页数
	protected $coolPages   ;
	// 分页显示定制
	protected $config  =    array(
		'header'=>'条记录',
		'prev'=>'上一页',
		'next'=>'下一页',
		'first'=>'第一页',
		'last'=>'最后一页',
		//modify by lwl
		'theme'=>'%header%%first%%upPage%%linkPage%%downPage%%end%');
	// 默认分页变量名
	protected $varPage;
	//form名称
	protected $formName;
	//模块名+方法名
	protected $actionName;

	protected $urlPrefix;

	/**
	 * 架构函数
	 * @access public
	 * @param string $totalRows  总的记录数
	 * @param string $listRows  每页显示记录数
	 * @param string $urlPrefix
	 * @param String $varPage  分页变量名
	 */
	public function __construct($totalRows,$listRows='',$urlPrefix='',$varPage='') {
		$this->totalRows    =   $totalRows;
		$this->urlPrefix = $urlPrefix;

		$this->varPage      =   !empty($varPage) ? $varPage : (C('VAR_PAGE') ? C('VAR_PAGE') : 'p') ;
		if(!empty($listRows)) {
			$this->listRows =   intval($listRows);
		}
		$this->totalPages   =   ceil($this->totalRows/$this->listRows);     //总页数
		$this->coolPages    =   ceil($this->totalPages/$this->rollPage);
		$this->nowPage      =   !empty($_GET[$this->varPage])?intval($_GET[$this->varPage]):1;
		if($this->nowPage<1){
			$this->nowPage  =   1;
		}elseif(!empty($this->totalPages) && $this->nowPage>$this->totalPages) {
			$this->nowPage  =   $this->totalPages;
		}
		$this->firstRow     =   $this->listRows*($this->nowPage-1);
	}

	public function setConfig($name,$value) {
		if(isset($this->config[$name])) {
			$this->config[$name]    =   $value;
		}
	}

	/**
	 * 分页显示输出
	 * @access public
	 */
	public function show() {
		if(0 == $this->totalRows) return '';
		$p              =   $this->varPage;
		$nowCoolPage    =   ceil($this->nowPage/$this->rollPage);

		$url = $this->urlPrefix;
		//上下翻页字符串
		$upRow          =   $this->nowPage-1;
		$downRow        =   $this->nowPage+1;
		if ($upRow>0){
			$upPage     =
				//modify by lwl
				'<a href="'.U($url,array($p=>$upRow)).'" class="page">&lt;&lt;</a>';
		}else{
			$upPage     =   '';
		}

		if ($downRow <= $this->totalPages){
			//modify by lwl
			$downPage	= '<a href="'.U($url,array($p=>$downRow)).'" class="page">&gt;&gt;</a>';
		}else{
			$downPage   =   '';
		}
		// << < > >>
		if($nowCoolPage == 1){
			$theFirst   =   '';
			$prePage    =   '';
		}else{
			//modify by lwl 
			$preRow     =   $this->nowPage-$this->rollPage;
			$prePage    =   '<a href="'.U($url,array($p=>$preRow)).'" class="page">'.$this->rollPage.'</a>';
			$theFirst   =   '<a href="'.U($url,array($p=>1)).'" class="page">'.$this->config["first"].'</a>';
		}
		if($nowCoolPage == $this->coolPages){
			$nextPage   =   '';
			$theEnd     =   '';
		}else{
			$nextRow    =   $this->nowPage+$this->rollPage;
			$theEndRow  =   $this->totalPages;
			//modify by lwl
			$nextPage   =   '<a href="'.U($url,array($p=>$nextRow)).'" class="page">'.$this->rollPage.'</a>';
			//modify by lwl
			$theEnd     =  '<a href="'.U($url,array($p=>$theEndRow)).'" class="page">'.$this->config["last"].'</a>';
		}
		// 1 2 3 4 5
		$linkPage = '';
		//modify by lwl 

		//		for($i=1;$i<=$this->rollPage;$i++){
		//			$page       =   ($nowCoolPage-1)*$this->rollPage+$i;
		$aroundPage = (int)($this->rollPage/2);
		$rollMaxPage = $this->rollPage - $aroundPage;
		for($i=$aroundPage*-1;$i<$rollMaxPage;$i++)
		{
			$page       =   $this->nowPage + $i;
			if($page <= 0)
			{
				$rollMaxPage++;
				continue;
			}

			//modify by lwl 
			if($page!=$this->nowPage){
				if($page<=$this->totalPages){
					$linkPage .= '<a href="'.U($url,array($p=>$page)).'" class="page">'.$page.'</a>';
				}else{
					break;
				}
			}else{
				if($this->totalPages != 1){
					//modify by lwl 
					$linkPage .= '<a href="javascript:void(0);" class="pagechoosen">'.$page.'</a>';
				}
			}
		}

		$header = '<ul class="pagination">';
		$end = $theEnd . "</ul>";
		$pageStr     =   str_replace(
			array('%header%','%nowPage%','%totalRow%','%totalPage%','%upPage%','%downPage%','%first%','%prePage%','%linkPage%','%nextPage%','%end%'),
			array(
				//'<span class="page">共'.$this->totalRows.$this->config['header'].'</span>',
				$header,
				$this->nowPage,
				$this->totalRows,
				$this->totalPages,
				$upPage,
				$downPage,
				$theFirst,
				$prePage,
				$linkPage,
				$nextPage,
				$end),$this->config['theme']);

		return $pageStr;
	}
}
