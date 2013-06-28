<?php
/**
 * 后台用户管理模块
 * 
 */
class NewexpoAction extends AdminAction {
    public function _initialize() {
        parent::_initialize();  //RBAC 验证接口初始化
    }

/* ========用户部分======== */
    public function index(){     
       // return;
        import('ORG.Util.Page');// 导入分页类        
        $map = array();
        $NewExpoDB = D('Newexpo');
        $count = $NewExpoDB->where($map)->count();
        $Page       = new Page($count,C('web_admin_pagenum'));// 实例化分页类 传入总记录数

        // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
        $nowPage = isset($_GET['p'])?$_GET['p']:1;        
        $show       = $Page->show();// 分页显示输出
        $list = $NewExpoDB->where($map)->order('id ASC')->page($nowPage.','.C('web_admin_pagenum'))->select();
        $this->assign('role',$role);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出   
       
        //echo json_encode($list);
        if($_GET['s']=="1"){
            echo json_encode($list);
        }else{
             $this->display();
        }
       

    }    
    // 添加会展
    public function add(){
        $NewExpoDB = D("Newexpo");
        if(isset($_POST['dosubmit'])) {
            //根据表单提交的POST数据创建数据对象
            if($NewExpoDB->create()){
                if($NewExpoDB->add()){
                    $this->assign("jumpUrl",U('/Admin/NewExpo/index'));
                    $this->success('添加成功!');
                }else{
                     $this->error('添加失败!');
                }
            }else{
                $this->error($NewExpoDB->getError());
            }
        }else{
            $this->assign('tpltitle','添加');
            $this->display();
        }
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
        $id = $this->_get('id','intval',0);
        if(!$id)$this->error('参数错误!');
        $NewexpoDB = D('Newexpo');

        if($NewexpoDB->where('id='.$id)->delete())
        {
             $this->assign("jumpUrl",U('/Admin/Newexpo/index',array('eid' =>$eid,'p'=>$nowPage)));
             $this->success('删除成功！');
        }else{
                $this->error('删除失败!');
        }      
    }
    //删除会展
    public function batchdel(){
        $nowPage = isset($_GET['p'])?$_GET['p']:1;       
        $eid = $_GET['eid'];        
        $ids = $_GET['ids'];       
        if(!$ids)$this->error('参数错误!');
        $NewexpoDB = M('Newexpo');

        if($NewexpoDB->where('id in ('.$ids.')')->delete())
        {
             $this->assign("jumpUrl",U('/Admin/Newexpo/index',array('eid' =>$eid,'p'=>$nowPage)));
             $this->success('删除成功！');
        }else{
                $this->error('删除失败!');
        }      
    }
    
    public function edit(){
        $NewexpoDB = D("Newexpo");
        if(isset($_POST['dosubmit'])) {         

            //根据表单提交的POST数据创建数据对象
            if($NewexpoDB->create()){
                if($NewexpoDB->save()){
                    $this->assign("jumpUrl",U('/Admin/Newexpo/index'));
                    $this->success('编辑成功！');
                }else{
                     $this->error('编辑失败!');
                }
            }else{
                $this->error($NewexpoDB->getError());
            }
        }else{
            $id = $this->_get('id','intval',0);
            if(!$id)$this->error('参数错误!');
            $info = $NewexpoDB->getShow(array('id'=>$id));
        }

        $this->assign('tpltitle','编辑');
        $this->assign('info',$info);
        $this->display('add');
        //echo  json_encode($info);
    }


	
}