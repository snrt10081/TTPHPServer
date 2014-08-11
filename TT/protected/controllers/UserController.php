<?php
/**
 * Project: yiiim
 * File: UserController.php
 * User: 明心
 * Date: 14-8-4
 * Time: 下午5:09
 * Desc: 用户控制类
 */
 class UserController extends Controller{

     public function actionAdd(){

        if(Yii::app()->request->isPostRequest){

            $user = new IMUser();
            $data = Yii::app()->request->getPost('data');
            $user->attributes = $data;
            $user->pwd = md5($data['pwd']);
            $user->avatar = $this->upload('data[avatar]');
            $user->isDeleted = 0;
            $time = time();
            $user->status = $data['status'];
            $user->created = $time;
            $user->updated = $user->created;

            if($user->save())
            {
                echo '<div class="alert alert-success" role="alert">添加成功</div>';
                $this->getUserCache();
            }else{
                echo '<div class="alert alert-danger" role="alert">添加失败</div>';
            }
        }
         $departs = Yii::app()->cache->get('cache_depart');
         if(empty($departs))
         {
            $departs = $this->getDepartCache();
         }

         $this->render('add',array(
             'departs' => $departs,
         ));

     }

     /**
      * 用户列表
      */
     public function actionList($page = 1){

        $count = IMUser::model()->count();
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['perPage'];

        if(empty($page))
            $pager->currentPage = 1;

        $list = IMUser::model()->findAll(array(
            'order' => 'id DESC',
            'offset' => $pager->getCurrentPage()*$pager->getPageSize(),
            'limit' => $pager->pageSize,
        ));

        foreach($list as $v){
            $data[] = $v->attributes;
        }

        $this->render('list',array(
            'list' => $data,
            'pager' => $pager,
        ));

     }

    /**
     * 删除用户
     */
     public function actionDel($id){

         if(empty($id))
             return;


         $count = IMUser::model()->deleteByPk($id);
         if($count > 0){
             echo '<div class="alert alert-success" role="alert">添加成功</div>';
         }else{
             echo '<div class="alert alert-success" role="alert">添加成功</div>';
         }

     }

     /**
      * 修改用户信息
      */
     public function actionEdit($id){

         if(empty($id))
             return;
         $user = IMUser::model()->findByPk($id);

         if(Yii::app()->request->isPostRequest){

             $data = Yii::app()->request->getPost('data');

             $user->attributes = $data;

             if($user->pwd != $data['pwd'])
                $user->pwd = md5($data['pwd']);

             if($user->avatar != $data['avatar'])
                $user->avatar = $this->upload('data[avatar]');

             $user->departId = $data['departId'];
             $user->status = $data['status'];
             $time = time();
             $user->updated = $time;
             if($user->update()){
                 echo '<div class="alert alert-success" role="alert">修改成功</div>';
                 //更新用户之后更新用户缓存
                 $users = IMUser::model()->findAll(array(
                     'condition' => 'status = 1',
                 ));

                 foreach($users as $k => $v){
                     $cache[$k]['id'] = $v->id;
                     $cache[$k]['userId'] = $v->userId;
                     $cache[$k]['title'] = $v->title;
                     $cache[$k]['uname'] = $v->uname;
                 }

                 if(!empty($cache))
                     Yii::app()->cache->set('cache_user',$cache);
                 unset($cache);
             }else{
                 echo '<div class="alert alert-danger" role="alert">修改失败</div>';
             }
         }
         $departs = Yii::app()->cache->get('cache_depart');
         $this->render('add',array(
             'data' => $user,
             'departs' => $departs,
         ));
     }

 }