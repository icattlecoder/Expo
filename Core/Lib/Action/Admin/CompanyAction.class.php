<?php
/**
 * 后台用户管理模块
 * 
 */
class CompanyAction extends AdminAction {
    public function _initialize() {
        parent::_initialize();  //RBAC 验证接口初始化
    }

/* ========用户部分======== */
    public function index(){
    	if(!isset($_GET['eid'])){
        	echo "error";
        	return;
        }
        $expo = $_GET['eid'];
        $ExpoDB = D('Expo');       
        $expoName = $ExpoDB->where('id='.$expo)->getField('name');

        import('ORG.Util.Page');// 导入分页类
        $map = array();
        $CompanyDB = D('Company');
        $count = $CompanyDB->where('eid='.$expo)->count();
        $Page       = new Page($count,C('web_admin_pagenum'));// 实例化分页类 传入总记录数

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p'])?$_GET['p']:1;
       
        //echo "$expo";
        //echo $expo;
        $show = $Page->show();// 分页显示输出

        $list = $CompanyDB->where('eid='.$expo)->order('id ASC')->page($nowPage.','.C('web_admin_pagenum'))->select();
      
        $this->assign('list',$list);
        $this->assign('nowPage',$nowPage);       
        $this->assign('page',$show);// 赋值分页输出   
        $this->assign('eid',$expo);
        $this->assign('expoName',$expoName);        
        if($_GET['s']=="1"){
            echo json_encode($list);
        }else{
             $this->display();
        }
       

    }    
    // 添加会展
    public function add(){

        $CompanyDB = D("Company");       
        $ExpoDB = D('Expo');
        $expo = $_GET['eid'];
       
        $expoName = $ExpoDB->where('id='.$expo)->getField('name');
       

        if(isset($_POST['dosubmit'])) {
            //根据表单提交的POST数据创建数据对象
            if($CompanyDB->create()){
                if($CompanyDB->add()){
                    $this->assign("jumpUrl",U('/Admin/Company/index/eid/$expo'));
                    $this->success('添加成功!');
                }else{
                     $this->error('添加失败!');
                }
            }else{
                $this->error($CompanyDB->getError());
            }
        }else{
            $this->assign('eid',$expo);
            $this->assign('expoName',$expoName);
            $this->assign('tpltitle','添加');
            $this->display();
        }
    }



        //批量添加
    public function batchadd(){          
        
        if(!isset($_GET['eid']))
        {
              
            $this->error('非法操作!');
        }
       $expo = $_GET['eid'];        
        $ExpoDB = D('Expo');
       
        $expoName = $ExpoDB->where('id='.$expo)->getField('name');
        $this->assign('eid',$expo);
        $this->assign('expoName',$expoName);
        if(isset($_POST['dosubmit'])) {
            //根据表单提交的POST数据创建数据对象
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();// 实例化上传类
            $upload->maxSize  = 31450728 ;// 设置附件上传大小
            $upload->allowExts  = array('xls');// 设置附件上传类型
            $upload->savePath =  './Public/Uploads/';// 设置附件上传目录
            if(!$upload->upload()) {// 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
             }else{// 上传成功 获取上传文件信息
                $info =  $upload->getUploadFileInfo();
                require_once 'Excel/reader.php';
                // ExcelFile($filename, $encoding);
                $data = new Spreadsheet_Excel_Reader();
                $data->setOutputEncoding('UTF-8');                
                $data->read($info[0]['savepath'].$info[0]['savename']);
                /*
                $incc = 1;
                //echo $data->sheets[0]['cells'][1][$incc++];
                echo $data->sheets[0]['cells'][1][$incc++]==='序号'; 
                echo $data->sheets[0]['cells'][1][$incc++]=="公司名称";  
                echo $data->sheets[0]['cells'][1][$incc++]=="类型";  
                echo $data->sheets[0]['cells'][1][$incc++]=="展位号";  
                echo $data->sheets[0]['cells'][1][$incc++]=="电话";  
                echo $data->sheets[0]['cells'][1][$incc++]=="传真";  
                echo $data->sheets[0]['cells'][1][$incc++]=="邮箱";  
                echo $data->sheets[0]['cells'][1][$incc++]=="网址";  
                echo $data->sheets[0]['cells'][1][$incc++]=="地址";  
                echo $data->sheets[0]['cells'][1][$incc++]=="图片";  
                return;

                if(!($data->sheets[0]['cells'][1][$incc++]=="序号"&&$data->sheets[0]['cells'][1][$incc++]=="公司名称"&&$data->sheets[0]['cells'][1][$incc++]=="类型"&&$data->sheets[0]['cells'][1][$incc++]=="展位号"&&$data->sheets[0]['cells'][1][$incc++]=="电话"&&$data->sheets[0]['cells'][1][$incc++]=="传真"&&$data->sheets[0]['cells'][1][$incc++]=="邮箱"&&$data->sheets[0]['cells'][1][$incc++]=="网址"&&$data->sheets[0]['cells'][1][$incc++]=="地址"&&$data->sheets[0]['cells'][1][$incc++]=="图片"))
                {
                     $this->error('Excel模板格式不正确,请重试!');
                }
                */
                $Tdata = array();
                for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
                    $j=2;
                    $Tdata[$i-2]['name']        =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['type']        =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['exposition']  =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['phone']       =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['fax']         =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['email']       =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['website']     =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['address']     =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['pic']         =$data->sheets[0]['cells'][$i][$j++];
                    $Tdata[$i-2]['eid']         =$expo;                    
                }
               if(M('Company')->addAll($Tdata)){
                    $this->assign("jumpUrl",U('/Admin/Company/index/',array('eid'=>$expo)));
                    $this->success('导入成功!');        
                }else{
                     $this->error('导入失败!');
                }
            } 
            
           
        }else{          
            $this->assign('tpltitle','导入');
           
        }
         $this->display();
    }


/*
    // 添加用户
    public function add(){
        $UserDB = D("User");
        if(isset($_POST['dosubmit'])) {

            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            if(empty($password) || empty($repassword)){
                $this->error('密码必须！');
            }
            if($password != $repassword){
                $this->error('两次输入密码不一致！');
            }

            //根据表单提交的POST数据创建数据对象
            if($UserDB->create()){
                $user_id = $UserDB->add();
                if($user_id){
                    $data['user_id'] = $user_id;
                    $data['role_id'] = $_POST['role'];
                    if (M("RoleUser")->data($data)->add()){
                        $this->assign("jumpUrl",U('/Admin/User/index'));
                        $this->success('添加成功！');
                    }else{
                        $this->error('用户添加成功,但角色对应关系添加失败!');
                    }
                }else{
                     $this->error('添加失败!');
                }
            }else{
                $this->error($UserDB->getError());
            }
        }else{
            $role = D('Role')->getAllRole(array('status'=>1),'sort DESC');
            $this->assign('role',$role);
            $this->assign('tpltitle','添加');
            $this->display();
        }
    }

    // 编辑用户
    public function edit(){
         $UserDB = D("User");
        if(isset($_POST['dosubmit'])) {
            $password = $_POST['password'];
            $repassword = $_POST['repassword'];
            if(!empty($password) || !empty($repassword)){
                if($password != $repassword){
                    $this->error('两次输入密码不一致！');
                }
                $_POST['password'] = md5($password);
            }

            if(empty($password) && empty($repassword)) unset($_POST['password']);   //不填写密码不修改

            //根据表单提交的POST数据创建数据对象
            if($UserDB->create()){
                if($UserDB->save()){
                    $where['user_id'] = $_POST['id'];
                    $data['role_id'] = $_POST['role'];
                    M("RoleUser")->where($where)->save($data);
                    $this->assign("jumpUrl",U('/Admin/User/index'));
                    $this->success('编辑成功！');
                }else{
                     $this->error('编辑失败!');
                }
            }else{
                $this->error($UserDB->getError());
            }
        }else{
            $id = $this->_get('id','intval',0);
            if(!$id)$this->error('参数错误!');
            $role = D('Role')->getAllRole(array('status'=>1),'sort DESC');
            $info = $UserDB->getUser(array('id'=>$id));
            $this->assign('tpltitle','编辑');
            $this->assign('role',$role);
            $this->assign('info',$info);
            $this->display('add');
        }
    }

    //ajax 验证用户名
    public function check_username(){
        $userid = $this->_get('userid');
        $username = $this->_get('username');
        if(D("User")->check_name($username,$userid)){
            echo 1;
        }else{
            echo 0;
        }
    }

    //删除用户
    public function del(){
        $id = $this->_get('id','intval',0);
        if(!$id)$this->error('参数错误!');
        $UserDB = D('User');
        $info = $UserDB->getUser(array('id'=>$id));
        if($info['username']==C('SPECIAL_USER')){     //无视系统权限的那个用户不能删除
           $this->error('禁止删除此用户!');
        }
        if($UserDB->delUser('id='.$id)){
            if(M("RoleUser")->where('user_id='.$id)->delete()){
                $this->assign("jumpUrl",U('/Admin/User/index'));
                $this->success('删除成功！');
            }else{
                $this->error('用户成功,但角色对应关系删除失败!');
            }
        }else{
            $this->error('删除失败!');
        }
    }
*/
/* ========角色部分======== */

    // 编辑会展


    //删除会展
    public function del(){
        $nowPage = isset($_GET['p'])?$_GET['p']:1;
        if(!isset($_GET['eid']))
        {
              
            $this->error('非法操作!');
        }
        $eid = $_GET['eid'];
        $id = $this->_get('id','intval',0);
        if(!$id)$this->error('参数错误!');
        $CompanyDB = M('Company');

        if($CompanyDB->where('id='.$id)->delete())
        {
             $this->assign("jumpUrl",U('/Admin/Company/index',array('eid' =>$eid,'p'=>$nowPage)));
             $this->success('删除成功！');
        }else{
                $this->error('删除失败!');
        }      
    }
    //删除会展
    public function batchdel(){
        $nowPage = isset($_GET['p'])?$_GET['p']:1;
        if(!isset($_GET['eid']))
        {
              
            $this->error('非法操作!');
        }
        $eid = $_GET['eid'];        
        $ids = $_GET['ids'];       
        if(!$ids)$this->error('参数错误!');
        $CompanyDB = M('Company');

        if($CompanyDB->where('id in ('.$ids.')')->delete())
        {
             $this->assign("jumpUrl",U('/Admin/Company/index',array('eid' =>$eid,'p'=>$nowPage)));
             $this->success('删除成功！');
        }else{
                $this->error('删除失败!');
        }      
    }

    public function edit(){
        $CompanyDB = D("Company");
       
        if(isset($_POST['dosubmit'])) {         

            //根据表单提交的POST数据创建数据对象
            if($CompanyDB->create()){
                if($CompanyDB->save()){                	
                    $this->assign("jumpUrl",U('/Admin/Company/index/eid/$_GET["eid"]'));
                    $this->success('编辑成功！');
                }else{
                     $this->error('编辑失败!');
                }
            }else{
                $this->error($CompanyDB->getError());
            }
        }else{
            $id = $this->_get('id','intval',0);
            if(!$id)$this->error('参数错误!');
            $info = $CompanyDB->getCompany(array('id'=>$id));
        }
        $this->assign('eid',$info['eid']);

        $ExpoDB = D('Expo');   
        $expoName = $ExpoDB->where('id='.$info['eid'])->getField('name');

        $this->assign('expoName',$expoName);
        $this->assign('tpltitle','编辑');
        $this->assign('info',$info);
        $this->display('add');
        //echo  json_encode($info);
    }
    public function view()
    {
        $CompanyDB = D("Company");
        $id = $this->_get('id','intval',0);
        if(!$id)$this->error('参数错误!');
        $info = $CompanyDB->getCompany(array('id'=>$id));
        $ExpoDB = D('Expo');   
        $expoName = $ExpoDB->where('id='.$info['eid'])->getField('name');  
        $this->assign('expoName',$expoName);     
        $this->assign('info',$info);
        $this->display();
    }


	
}