<?php 
/*
Template Name: 归档页面
*/

get_header(); 

?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<article <?php post_class('box'); ?>>
    <header class="entry-header">
		<h2 class="entry-name">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h2>
		<ul class="entry-meta">
			<li><i class="fa fa-clock-o"></i> <?php the_time('d,m,Y');?></li>
			<li><i class="fa fa-comments-o"></i> <?php comments_popup_link('0 吐槽', '1 吐槽', '% 吐槽'); ?></li>
			<li><i class="fa fa-eye"></i> <?php mzw_post_views(' 浏览');?></li>
		</ul>
    </header>
    <div class="entry-content" itemprop="description">
        <div class="archives">
        <?php
        $previous_year = $year = 0;
        $previous_month = $month = 0;
        $ul_open = false;

        $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');

        foreach($myposts as $post) :
            setup_postdata($post);

            $year = mysql2date('Y', $post->post_date);
            $month = mysql2date('n', $post->post_date);
            $day = mysql2date('j', $post->post_date);

            if($year != $previous_year || $month != $previous_month) :
                if($ul_open == true) : 
                    echo '</ul>';
                endif;

                echo '<h3 class="m-title">'; echo the_time('Y-m'); echo '</h3>';
                echo '<ul class="archives-monthlisting">';
                $ul_open = true;

            endif;

            $previous_year = $year; $previous_month = $month;
        ?>
            <li style="background: none;">
                 <a href="<?php the_permalink(); ?>"><span><?php the_time('Y-m-j'); ?></span>
               <div class="atitle"><?php the_title(); ?></div></a>

            </li>
        <?php endforeach; ?>
        </ul>
    </div>
    </div>
	<footer class="entry-footer clearfix">
		<div class="post-share">
			<a href="javascript:;"><i class="fa fa-share-alt"></i><?php _e('share', 'quench');?></a>
			<ul>
				<li><a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="fa fa-qq"></i></a></li>
				<li><a href="http://service.weibo.com/share/share.php?title=<?php the_title(); ?>&url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-weibo"></i></a></li>
				<li><a href="http://share.renren.com/share/buttonshare?link=<?php the_permalink(); ?>&title=<?php the_title(); ?>" target="_blank"><i class="fa fa-renren"></i></a></li>
				<li><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			</ul>
		</div>
		<div class="post-love">
			<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite post-love-link <?php if(isset($_COOKIE['mzw_ding_'.$post->ID])) echo ' done';?>" title="Love this">
			<span class="love-count">
				<?php if( get_post_meta($post->ID,'mzw_ding',true) ){            
                    echo get_post_meta($post->ID,'mzw_ding',true);
                 } else {
                    echo '0';
                 }?>
			</span> <i class="fa fa-heart-o"></i></a>
		</div>
	</footer>
</article>
	
<?php endwhile; endif;?>
</div></div>
	<?php get_sidebar(); ?>
<?php get_footer(); ?>