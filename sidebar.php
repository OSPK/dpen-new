<?php
/**
 * The Right Sidebar displayed on page templates.
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
?>
        <div class="col-md-4">
            <div class="well-lg sidebar-navbar">
                <?php
                if (function_exists('dynamic_sidebar')) {
                    dynamic_sidebar("sidebar-page");
                }
                ?>
            </div><!--/.well .sidebar-nav -->
        </div><!-- /.col-md-4 -->
