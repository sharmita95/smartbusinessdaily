<div class="post-detail-row">
  <div class="article-container">
		<?php do_action( 'thb_before_article' ); ?>
    <article itemscope itemtype="http://schema.org/Article" <?php post_class('post post-detail post-detail-style5 post-white-title'); ?> id="post-<?php the_ID(); ?>" data-id="<?php the_ID(); ?>" data-url="<?php the_permalink(); ?>">
			<?php do_action( 'thb_article_start' ); ?>
      <div class="post-over-title-container">
        <div class="row align-center">
          <div class="small-12 medium-10 large-8 columns">
            <div class="post-title-container">
    					<?php do_action( 'thb_categories', true ); ?>
    					<header class="post-title entry-header">
    						<h1 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h1>
    					</header>
    					<?php do_action('thb_article_after_h1'); ?>
    				</div>
          </div>
        </div>
				<?php do_action('thb_article_featured_image', 'full'); ?>
			</div>
			<?php do_action('thb_after_article_title'); ?>
      <div class="row">
        <div class="small-12 columns">
          <div class="post-share-center-container">
    		      <div class="post-share-container">
    						<?php do_action('thb_fixed_container'); ?>
    		        <div class="post-content-container">
                  <?php do_action('thb_ads_before_content'); ?>
    		          <div class="post-content entry-content" itemprop="articleBody">
                    <?php do_action('thb_before_article_content'); ?>
    		            <?php the_content(); ?>
                    <?php do_action('thb_after_article_content'); ?>
                    <?php get_template_part('inc/templates/post-detail-bits/readmore'); ?>
    								<?php get_template_part('inc/templates/post-detail-bits/source'); ?>
    		          </div>
                  <?php do_action('thb_ads_after_content'); ?>
    							<?php get_template_part('inc/templates/post-detail-bits/reviews'); ?>
    							<?php if (ot_get_option('article_subscribe', 'on') == 'on') { get_template_part('inc/templates/post-detail-bits/subscribe'); } ?>
    							<?php get_template_part('inc/templates/post-detail-bits/tags'); ?>
    							<?php get_template_part('inc/templates/post-detail-bits/reactions'); ?>
    							<?php get_template_part('inc/templates/post-detail-bits/author'); ?>
      						<?php do_action( 'thb_article_end' ); ?>
    		        </div>
    		      </div>
          </div>
        </div>
      </div>
    </article>
  </div>
	<div class="row">
		<div class="small-12 columns">
			<?php do_action( 'thb_after_article' ); ?>
			<?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
			<?php get_template_part('inc/templates/post-detail-bits/related'); ?>
		</div>
	</div>
  <?php if (wp_doing_ajax()) { do_action('thb_ads_after_article_ajax'); } else { do_action('thb_ads_after_article'); } ?>
</div>