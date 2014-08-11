<?php
/**
 * Project: yiiim
 * File: list.php
 * User: 明心
 * Date: 14-8-5
 * Time: 下午4:04
 * Desc: 
 */
?>
<html>

<body>
用户列表页面
<table class="table">
    <thead>
    <tr>
        <td>ID</td>
        <td>用户标题</td>
        <td>用户名</td>
        <td>花名</td>
        <td>部门ID</td>
        <td>性别</td>
        <td>手机</td>
        <td>工号</td>
        <td>邮箱</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    </thead>
<?php
    foreach($list as $k => $v){
?>
    <tr>
        <td><?php echo $v['id'];?></td>
        <td><?php echo $v['title'];?></td>
        <td><?php echo $v['uname'];?></td>
        <td><?php echo $v['nickName'];?></td>
        <td><?php echo $v['departId'];?></td>
        <td><?php echo $v['sex'];?></td>
        <td><?php echo $v['telphone'];?></td>
        <td><?php echo $v['jobNumber'];?></td>
        <td><?php echo $v['mail'];?></td>
        <td><?php echo $this->showStatus($v['status']);?></td>
        <td>
            <a href="/user/edit/<?php echo $v['id'];?>"><button type="button" class="btn btn-info">修改</button></a>

        </td>
    </tr>
<?php
    }
?>
<?php
    $this->widget('MyPager',array(
        'header'=>'',
        'firstPageLabel' => '首页',
        'lastPageLabel' => '末页',
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
        'pages' => $pager,
        'maxButtonCount'=>8
    ));
?>
</table>
</body>
</html>