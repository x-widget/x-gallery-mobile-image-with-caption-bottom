<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

widget_css();
if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];

if ( empty($_bo_table) ) jsAlert('Error: empty $_bo_table ? on widget :' . $widget_config['name']);

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 2;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);
?>

<div class='gallery_mobile_images_with_captions_bottom'>
<?php
	if ( $list ) {	
		foreach( $list as $li ) {			
?>
				<div class='container'>
					<div class='images_with_captions'>
						<div class='caption_image'>	
							<div class='inner'>
								<?						
								$imgsrc = x::post_thumbnail($_bo_table, $li['wr_id'], 193, 218);							
								if ( empty($imgsrc['src']) )  $imgsrc['src'] = x::url()."/widget/".$widget_config['name'].'/img/no-image.png';
															
								$img = "<img src='$imgsrc[src]'/>";						
								echo "<div class='img-wrapper'><a href='$li[url]'>".$img."</a></div>";
								?>
							</div>
						</div>
						<div class='caption'>
							<div class='subject'><a href='<?=$li['url']?>'><?=$li['subject']?></a></div>
							<div class='content'><a href='<?=$li['url']?>'><?=cut_str(strip_tags($li['wr_content']),220,"...")?></a></div>
						</div>
						<div style='clear:both'></div>
					</div>					
				</div>		
	<?
		}
	}
	else {
		for ( $i = 0; $i < 2; $i++ ) {?>
			<div class='container'>
					<div class='images_with_captions'>
						<div class='caption_image'>	
							<div class='inner'>
								<?						
															
								$imgsrc['src'] = x::url()."/widget/".$widget_config['name'].'/img/no-image.png';	
															
								$img = "<img src='$imgsrc[src]'/>";						
								echo "<div class='img-wrapper'><a href='".G5_BBS_URL."/write.php?bo_table=".$_bo_table."'>".$img."</a></div>";
								?>
							</div>
						</div>
						<div class='caption'>
							<div class='subject'><a href='<?=G5_BBS_URL?>/write.php?bo_table=<?=$_bo_table?>'>글을 등록해 주세요.</div>
							<div class='content'><a href='<?=G5_BBS_URL?>/write.php?bo_table=<?=$_bo_table?>'>글을 등록해 주세요.</a></div>
						</div>
						<div style='clear:both'></div>
					</div>					
				</div>		
	<?
		}
	}	
?>
	<div style='clear:both'></div>
</div>