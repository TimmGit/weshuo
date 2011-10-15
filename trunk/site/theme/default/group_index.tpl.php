<?php subView("header")?>
<div id="main">
<div id="tag_header"></div>
<div id="group_main">
<?php 
foreach ($list as $v)
{
	?>
    <div class='group_div'><a href="<?php echo siteUrl('group/'.$v['groupName'])?>"><img border=0 src="<?php echo baseUrl().'static/upload/group/'.$v['icon']?>"></a>
	<a href="<?php echo siteUrl('group/'.$v['groupName'])?>"><h2><?php echo $v['groupName']?></h2></a>
    <div class="clear"></div>
    <div class="memo"><?php echo $v['memo']?></div>
    <div class="count"><span><?php echo $v['count']?></span>个回应</div>
    </div>
    <?php
}
?>
<div class="clear"></div>
<div><?php echo $page?></div>
</div>
<div id="tag_footer"></div>
</div>
<?php subView("footer")?>
