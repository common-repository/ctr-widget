<?php

class CTRWidgetHandler
{
    private $sidebar  = '';

    public function __construct()
    {
        if (!is_admin()) {
            $option = get_option('ctr_widget');
            $this->sidebar = $option['sidebar'];

            add_action( 'plugins_loaded', array( $this, 'add_widget' ) );
            add_action( 'widgets_init', array( $this, 'register_widget' ) );
            add_action( 'shutdown', array( $this, 'unregister_widget' ) );
            add_action( 'wp_head', array( $this, 'style_widget' ) );
        }
    }

    public function add_widget()
    {
        $this->remove_widget();
        // Adds widget to sidebar
        $widgets = get_option('sidebars_widgets');
        if (!array_key_exists($this->sidebar, $widgets)) {
            return;
        }
        $position = count($widgets[$this->sidebar]);
        $widgets[$this->sidebar][$position] = 'ctr_widget-2';
        update_option( 'sidebars_widgets', $widgets );

        $widget = array(2 => array(), '_multiwidget' => 1);
        update_option( 'widget_ctr_widget', $widget );
    }

    public function register_widget()
    {
        register_widget( "CTR_WP_Widget" );
    }

    public function unregister_widget()
    {
        // Remove widget from sidebar
        $this->remove_widget();
        delete_option( 'widget_ctr_widget' );
        unregister_widget( 'CTR_WP_Widget' );
    }

    private function remove_widget()
    {
        // For safety it makes sure all instances are gone
        $widgets = get_option('sidebars_widgets');
        if (!array_key_exists($this->sidebar, $widgets)) {
            return;
        }

        foreach($widgets[$this->sidebar] as $key => $value) {
            if ($value == 'ctr_widget-2') {
                unset($widgets[$this->sidebar][$key]);
            }
        }
        update_option( 'sidebars_widgets', $widgets );
    }

    public function style_widget()
    {
        $option = get_option('ctr_widget');
        echo "<style type=\"text/css\" media=\"screen\">\n";
        if ($option['align'] == 'Right')
            echo ".widget_ctr_widget { text-align: right; }\n";
        if ($option['align'] == 'Center')
            echo ".widget_ctr_widget { text-align: center; }\n";
        echo "</style>\n";
    }
}


class CTR_WP_Widget extends WP_Widget
{
    public function __construct() {
        parent::__construct(
            'ctr_widget',
            'CTR Widget',
            array( 'description' => __( 'CTR Widget', 'ctr-widget' ), )
        );
    }

    public function widget( $args, $instance ) {
        extract( $args );
        echo '<div id="ctr_widget-2-catch"></div>';
        echo $before_widget;
        $option = get_option('ctr_widget');
        echo $option['widget_html'];
        echo $after_widget;
    }
}

$CTRWidgetHandler = new CTRWidgetHandler;
