<!-- Create a header in the default WordPress 'wrap' container -->
<div class="wrap">
    <div id="icon-plugins" class="icon32"></div>
    <h2>CTR Widget</h2>

    <h2 class="nav-tab-wrapper">
    <a target="_blank" href="" class='nav-tab nav-tab-active'><?php _e('General', 'ctr-widget'); ?></a>
    <a target="_blank" href="http://authoritywebsiteincome.com/ctrwidget/email" class='nav-tab'><?php _e('Email Integration', 'ctr-widget'); ?></a>
    <a target="_blank" href="http://authoritywebsiteincome.com/ctrwidget/easyadplacement" class='nav-tab'><?php _e('Easy Ad Placement', 'ctr-widget'); ?></a>
    <a target="_blank" href="http://authoritywebsiteincome.com/ctrwidget/splittesting" class='nav-tab'><?php _e('Split Testing', 'ctr-widget'); ?></a>
    <a target="_blank" href="http://authoritywebsiteincome.com/ctrwidget/socialmedia" class='nav-tab'><?php _e('Facebook &amp; Twitter Integration', 'ctr-widget'); ?></a>
    </h2>

    <form method="post" action="options.php">
        <?php
            settings_fields( 'ctr_widget' );
            do_settings_sections( 'ctr_widget' );
            // <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  /></p>
            echo '<p class="submit">';
            submit_button('Save Changes', 'primary', 'submit', false);
            echo ' <a href="http://authoritywebsiteincome.com/ctrwidget/pro" class="button">Upgrade to CTR Widget Pro</a>';
            echo '</p>';
        ?>
    </form>
    <p>CTR Widget by <a href="https://plus.google.com/106545056878915394778">Jon Haver</a> of <a href="http://authoritywebsiteincome.com/">AuthorityWebsiteIncome.com</a></p>
</div><!-- /.wrap -->
