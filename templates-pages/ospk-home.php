<?php
/**
 * Template Name: OSPK - Home
 * Description: Displays page title and content in Hero section above 3 widgets.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
get_header(); ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="top" class="jumbotron">
          <div id="top2" class="jumboplanet">
              <div class="container">
                  <h1><?php echo get_bloginfo ( 'name' );?></h1>
                  <h2><?php echo get_bloginfo ( 'description' );  ?></h2>
                  <p><a class="btn btn-primary btn-lg">Find a Project <i class="icon-arrow-right"></i></a></p>
                  <p><a data-toggle="modal" href="#myModal" class="btn btn-primary">How does it work?</a></p>
              </div><!--./container-->
          </div><!--./top2-->
        </div><!--/.jumbotron -->

    <?php endwhile; endif; ?>

    <div class="container">

        <div class="row ospkwidgets">
                <div class="col-md-6">
                  <div class="circular"><i class="icon-group icon-3x"></i>
                  </div>
                    <div class="widgetleft clearfix">
                      <?php
                      if (function_exists('dynamic_sidebar')) {
                          dynamic_sidebar("ospk-left");
                      } ?>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="circular"><i class="icon-rocket icon-3x"></i>
                  </div>
                    <div class="widgetright clearfix">
                        <?php
                        if (function_exists('dynamic_sidebar')) {
                            dynamic_sidebar("ospk-right");
                        } ?>
                    </div>
                </div>
        </div><!--/.row -->

          <!-- Modal -->
          <div class="modal modality fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">How does it work?</h4>
                </div>
                <div class="modal-body">


                  <div id="slideshow" class="carousel slide">
                    <ol class="carousel-indicators">
                      <li data-target="#slideshow" data-slide-to="0" class="active"></li>
                      <li data-target="#slideshow" data-slide-to="1"></li>
                      <li data-target="#slideshow" data-slide-to="2"></li>
                      <li data-target="#slideshow" data-slide-to="3"></li>
                      <li data-target="#slideshow" data-slide-to="4"></li>
                    </ol>

                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/stock1.jpg">
                        <div class="carousel-caption">
                          Amazing photos provided by
                        </div>
                      </div>
                      <div class="item">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/stock2.jpg">
                        <div class="carousel-caption">
                          Boat in Water
                        </div>
                      </div>
                      <div class="item">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/stock3.jpg">
                        <div class="carousel-caption">
                          Millennium Bridge in London
                        </div>
                      </div>
                      <div class="item">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/stock4.jpg">
                        <div class="carousel-caption">
                          Blurs
                        </div>
                      </div>
                      <div class="item">
                        <img src="<?php bloginfo('template_directory'); ?>/assets/img/stock5.jpg">
                        <div class="carousel-caption">
                          Santorini Greece
                        </div>
                      </div>
                    </div>

                    <a class="left carousel-control" href="#slideshow" data-slide="prev">
                      <span class="glyphicon"><i class="icon-arrow-left"></i></span>
                    </a>
                    <a class="right carousel-control" href="#slideshow" data-slide="next">
                      <i class="icon-arrow-right"></i>
                    </a>
                  </div> <!-- #slideshow -->


              </div><!--/.modalbody-->

              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

      <div class="sect-border"></div>

        <div class="container">
          <div class="row content frontpage-content">
              <?php the_content(); ?>
          </div>
        </div>
    </div><!--Container-->

<?php get_footer(); ?>