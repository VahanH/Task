<?php
/**
 * Template Name: Home
 */
$args = array(
        'post_type' => 'nedvizhimost',
        'post_status’' => 'publish',
        'posts_per_page' => -1
);

$posts = new WP_Query($args);

get_header();
?>
<div class="page-container real-estate-wrap">
    <div id="real-estate-listing" class="main-content col-lg-8 col-md-8 real-estate-listing">
        <?php if ($posts->have_posts()) : ?>
            <?php while ($posts->have_posts()) : $posts->the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" class="real-estate-item">
                        <a href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) {?>
                                <div class="featured-image">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                </div>
                            <?php } ?>
                            <div class="info-price"></div>
                            <div class="meta">
                                    <h3 class="info-title"><?php the_title(); ?></h3>
                                    <div class="info-sizes">
                                        <?php
                                        $area = get_field( "area" );
                                        if( $area ) {?>
                                        <div class="info-size">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/size.svg" alt="">
                                                <?php echo $area . ' м²';?>
                                        </div>
                                        <?php } ?>
                                         <?php
                                        $living_area = get_field( "living_area" );
                                        if( $living_area ) {?>
                                        <div class="info-livesize">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/live-size.svg" alt="">
                                            <?php echo $living_area . ' м²';?>
                                        </div>
                                        <?php } ?>
                                          <?php
                                        $floor = get_field( "floor" );
                                        if( $floor ) {?>
                                        <div class="info-floor">
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/floor.svg" alt="">
                                            <?php echo $floor;?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                      <?php
                                        $address = get_field( "address" );
                                        if( $address ) {?>
                                    <div class="info-address">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/location.svg" alt="">
                                        <?php echo $address;?>
                                    </div>
                                    <?php } ?>
                                <?php
                                $price = get_field( "price" );
                                if( $price ) {?>
                                    <div class="info-price">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/price.svg" alt="">
                                        <?php echo '$' . number_format($price);?>
                                    </div>
                                <?php } ?>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
        <?php else: ?>
            <div class="no-real-estate">
                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'theme-domain'); ?></p>
            </div>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>
    <div class="sidebar-content col-lg-4 col-md-4 real-estate-sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
