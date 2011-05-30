<?php subView("header")?>
<?php subView("user_menu")?>
<div class="blog_title"><h3>裁剪图片</h3></div>
<script language="javascript" type="text/javascript" src="<?php echo baseUrl()?>/static/js/drag.js"></script>
<table width="100%" border="0">
	<tr>
		<td rowspan="2" valign="top">

		<form name="setavatar" id="setavatar" action="<?php echo siteUrl('user/avatar')?>"
			method="post" onsubmit="return getcutpos();">
			<input name="imgname" type="hidden" value="<?php echo $imgName?>" />
		<div id="cut_div"
			style="border: 2px solid #888888; width: 284px; height: 266px; overflow: hidden; position: relative; top: 0px; left: 0px; margin: 4px; cursor: pointer;">
		<table
			style="border-collapse: collapse; z-index: 10; filter: alpha(opacity = 75); position: relative; left: 0px; top: 0px; width: 284px; height: 266px; opacity: 0.75;"
			cellspacing="0" cellpadding="0" border="0" unselectable="on">
			<tr>
				<td style="background: #cccccc; height: 73px;" colspan="3"></td>
			</tr>
			<tr>
				<td style="background: #cccccc; width: 82px;"></td>
				<td style="border: 1px solid red; width: 120px; height: 120px;"></td>
				<td style="background: #cccccc; width: 82px;"></td>
			</tr>
			<tr>
				<td style="background: #cccccc; height: 73px;" colspan="3"></td>
			</tr>
		</table>
		<img id="cut_img" style="position: relative; top: -266px; left: 0px"
			src="<?php echo baseUrl()?>/static/upload/temp/<?php echo $imgName?>" /></div>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td><img style="margin-top: 5px; cursor: pointer;" src="<?php echo baseUrl()?>/static/images/avatar/_h.gif" alt="图片缩小"
					onmouseover=
						this.src = '<?php echo baseUrl()?>/static/images/avatar/_c.gif';
					onmouseout=
						this.src = '<?php echo baseUrl()?>/static/images/avatar/_h.gif';
					onclick=
						imageresize(false);
					/></td>
				<td>
				<img id="img_track" style="width:250px;height:18px; margin-top:5px" src="<?php echo baseUrl()?>/static/images/avatar/track.gif" /></td>
				<td><img style="margin-top: 5px; cursor: pointer;"
					src="<?php echo baseUrl()?>/static/images/avatar/hh.gif" alt="图片放大"
					onmouseover=
					this.src = '<?php echo baseUrl()?>/static/images/avatar/+c.gif';
				onmouseout=
					this.src = '<?php echo baseUrl()?>/static/images/avatar/+h.gif';
				onclick=
					imageresize(true);
/></td>
			</tr>
		</table>
		<img id="img_grip"
			style="position: absolute; z-index: 100; left: -1000px; top: -1000px; cursor: pointer;"
			src="<?php echo baseUrl()?>/static/images/avatar/grip.gif" />
		<div style="padding-top: 15px; padding-left: 5px;"><input
			type="hidden" name="action" id="action" value="cutsave" /> <input
			type="hidden" name="cut_pos" id="cut_pos" value="" /> <input
			type="submit" class="button" name="submit" id="submit"
			value=" 确认裁剪并提交 " /> &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="button" class="button" name="cancel" id="cancel" value=" 取消 " onclick="javascript: history.back(1);"/></div>
		</form>

		</td>
		
	</tr>
	
</table>


<script language="javascript" type="text/javascript">
	var cut_div; //裁减图片外框div
	var cut_img; //裁减图片
	var imgdefw; //图片默认宽度
	var imgdefh; //图片默认高度
	var offsetx = 82; //图片位置位移x
	var offsety = -193; //图片位置位移y
	var divx = 284; //外框宽度
	var divy = 266; //外框高度
	var cutx = 120; //裁减宽度
	var cuty = 120; //裁减高度
	var zoom = 1; //缩放比例

	var zmin = 0.1; //最小比例
	var zmax = 10; //最大比例
	var grip_pos = 5; //拖动块位置0-最左 10 最右
	var img_grip; //拖动块
	var img_track; //拖动条
	var grip_y; //拖动块y值
	var grip_minx; //拖动块x最小值
	var grip_maxx; //拖动块x最大值

	//图片初始化
	function imageinit() {
		cut_div = document.getElementById('cut_div');
		cut_img = document.getElementById('cut_img');
		imgdefw = cut_img.width;
		imgdefh = cut_img.height;
		if (imgdefw > divx) {
			zoom = divx / imgdefw;
			cut_img.width = divx;
			cut_img.height = Math.round(imgdefh * zoom);
		}

		cut_img.style.left = Math.round((divx - cut_img.width) / 2);
		cut_img.style.top = Math.round((divy - cut_img.height) / 2) - divy;

		if (imgdefw > cutx) {
			zmin = cutx / imgdefw;
		} else {
			zmin = 1;
		}
		zmax = zmin > 0.25 ? 8.0 : 4.0 / Math.sqrt(zmin);
		if (imgdefw > cutx) {
			zmin = cutx / imgdefw;
			grip_pos = 5 * (Math.log(zoom * zmax) / Math.log(zmax));
		} else {
			zmin = 1;
			grip_pos = 5;
		}

		Drag.init(cut_div, cut_img);
		cut_img.onDrag = when_Drag;
	}

	//图片逐步缩放
	function imageresize(flag) {
		if (flag) {
			zoom = zoom * 1.5;
		} else {
			zoom = zoom / 1.5;
		}
		if (zoom < zmin)
			zoom = zmin;
		if (zoom > zmax)
			zoom = zmax;
		cut_img.width = Math.round(imgdefw * zoom);
		cut_img.height = Math.round(imgdefh * zoom);
		checkcutpos();
		grip_pos = 5 * (Math.log(zoom * zmax) / Math.log(zmax));
		img_grip.style.left = (grip_minx + (grip_pos / 10 * (grip_maxx - grip_minx)))+ "px";
	}

	//获得style里面定位
	function getStylepos(e) {
		return {
			x : parseInt(e.style.left),
			y : parseInt(e.style.top)
		};
	}

	//获得绝对定位
	function getPosition(e) {
		var t = e.offsetTop;
		var l = e.offsetLeft;
		while (e = e.offsetParent) {
			t += e.offsetTop;
			l += e.offsetLeft;
		}
		return {
			x : l,
			y : t
		};
	}

	//检查图片位置
	function checkcutpos() {
		var imgpos = getStylepos(cut_img);

		max_x = Math.max(offsetx, offsetx + cutx - cut_img.clientWidth);
		min_x = Math.min(offsetx + cutx - cut_img.clientWidth, offsetx);
		if (imgpos.x > max_x)
			cut_img.style.left = max_x + 'px';
		else if (imgpos.x < min_x)
			cut_img.style.left = min_x + 'px';

		max_y = Math.max(offsety, offsety + cuty - cut_img.clientHeight);
		min_y = Math.min(offsety + cuty - cut_img.clientHeight, offsety);

		if (imgpos.y > max_y)
			cut_img.style.top = max_y + 'px';
		else if (imgpos.y < min_y)
			cut_img.style.top = min_y + 'px';
	}

	//图片拖动时触发
	function when_Drag(clientX, clientY) {
		checkcutpos();
	}

	//获得图片裁减位置
	function getcutpos() {
		var imgpos = getStylepos(cut_img);
		var x = offsetx - imgpos.x;
		var y = offsety - imgpos.y;
		var cut_pos = document.getElementById('cut_pos');
		cut_pos.value = x + ',' + y + ',' + cut_img.width + ','
				+ cut_img.height;
		return true;
	}

	//缩放条初始化
	function gripinit() {
		img_grip = document.getElementById('img_grip');
		img_track = document.getElementById('img_track');
		track_pos = getPosition(img_track);

		grip_y = track_pos.y;
		grip_minx = track_pos.x + 4;
		grip_maxx = track_pos.x + img_track.clientWidth - img_grip.clientWidth
				- 5;

		img_grip.style.left = (grip_minx + (grip_pos / 10 * (grip_maxx - grip_minx)))
				+ "px";
		img_grip.style.top = grip_y + "px";

		Drag.init(img_grip, img_grip);
		img_grip.onDrag = grip_Drag;

	}

	//缩放条拖动时触发
	function grip_Drag(clientX, clientY) {
		var posx = clientX;
		img_grip.style.top = grip_y + "px";
		if (clientX < grip_minx) {
			img_grip.style.left = grip_minx + "px";
			posx = grip_minx;
		}
		if (clientX > grip_maxx) {
			img_grip.style.left = grip_maxx + "px";
			posx = grip_maxx;
		}

		grip_pos = (posx - grip_minx) * 10 / (grip_maxx - grip_minx);
		zoom = Math.pow(zmax, grip_pos / 5) / zmax;
		if (zoom < zmin)
			zoom = zmin;
		if (zoom > zmax)
			zoom = zmax;
		cut_img.width = Math.round(imgdefw * zoom);
		cut_img.height = Math.round(imgdefh * zoom);
		checkcutpos();
	}

	//页面载入初始化
	function avatarinit() {
		imageinit();
		gripinit();
		//刷新裁剪后的图片
		//document.getElementById('cutimg_l').src = document.getElementById('cutimg_l').src+ '?' + (new Date().getTime());
		//document.getElementById('cutimg_m').src = document.getElementById('cutimg_m').src+ '?' + (new Date().getTime());
		//document.getElementById('cutimg_s').src = document.getElementById('cutimg_s').src+ '?' + (new Date().getTime());

	}

	if (document.all) {
		window.attachEvent('onload', avatarinit);
	} else {
		window.addEventListener('load', avatarinit, false);
	}
</script>
</div>
<?php subView("footer")?>