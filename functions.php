<?php

// MENU
function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'footer-menu' => __('Footer Menu')
        )
    );
}
add_action('init', 'register_my_menus');

function styles()
{
    wp_enqueue_style(
        'bootstrap-css',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css',
        array(),
        '5.3.0'
    );

    wp_enqueue_style(
        'my-theme-custom-style',
        get_template_directory_uri() . '/style.css',
        array(),
        '1.0.0',
        'all'
    );

    wp_enqueue_script(
        'bootstrap-js',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js',
        array('jquery'),
        '5.3.0',
        true
    );

    add_theme_support('woocommerce');
    // NEWSLETTER
    wp_enqueue_script('newsletter-script', get_template_directory_uri() . '/js/newsletter.js', ['jquery'], null, true);
    wp_localize_script('newsletter-script', 'newsletterAjax', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action('wp_enqueue_scripts', 'styles');

// Add WooCommerce support  
function theme_add_woocommerce_support()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'theme_add_woocommerce_support');
// Add REST API keys to JavaScript  
function add_wc_api_js_variables()
{
    if (is_page('products') || is_shop()) {
?>
        <script type="text/javascript">
            var wc_api = {
                url: '<?php echo esc_url_raw(rest_url('wc/v3/')); ?>',
                consumer_key: '<?php echo esc_js(get_option('ck_f5d8deff64ccc2b212ac0bccbef080cf01d83dcf')); ?>',
                consumer_secret: '<?php echo esc_js(get_option('cs_43aaddf2a71885419fac899add730358422d23df')); ?>'
            };
        </script>
<?php
    }
}
add_action('wp_head', 'add_wc_api_js_variables');








// AJAX handler for product details  
function get_ajax_product_details()
{
    check_ajax_referer('product_details_nonce', 'nonce');

    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    if ($product_id) {
        $product = wc_get_product($product_id);
        if ($product) {
            // Get product gallery images  
            $gallery_images = array();
            $attachment_ids = $product->get_gallery_image_ids();

            if ($attachment_ids) {
                foreach ($attachment_ids as $attachment_id) {
                    $gallery_images[] = wp_get_attachment_url($attachment_id);
                }
            }

            // Get categories  
            $categories = array();
            $terms = get_the_terms($product_id, 'product_cat');
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $categories[] = $term->name;
                }
            }

            // Get tags  
            $tags = array();
            $terms = get_the_terms($product_id, 'product_tag');
            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                    $tags[] = $term->name;
                }
            }

            wp_send_json_success(array(
                'id' => $product->get_id(),
                'name' => $product->get_name(),
                'price' => $product->get_price_html(), // This returns formatted price  
                'regular_price' => $product->get_regular_price(),
                'sale_price' => $product->get_sale_price(),
                'description' => $product->get_description(),
                'short_description' => $product->get_short_description(),
                'sku' => $product->get_sku(),
                'stock_status' => $product->get_stock_status(),
                'stock_quantity' => $product->get_stock_quantity(),
                'image' => get_the_post_thumbnail_url($product_id, 'full'),
                'gallery_images' => $gallery_images,
                'categories' => $categories,
                'tags' => $tags,
                'add_to_cart_url' => $product->add_to_cart_url(),
                'is_on_sale' => $product->is_on_sale(),
                'is_in_stock' => $product->is_in_stock()
            ));
        }
    }

    wp_send_json_error('Product not found');
}
add_action('wp_ajax_get_product_details', 'get_ajax_product_details');
add_action('wp_ajax_nopriv_get_product_details', 'get_ajax_product_details');







// Enqueue AOS
function your_theme_enqueue_scripts()
{
    // Enqueue AOS CSS
    wp_enqueue_style(
        'aos-css',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
        array(),
        '2.3.4'
    );

    // Enqueue AOS JS
    wp_enqueue_script(
        'aos-js',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
        array(),
        '2.3.4',
        true // Load in footer
    );

    // Enqueue Custom JS
    wp_enqueue_script(
        'your-theme-custom-js',
        get_template_directory_uri() . '/js/custom.js',
        array('aos-js'), // Ensure 'aos-js' loads before your script
        '1.0.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'your_theme_enqueue_scripts');





// addons
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/product-addons/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_product_addons',
        'permission_callback' => '__return_true',
    ));
});

// SANS IMAGES
// function get_product_addons($data)
// {
//     global $wpdb;

//     $product_id = intval($data['id']);

//     // Fetch addon groups associated with the product
//     $groups = $wpdb->get_results($wpdb->prepare("
//         SELECT g.id, g.title as group_title
//         FROM {$wpdb->prefix}product_addon_groups g
//         JOIN {$wpdb->prefix}product_addon_relationships r ON g.id = r.group_id
//         WHERE r.product_id = %d
//     ", $product_id));

//     $addons = array();

//     foreach ($groups as $group) {
//         $fields = $wpdb->get_results($wpdb->prepare("
//             SELECT f.id, f.label, f.type
//             FROM {$wpdb->prefix}product_addon_fields f
//             WHERE f.group_id = %d
//         ", $group->id));

//         foreach ($fields as $field) {
//             $options = $wpdb->get_results($wpdb->prepare("
//                 SELECT o.id, o.label, o.price
//                 FROM {$wpdb->prefix}product_addon_options o
//                 WHERE o.field_id = %d
//             ", $field->id));

//             $field->options = $options;
//         }

//         $group->fields = $fields;
//         $addons[] = $group;
//     }

//     return $addons;
// }





// AVEC IMAGES
// function get_product_addons($data)
// {
//     global $wpdb;

//     $product_id = intval($data['id']);

//     // Fetch addon groups associated with the product
//     $groups = $wpdb->get_results($wpdb->prepare("
//         SELECT g.id, g.title as group_title
//         FROM {$wpdb->prefix}product_addon_groups g
//         JOIN {$wpdb->prefix}product_addon_relationships r ON g.id = r.group_id
//         WHERE r.product_id = %d
//     ", $product_id));

//     $addons = array();

//     foreach ($groups as $group) {
//         $fields = $wpdb->get_results($wpdb->prepare("
//             SELECT f.id, f.label, f.type
//             FROM {$wpdb->prefix}product_addon_fields f
//             WHERE f.group_id = %d
//         ", $group->id));

//         foreach ($fields as $field) {
//             $options = $wpdb->get_results($wpdb->prepare("
//                 SELECT o.id, o.label, o.price, o.visual_value as image
//                 FROM {$wpdb->prefix}product_addon_options o
//                 WHERE o.field_id = %d
//             ", $field->id));

//             $field->options = $options;
//         }

//         $group->fields = $fields;
//         $addons[] = $group;
//     }

//     return $addons;
// }


add_action('woocommerce_process_product_meta', 'save_product_addons_meta');
function save_product_addons_meta($post_id)
{
    if (isset($_POST['product_addons'])) {
        update_post_meta($post_id, '_product_addons', $_POST['product_addons']);
    }
}


add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/product-addons/(?P<id>\d+)', array(
        'methods' => 'GET',
        'callback' => 'get_product_addons',
        'permission_callback' => '__return_true',
    ));
});

function get_product_addons($data)
{
    global $wpdb;

    $product_id = intval($data['id']);

    $groups = $wpdb->get_results($wpdb->prepare("
        SELECT g.id, g.title as group_title
        FROM {$wpdb->prefix}product_addon_groups g
        JOIN {$wpdb->prefix}product_addon_relationships r ON g.id = r.group_id
        WHERE r.product_id = %d
    ", $product_id));

    $addons = array();

    foreach ($groups as $group) {
        $fields = $wpdb->get_results($wpdb->prepare("
            SELECT f.id, f.label, f.type
            FROM {$wpdb->prefix}product_addon_fields f
            WHERE f.group_id = %d
        ", $group->id));

        foreach ($fields as $field) {
            $options = $wpdb->get_results($wpdb->prepare("
                SELECT o.id, o.label, o.price, o.visual_value
                FROM {$wpdb->prefix}product_addon_options o
                WHERE o.field_id = %d
            ", $field->id));

            foreach ($options as $option) {
                if (!empty($option->visual_value)) {
                    $attachment_id = intval($option->visual_value);
                    $image_url = wp_get_attachment_url($attachment_id);
                    $option->image = $image_url ? $image_url : $option->visual_value;
                } else {
                    $option->image = '';
                }
            }

            $field->options = $options;
        }

        $group->fields = $fields;
        $addons[] = $group;
    }

    return $addons;
}
add_action('rest_api_init', function() {  
    header("Access-Control-Allow-Origin: *");  
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");  
    header("Access-Control-Allow-Credentials: true");  
    header("Access-Control-Allow-Headers: Authorization, Content-Type");  
});