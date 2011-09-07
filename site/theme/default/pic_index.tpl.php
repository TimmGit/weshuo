<?php subView("header")?>
<link href="<?php echo baseUrl('/static/fancybox/jquery.fancybox-1.2.6.css')?>" rel="stylesheet" type="text/css" />
<link href="<?php echo baseUrl('/static/fancybox/jquery-ui.css')?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo baseUrl('/static/fancybox/jquery-ui.min.js')?>"></script>
<script type="text/javascript" src="<?php echo baseUrl('/static/fancybox/jquery.fancybox-1.2.6.pack.js')?>"></script>
<script type="text/javascript" src="<?php echo baseUrl('/static/fancybox/script.js')?>"></script>
<style type="text/css">
.pic, .pic a{
	/* Each picture and the hyperlink inside it */
	width:100px;
	height:100px;
	overflow:hidden;
}
.pic{
	/* Styles specific to the pic class */
	position:absolute;
	border:5px solid #EEEEEE;
	border-bottom:18px solid #eeeeee;
	/* CSS3 Box Shadow */
	-moz-box-shadow:2px 2px 3px #333333;
	-webkit-box-shadow:2px 2px 3px #333333;
	box-shadow:2px 2px 3px #333333;
}

.pic a{
	/* Specific styles for the hyperlinks */
	text-indent:-999px;
	display:block;
	/* Setting display to block enables advanced styling for links */
}
</style>
<div style="clear:both"></div>
<div id="images" >
	<?php 
	foreach ($plist as $v)
	{
		echo $v;
	}
	?>
</div>
<div class="clear"></div>
<?php subView("footer")?>