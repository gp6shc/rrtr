<?php
/*
Plugin Name: J.B.Market Weather Widget
Description: J.B.Market Weather Widget for WordPress
Version: 2.0
Author: J.B.Market (support@jbmarket.net)
License: GPL2 or later
*/

/*  Copyright 2012  J.B.Market  (email : support@jbmarket.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class JBWeatherWidget extends WP_Widget {
   
    function JBWeatherWidget() {
        defined ("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
        
        $widget_options = array(
            "classname"   => "JBWeatherWidget",
            "description" => "J.B.Weather Widget 2.0 for WordPress"
        );
        
        parent::WP_Widget("jbweatherwidget", "J.B.Weather Widget", $widget_options);
        
        if (is_active_widget(false, false, $this->id_base)) {
            // now enqueued into sass
            //wp_enqueue_style("jbweather_style", plugins_url("jbweather/css/style.css", __FILE__));
            //wp_enqueue_style("jbweather_ui_style", plugins_url("jbweather/css/blitzer/jquery-ui-1.8.23.custom.css", __FILE__));
            //wp_enqueue_script("jbweather_scripts", plugins_url("jbweather/js/jbweather.js", __FILE__), array("jquery", "jquery-ui-autocomplete"));
        }
    }

    /* UI */
    function widget($args, $instance) {
        extract( $args, EXTR_SKIP );
        
        $title = $instance["title"] ? $instance["title"] : "";
        ?>
            <?php echo $before_widget; ?>
            <?php echo $before_title . $title . $after_title; ?>

            <?php $unique = $this->unique(); ?>

            <div class="<?php echo $unique; ?>">
                <?php echo $this->getBody(); ?>
            </div>

            <?php echo $this->initScript( $instance, $unique ); ?>

            <?php echo $after_widget; ?>
        <?php
    }
    
    /* Form (parameters) */
    function form($instance) {
        ?>

        <p>
            <label for="<?php echo $this->get_field_id("title"); ?>">
                Title:
                <input    id="<?php echo $this->get_field_id("title"); ?>"
                        name="<?php echo $this->get_field_name("title"); ?>"
                       value="<?php echo isset($instance["title"]) ? esc_attr($instance["title"]) : ""; ?>"
                       class="widefat"
                />
            </label>
        </p>
            
        <p>
            <label for="<?php echo $this->get_field_id("apiKey"); ?>">
                API Key:
                <input    id="<?php echo $this->get_field_id("apiKey"); ?>"
                        name="<?php echo $this->get_field_name("apiKey"); ?>"
                       value="<?php echo isset($instance["apiKey"]) ? esc_attr($instance["apiKey"]) : ""; ?>"
                       class="widefat"
                />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id("width"); ?>">
                Widget width (in pixels):
                <input    id="<?php echo $this->get_field_id("width"); ?>"
                        name="<?php echo $this->get_field_name("width"); ?>"
                       value="<?php echo isset($instance["width"]) ? esc_attr($instance["width"]) : "280"; ?>"
                       class="widefat"
                />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id("basicColor"); ?>">
                Widget basic color:
                <input    id="<?php echo $this->get_field_id("basicColor"); ?>"
                        name="<?php echo $this->get_field_name("basicColor"); ?>"
                       value="<?php echo isset($instance["basicColor"]) ? esc_attr($instance["basicColor"]) : ""; ?>"
                       class="widefat"
                />
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id("location"); ?>">
                Location:
                <input    id="<?php echo $this->get_field_id("location"); ?>"
                        name="<?php echo $this->get_field_name("location"); ?>"
                       value="<?php echo isset($instance["location"]) ? esc_attr($instance["location"]) : ""; ?>" 
                       class="widefat"
                />
            </label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id("autoDetect"); ?>">
                Auto detect:
                <select id="<?php echo $this->get_field_id("autoDetect"); ?>" name="<?php echo $this->get_field_name("autoDetect"); ?>" class="widefat">
                    <option <?php echo isset($instance["autoDetect"]) && $instance["autoDetect"] == "1" ? "selected" : ""; ?> value="1">Yes</option>
                    <option <?php echo isset($instance["autoDetect"]) && $instance["autoDetect"] == "0" ? "selected" : ""; ?> value="0">No</option>
                </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id("degreesUnits"); ?>">
                Degree Units:
                <select id="<?php echo $this->get_field_id("degreesUnits"); ?>" name="<?php echo $this->get_field_name("degreesUnits"); ?>" class="widefat">
                    <option <?php echo isset($instance["degreesUnits"]) && $instance["degreesUnits"] == "C" ? "selected" : ""; ?> value="C">Celsius</option>
                    <option <?php echo isset($instance["degreesUnits"]) && $instance["degreesUnits"] == "F" ? "selected" : ""; ?> value="F">Fahrenheit</option>
                </select>
            </label>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id("windUnits"); ?>">
                Wind Units:
                <select id="<?php echo $this->get_field_id("windUnits"); ?>" name="<?php echo $this->get_field_name("windUnits"); ?>" class="widefat">
                    <option <?php echo isset($instance["windUnits"]) && $instance["windUnits"] == "K" ? "selected" : ""; ?> value="K">Kilometers</option>
                    <option <?php echo isset($instance["windUnits"]) && $instance["windUnits"] == "M" ? "selected" : ""; ?> value="M">Miles</option>
                </select>
            </label>
        </p>
        
        
        <p>
            <label for="<?php echo $this->get_field_id("curl"); ?>">
                Use cURL:
                <select id="<?php echo $this->get_field_id("curl"); ?>" name="<?php echo $this->get_field_name("curl"); ?>" class="widefat">
                    <option <?php echo isset($instance["curl"]) && $instance["curl"] == "1" ? "selected" : ""; ?> value="1">Yes</option>
                    <option <?php echo isset($instance["curl"]) && $instance["curl"] == "0" ? "selected" : ""; ?> value="0">No</option>
                </select>
            </label>
        </p>
        
        <?php
    }
    
    private function getBody() {
        include(dirname(__FILE__) . DS . "jbweather" . DS . "view" . DS . "tmpl.php");
    }
    
    private function initScript($instance, $unique) {
        
        if ($instance['autoDetect'] == 1) :
            $instance["location"] = $this->getUserIP();
        endif;
        
        $instance['url'] = plugin_dir_url(__FILE__) . "jbweather";
        
        foreach ($instance as $opt => $value):
            $params[] = '"'.$opt.'":"' . $value . '"';
        endforeach;
        $params = implode(',', $params);

        echo "
            <script type='text/javascript'>
            
                jQuery(document).ready(function(){
                    var JBW = new JBWeather('".$unique."');
                    JBW.init({{$params}});
                });
            </script>
        ";
    }
    
    private function unique() {
        $valid_chars = "QWERTYUIOPASDFGHJKLZXCVBNM";
        $length = 5;
        $unique = "";
        $num_valid_chars = strlen($valid_chars);
        for ($i = 0; $i < $length; $i++) {
            $random_pick = mt_rand(1, $num_valid_chars);
            $random_char = $valid_chars[$random_pick - 1];
            $unique .= $random_char;
        }
        return $unique;
    }
    
    private function getUserIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        } return $ip;
    }
}

/* Register Widget */
function JBWeatherWidget_init() {
    register_widget("JBWeatherWidget");
}
add_action("widgets_init", "JBWeatherWidget_init");