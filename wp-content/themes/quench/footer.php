        </div>
        <footer id="footer" class="yahei clearfix"><div id="footer_in">
        	<p class="f_bq left" style="margin-top: 10px;">
        		<a style="cursor: pointer; text-decoration: underline;" target="_blank" href="http://www.miitbeian.gov.cn">【 粤ICP备19042669号-1 】</a>
        	</p>

			<p class="f_bq right"> <?php if($word_t2!=""){echo $word_t2;}else{echo '版权所有';}  ?> &copy;<?php echo date("Y"); echo " "; bloginfo('name'); 
if($icp_b !=="") {echo ' |   <a rel="nofollow" target="_blank" href="http://www.miitbeian.gov.cn/">'.$icp_b.'</a>'; };
echo ' |  <a class="banquan" target="_blank" href="http://www.2zzt.com">Powered by WordPress</a>'; ?> </p></div>
			<p class="left"><?php echo dopt('d_notice_bottom');?></p>
		</footer>
	</div>
	
	<img id="qrimg" src="http://qr.liantu.com/api.php?text=<?php global $wp;echo home_url(add_query_arg(array(),$wp->request));?>"/>
	<a id="qr" href="javascript:;"><i class="fa fa-qrcode"></i></a>
	<a id="gotop" href="javascript:;"><i class="fa fa-arrow-up"></i></a>
	
<?php 
if( dopt('d_track_b') != '' ) '<div class="static-hide">'.dopt('d_track').'</div>';
if( dopt('d_footcode_b') != '' ) echo dopt('d_footcode');

if( is_single() && dopt('d_sideroll_single_b') ){ 
	$sr_1 = dopt('d_sideroll_single_1');
	$sr_2 = dopt('d_sideroll_single_2');
}elseif( is_home() && dopt('d_sideroll_index_b') ){
	$sr_1 = dopt('d_sideroll_index_1');
	$sr_2 = dopt('d_sideroll_index_2');
}elseif(is_page() && dopt('d_sideroll_page_b')){
	$sr_1 = dopt('d_sideroll_page_1');
	$sr_2 = dopt('d_sideroll_page_2');
}else{
	$sr_1 = 2;
	$sr_2 = 4;
}
echo '<script>var asr_1 = '.$sr_1.',asr_2 = '.$sr_2.';</script>';

wp_footer();

?>  
<div style="display:none;">
<script src="https://s11.cnzz.com/z_stat.php?id=1256538499&web_id=1256538499" language="JavaScript"></script>
</div>
<?php include_once "baidu_js_push.php" ?>
</body>
</html>