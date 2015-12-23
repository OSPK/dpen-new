<?php
/**
 * Default Footer
 *
 * @package WordPress
 * @subpackage BootstrapWP
 */
?>
</div><!--./contentwrapper-->
        <footer>
            <div class="footer row">
                <div class="col-md-12">
                    <?php
                    if (function_exists('dynamic_sidebar')) {
                        dynamic_sidebar("footer-content");
                    } ?>
                </div><!--col 12-->
            </div><!-- /footer row -->
        </footer>
        <?php wp_footer(); ?>
        <script type="text/javascript">
        $('#top').mousemove(function(e){
                var amountMovedX = (e.pageX * -1 / 15);
                var amountMovedY = (e.pageY * -1 / 19);
                $(this).css('background-position', amountMovedX + 'px ' + amountMovedY + 'px');
            });
        </script>
    </body>
</html>