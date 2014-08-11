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
群组列表页面
<table class="table">
    <thead>
    <tr>
        <td>GroupId</td>
        <td>群名称</td>
        <td>群头像</td>
        <td>群描述</td>
        <td>创建者ID</td>
        <td>群组类型</td>
        <td>成员人数</td>
        <td>创建时间</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    </thead>
<?php
    foreach($list as $k => $v){
?>
    <tr>
        <td><?php echo $v['groupId'];?></td>
        <td><?php echo $v['groupName'];?></td>
        <td><?php echo $v['avatar'];?></td>
        <td><?php echo $v['adesc'];?></td>
        <td><?php echo $v['createUserId'];?></td>
        <td><?php echo $this->groupType($v['groupType']);?></td>
        <td><?php echo $v['memberCnt'];?></td>
        <td><?php echo date('Y-m-d',$v['created']);?></td>
        <td><?php echo $this->showStatus($v['status']);?></td>
        <td>
            <a href="/group/edit/<?php echo $v['groupId'];?>"><button type="button" class="btn btn-info">修改</button></a>

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