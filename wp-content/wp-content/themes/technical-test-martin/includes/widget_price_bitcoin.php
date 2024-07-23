<?php

class Bitcoin_Price_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'bitcoin_price_widget',
            __('Bitcoin Price Widget', 'theme_text_domain'),
            array('description' => __('Displays the current Bitcoin price in various currencies', 'theme_text_domain'))
        );
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        $prices = $this->get_bitcoin_prices();
        echo '<div class="p-4  rounded-lg  min-h-full  z-20">';
        if (!empty($prices)) {
            foreach ($prices as $currency => $price) {
                echo '<p class="text-lg font-semibold mb-2 text-black">Current Bitcoin Price in ' . esc_html($currency) . ': <span class="font-thin">'  . esc_html($price) . '</span></p>';
            }
        } else {
            echo '<p class="text-red-500">Unable to fetch Bitcoin prices.</p>';
        }
        echo '</div>';
        echo $args['after_widget'];
    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : __('Bitcoin Price', 'theme_text_domain');
?>
        <p>
            <label class="text-black border-gray-300 rounded-md shadow-sm" for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'theme_text_domain'); ?></label>
            <input class="widefat text-black border-gray-300 rounded-md shadow-sm" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

    private function get_bitcoin_prices()
    {
        $response = wp_remote_get('https://mempool.space/api/v1/prices');
        if (is_array($response) && !is_wp_error($response)) {
            $body = json_decode($response['body'], true);
            $prices = array();
            if (isset($body['USD'])) {
                $prices['USD'] = $this->format_currency($body['USD'], 'USD');
            }
            if (isset($body['EUR'])) {
                $prices['EUR'] = $this->format_currency($body['EUR'], 'EUR');
            }
            if (isset($body['GBP'])) {
                $prices['GBP'] = $this->format_currency($body['GBP'], 'GBP');
            }
            if (isset($body['CAD'])) {
                $prices['CAD'] = $this->format_currency($body['CAD'], 'CAD');
            }
            if (isset($body['CHF'])) {
                $prices['CHF'] = $this->format_currency($body['CHF'], 'CHF');
            }
            if (isset($body['AUD'])) {
                $prices['AUD'] = $this->format_currency($body['AUD'], 'AUD');
            }
            if (isset($body['JPY'])) {
                $prices['JPY'] = $this->format_currency($body['JPY'], 'JPY');
            }
            return $prices;
        }
        return array();
    }

    private function format_currency($amount, $currency)
    {
        $currency_symbols = array(
            'USD' => '$',
            'EUR' => '€',
            'GBP' => '£',
            'CAD' => 'C$',
            'CHF' => 'CHF',
            'AUD' => 'A$',
            'JPY' => '¥',
        );

        $symbol = isset($currency_symbols[$currency]) ? $currency_symbols[$currency] : '';
        return $symbol . number_format($amount, 2, '.', ',');
    }
}
