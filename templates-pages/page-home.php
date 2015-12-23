<?php
/**
 * Template Name: Page - Home Hero
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); ?>

<div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="jumbotron">
                <h1><?php the_title();?></h1>
                <h2><?php echo get_bloginfo ( 'description' );  ?></h2>
        </div><!--/.hero-unit -->

    <?php endwhile; endif; ?>

        <div class="row">
                <div class="col-md-4">
                    <?php
                    if (function_exists('dynamic_sidebar')) {
                        dynamic_sidebar("home-left");
                    } ?>
                </div>
                <div class="col-md-4">
                    <?php
                    if (function_exists('dynamic_sidebar')) {
                        dynamic_sidebar("home-middle");
                     } ?>
                </div>
                <div class="col-md-4">
                    <?php
                    if (function_exists('dynamic_sidebar')) {
                        dynamic_sidebar("home-right");
                    } ?>
                </div>
        </div><!--/.row -->

        <div class="row content frontpage-content">
            <?php the_content(); ?>
        </div>
</div><!--/.container -->

<?php get_footer(); ?>