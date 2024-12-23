<!-- CATEGORY -->
<section class="menu-categories">
    <h1>OUR CATEGRORIES</h1>
    <div class="container">
        <?php
        $args = array(
            'taxonomy'   => 'product_cat',
            'orderby'    => 'name',
            'hide_empty' => true,
        );
        $categories = get_terms($args);

        if (!empty($categories)) {
            foreach ($categories as $category) {
                // Get category details
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image_url = wp_get_attachment_url($thumbnail_id);
                $product_count = isset($category->count) ? $category->count : 0;

                // Output each category as a slide
                echo '<div class="menu-categorie">';
                if ($image_url) {
                    echo '<a class="" href="' . esc_url(add_query_arg('category', $category->slug)) . '">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($category->name) . '">';
                    echo '</a>';
                }
                echo '<a class="" href="' . esc_url(get_term_link($category)) . '">';
                echo '<h4>' . esc_html(strtoupper($category->name)) . '</h4>';
                echo '</a>';
                echo '</div>';
            }
        }
        ?>
    </div>

</section>

<!-- PRODUCTS -->
<section class="menu-products">
    <h1>OUR PRODUCTS</h1>

    <div class="swiper-container container">
        <?php
        $tax_query = array();
        $is_category_selected = false;

        if ($selected_category_slug !== '') {
            $selected_category = get_term_by('slug', $selected_category_slug, 'product_cat');

            if ($selected_category) {
                $is_category_selected = true;

                $tax_query[] = array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => $selected_category->slug,
                );

                echo '<h1>PRODUCTS IN CATEGORY: ' . esc_html($selected_category->name) . '</h1>';
            } else {
                echo '<h1>ALL PRODUCTS</h1>';
            }
        } else {
            echo '<h1>OUR PRODUCTS</h1>';
        }

        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 12,
        );

        if ($is_category_selected) {
            $args['tax_query'] = $tax_query;
        }
        $loop = new WP_Query($args);

        if ($loop->have_posts()) {
            while ($loop->have_posts()) : $loop->the_post();
        ?>

                <div class="product">
                    <a class="a" onclick="showProductDetails('<?php echo esc_attr($product->get_id()); ?>')">
                        <div class="product-top">
                            <?php if (has_post_thumbnail()) {
                                the_post_thumbnail('medium', ['class' => 'img']);
                            } ?>
                            <div class="product-recepies">
                                <p>Lorem.</p>
                                <p>Lorem.</p>
                                <p>Lorem.</p>
                            </div>
                        </div>
                    </a>
                    <div class="product-content">
                        <h2><?php the_title(); ?></h2>
                        <p>Lorem ipsum | dolor | sit amet | consectetur.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h3><?php echo get_post_meta(get_the_ID(), '_price', true); ?>€</h3>
                            <i onclick="addToCart(productId)" class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </div>
                </div>
        <?php
            endwhile;
        } else {
            echo 'No products found.';
        }
        wp_reset_postdata();
        ?>
    </div>





</section>