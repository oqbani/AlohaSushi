<?php
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
function theme_add_woocommerce_support() {  
    add_theme_support('woocommerce');  
    add_theme_support('wc-product-gallery-zoom');  
    add_theme_support('wc-product-gallery-lightbox');  
    add_theme_support('wc-product-gallery-slider');  
}  
add_action('after_setup_theme', 'theme_add_woocommerce_support');  

// Enable CORS for REST API  
function add_cors_http_header(){  
    header("Access-Control-Allow-Origin: *");  
}  
add_action('init','add_cors_http_header');  












// Add REST API keys to JavaScript  
function add_wc_api_js_variables() {  
    if (is_page('products') || is_shop()) { // Adjust condition as needed  
        ?>  
        <script type="text/javascript">  
            var wc_api = {  
                url: '<?php echo esc_url_raw(rest_url('wc/v3/')); ?>',  
                consumer_key: '<?php echo esc_js(get_option('woocommerce_api_consumer_key')); ?>',  
                consumer_secret: '<?php echo esc_js(get_option('woocommerce_api_consumer_secret')); ?>'  
            };  
        </script>  
        <?php  
    }  
}  
add_action('wp_head', 'add_wc_api_js_variables');  








// AJAX handler for product details  
function get_ajax_product_details() {  
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