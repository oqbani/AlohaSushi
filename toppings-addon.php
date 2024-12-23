<?php
/*
Plugin Name: Product Addons
Description: Add custom fields to WooCommerce products
Version: 1.0
Author: Maamri mohammed
*/

if (!defined('ABSPATH')) exit;

class ProductAddons
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_frontend_assets'));
        add_filter('woocommerce_product_data_tabs', array($this, 'add_product_tab'));
        add_action('woocommerce_product_data_panels', array($this, 'add_product_tab_content'));
        add_action('woocommerce_process_product_meta', array($this, 'save_product_addons'));
        add_action('admin_init', array($this, 'save_addon_group'));
        add_action('woocommerce_admin_order_item_headers', array($this, 'add_order_item_header'));
        add_action('woocommerce_admin_order_item_values', array($this, 'add_order_item_value'), 10, 3);
    }

    public function add_admin_menu()
    {
        // Page principale (liste)
        add_menu_page(
            'Product Addons',
            'Product Addons',
            'manage_options',
            'product-addons',
            array($this, 'list_page'),
            'dashicons-plus-alt',
            56
        );

        // Sous-page pour ajouter/éditer
        add_submenu_page(
            'product-addons',
            'Add New Addon',
            'Add New',
            'manage_options',
            'product-addons-new',
            array($this, 'admin_page')
        );
    }

    public function enqueue_admin_assets($hook)
    {
        if (!in_array($hook, array('toplevel_page_product-addons', 'product-addons_page_product-addons-new'))) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_enqueue_style('product-addons-admin', plugins_url('assets/css/admin.css', __FILE__));
        wp_enqueue_script(
            'product-addons-admin',
            plugins_url('assets/js/admin.js', __FILE__),
            array('jquery', 'jquery-ui-sortable', 'wp-color-picker'),
            '1.0',
            true
        );
    }

    public function enqueue_frontend_assets()
    {
        if (!is_product()) return;

        wp_enqueue_style('product-addons-frontend', plugins_url('assets/css/frontend.css', __FILE__));
        wp_enqueue_script(
            'product-addons-frontend',
            plugins_url('assets/js/frontend.js', __FILE__),
            array('jquery'),
            '1.0',
            true
        );
    }
    private function render_field($field)
    {
?>
        <div class="field-group">
            <div class="field-header">
                <div class="field-move">
                    <span class="dashicons dashicons-menu"></span>
                </div>
                <span class="field-title"><?php echo esc_html($field->label); ?></span>
                <div class="field-controls">
                    <button type="button" class="button add-field-after">
                        <span class="dashicons dashicons-plus"></span>
                    </button>
                    <button type="button" class="button delete-field">
                        <span class="dashicons dashicons-trash"></span>
                    </button>
                </div>
            </div>
            <div class="field-content">
                <input type="hidden" name="field_id[]" value="<?php echo esc_attr($field->id); ?>">

                <div class="field-row">
                    <label>Type</label>
                    <div class="field-input">
                        <select name="field_type[]">
                            <option value="radio" <?php selected($field->type, 'radio'); ?>>Radio</option>
                            <option value="checkbox" <?php selected($field->type, 'checkbox'); ?>>Checkbox</option>
                            <option value="select" <?php selected($field->type, 'select'); ?>>Select</option>
                        </select>
                    </div>
                </div>

                <div class="field-row">
                    <label>Title/Label</label>
                    <div class="field-input">
                        <input type="text" name="field_label[]"
                            class="field-label-input"
                            value="<?php echo esc_attr($field->label); ?>">
                    </div>
                </div>

                <div class="field-row">
                    <label>Description</label>
                    <div class="field-input">
                        <textarea name="field_description[]"><?php echo esc_textarea($field->description); ?></textarea>
                    </div>
                </div>

                <div class="field-row">
                    <label>Required</label>
                    <div class="field-input">
                        <input type="checkbox" name="field_required[]"
                            <?php checked($field->required, 1); ?>>
                    </div>
                </div>

                <div class="field-row">
                    <label>Maximum Selections</label>
                    <div class="field-input">
                        <input type="number" name="field_max_selections[]"
                            min="0" step="1"
                            value="<?php echo esc_attr($field->max_selections); ?>">
                        <p class="description">Leave empty or 0 for unlimited selections</p>
                    </div>
                </div>

                <div class="field-row options-section">
                    <label>Options</label>
                    <div class="field-input">
                        <div class="option-rows">
                            <?php
                            if (isset($field->options) && !empty($field->options)):
                                foreach ($field->options as $option):
                                    $this->render_option($option);
                                endforeach;
                            endif
                            ?>
                        </div>
                        <button type="button" class="button add-option">Add Option</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    private function render_option($option)
    {
    ?>
        <div class="option-row">
            <div class="option-move">
                <span class="dashicons dashicons-menu"></span>
            </div>
            <div class="option-fields">
                <input type="hidden" name="option_id[]" value="<?php echo esc_attr($option->id); ?>">

                <input type="text" name="option_label[]"
                    placeholder="Label"
                    value="<?php echo esc_attr($option->label); ?>">

                <select name="option_visual[]" class="visual-type-select">
                    <option value="none" <?php selected($option->visual_type, 'none'); ?>>None</option>
                    <option value="color" <?php selected($option->visual_type, 'color'); ?>>Color</option>
                    <option value="image" <?php selected($option->visual_type, 'image'); ?>>Image</option>
                </select>

                <div class="visual-value-container">
                    <?php
                    if ($option->visual_type === 'color') {
                    ?>
                        <input type="color" class="color-picker"
                            name="option_visual_value[]"
                            value="<?php echo esc_attr($option->visual_value); ?>">
                    <?php
                    } elseif ($option->visual_type === 'image') {
                        $attachment_id = intval($option->visual_value);
                        $image_url = wp_get_attachment_url($attachment_id);
                    ?>
                        <div class="image-upload-container">
                            <input type="hidden" name="option_visual_value[]"
                                class="image-value"
                                value="<?php echo esc_attr($option->visual_value); ?>">
                            <button type="button" class="button upload-image">Upload Image</button>
                            <div class="image-preview">
                                <?php if (!empty($image_url)): ?>
                                    <div class="image-preview-wrapper">
                                        <img src="<?php echo esc_url($image_url); ?>" alt="Preview">
                                        <button type="button" class="remove-image dashicons dashicons-trash"></button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <input type="hidden" name="option_visual_value[]" value="">
                    <?php
                    }
                    ?>
                </div>

                <input type="text" name="option_price[]"
                    placeholder="Price"
                    value="<?php echo esc_attr($option->price); ?>">

                <label class="option-selected-label">
                    <input type="checkbox" name="option_selected[]"
                        value="1"
                        <?php checked(!empty($option->iselected), 1); ?>>
                </label>

                <span class="delete-option dashicons dashicons-trash"></span>
            </div>
        </div>
    <?php
    }
    public function admin_page()
    {
        global $wpdb;
        $addon_group = null;
        $addon_fields = array();

        if (isset($_GET['edit'])) {
            $group_id = intval($_GET['edit']);
            $addon_group = $wpdb->get_row($wpdb->prepare(
                "SELECT * FROM {$wpdb->prefix}product_addon_groups WHERE id = %d",
                $group_id
            ));

            if ($addon_group) {
                $addon_fields = $wpdb->get_results($wpdb->prepare(
                    "SELECT f.*, 
                    (SELECT GROUP_CONCAT(
                        CONCAT_WS(':::', o.id, o.label, o.price, o.visual_type, o.visual_value,o.iselected)
                    ) 
                    FROM {$wpdb->prefix}product_addon_options o 
                    WHERE o.field_id = f.id 
                    ORDER BY o.position) as options_data
                FROM {$wpdb->prefix}product_addon_fields f 
                WHERE f.group_id = %d 
                ORDER BY f.position",
                    $group_id
                ));

                // Traiter les options pour chaque champ
                foreach ($addon_fields as $field) {
                    $field->options = array();
                    if (!empty($field->options_data)) {
                        $options_array = explode(',', $field->options_data);
                        foreach ($options_array as $option_data) {
                            list($id, $label, $price, $visual_type, $visual_value, $iselected) = explode(':::', $option_data);
                            $field->options[] = (object) array(
                                'id' => $id,
                                'label' => $label,
                                'price' => $price,
                                'visual_type' => $visual_type,
                                'visual_value' => $visual_value,
                                'iselected' => $iselected
                            );
                        }
                    }
                    unset($field->options_data);
                }
            }
        }


    ?>
        <div class="wrap">
            <h1><?php echo isset($_GET['edit']) ? 'Edit Product Addon' : 'Add New Product Addon'; ?></h1>

            <form id="product-addon-form" method="post" action="">
                <?php wp_nonce_field('save_addon', 'addon_nonce'); ?>
                <input type="hidden" name="addon_save" value="1">
                <?php if (isset($_GET['edit'])): ?>
                    <input type="hidden" name="group_id" value="<?php echo intval($_GET['edit']); ?>">
                <?php endif; ?>

                <input type="text" name="addon_title"
                    placeholder="Pizza Toppings"
                    class="regular-text"
                    value="<?php echo isset($addon_group) ? esc_attr($addon_group->title) : ''; ?>"
                    required>

                <div class="postbox">
                    <h2 class="hndle">Fields</h2>
                    <div class="inside fields-container">
                        <?php
                        if (isset($addon_fields) && !empty($addon_fields)):
                            foreach ($addon_fields as $field):
                                $this->render_field($field);
                            endforeach;
                        else:
                        ?>
                            <div class="no-fields-message">
                                <button type="button" class="button button-primary">Add Your First Field</button>
                                <p class="description">Start adding product addon fields for your products.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="submit-box">
                    <button type="submit" class="button button-primary">Save Changes</button>
                </div>
            </form>
        </div>
    <?php
    }

    public function save_addon_group()
    {
        error_log("-------- " . date('Y-m-d H:i:s') . " --------");
        error_log('POST Data: ' . print_r($_POST, true));
        if (!isset($_POST['addon_save']) || !wp_verify_nonce($_POST['addon_nonce'], 'save_addon')) {
            return;
        }



        global $wpdb;


        // Sauvegarde du groupe
        $group_data = array(
            'title' => sanitize_text_field($_POST['addon_title'])
        );

        if (isset($_POST['group_id']) && !empty($_POST['group_id'])) {
            $wpdb->update(
                $wpdb->prefix . 'product_addon_groups',
                $group_data,
                array('id' => intval($_POST['group_id']))
            );
            $group_id = intval($_POST['group_id']);
        } else {
            $wpdb->insert($wpdb->prefix . 'product_addon_groups', $group_data);
            $group_id = $wpdb->insert_id;
        }

        // Sauvegarde des champs
        if (isset($_POST['field_type']) && is_array($_POST['field_type'])) {
            foreach ($_POST['field_type'] as $position => $type) {
                $field_data = array(
                    'group_id' => $group_id,
                    'type' => sanitize_text_field($type),
                    'label' => sanitize_text_field($_POST['field_label'][$position]),
                    'description' => sanitize_textarea_field($_POST['field_description'][$position]),
                    'required' => isset($_POST['field_required'][$position]) ? 1 : 0,
                    'max_selections' => intval($_POST['field_max_selections'][$position]),
                    'position' => $position
                );

                if (isset($_POST['field_id'][$position]) && !empty($_POST['field_id'][$position])) {
                    $wpdb->update(
                        $wpdb->prefix . 'product_addon_fields',
                        $field_data,
                        array('id' => intval($_POST['field_id'][$position]))
                    );
                    $field_id = intval($_POST['field_id'][$position]);
                } else {
                    $wpdb->insert($wpdb->prefix . 'product_addon_fields', $field_data);
                    $field_id = $wpdb->insert_id;
                }

                // Sauvegarde des options pour ce champ
                if (isset($_POST['option_label'][$position]) && is_array($_POST['option_label'][$position])) {
                    error_log("hna 1");

                    foreach ($_POST['option_label'][$position] as $option_position => $label) {
                        error_log("hna 2");
                        $option_data = array(
                            'field_id' => $field_id,
                            'label' => sanitize_text_field($label),
                            'price' => isset($_POST['option_price'][$position][$option_position])
                                ? floatval($_POST['option_price'][$position][$option_position])
                                : 0,
                            'visual_type' => isset($_POST['option_visual'][$position][$option_position])
                                ? sanitize_text_field($_POST['option_visual'][$position][$option_position])
                                : 'none',
                            'visual_value' => isset($_POST['option_visual_value'][$position][$option_position])
                                ? sanitize_text_field($_POST['option_visual_value'][$position][$option_position])
                                : '',
                            'position' => $option_position,
                            'iselected' => isset($_POST['option_selected'][$position][$option_position]) ? 1 : 0
                        );

                        // Vérifier si l'option existe déjà
                        if (isset($_POST['option_id'][$position][$option_position]) && !empty($_POST['option_id'][$position][$option_position])) {
                            $wpdb->update(
                                $wpdb->prefix . 'product_addon_options',
                                $option_data,
                                array('id' => intval($_POST['option_id'][$position][$option_position]))
                            );
                        } else {


                            $wpdb->insert($wpdb->prefix . 'product_addon_options', $option_data);
                        }
                    }
                } else {
                    // Si aucune option n'a été soumise pour ce champ, supprimer toutes les options existantes pour ce champ
                    $wpdb->delete(
                        $wpdb->prefix . 'product_addon_options',
                        array('field_id' => $field_id),
                        array('%d')
                    );
                }
            }
        }

        wp_redirect(admin_url('admin.php?page=product-addons&message=saved'));
        exit;
    }

    public function add_product_tab($tabs)
    {
        $tabs['addons'] = array(
            'label'    => __('Product Addons', 'product-addons'),
            'target'   => 'product_addons_options',
            'class'    => array(),
            'priority' => 60
        );
        return $tabs;
    }

    public function add_product_tab_content()
    {
        global $wpdb;
        $product_id = get_the_ID();

        // Récupérer tous les groupes d'addons
        $groups = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}product_addon_groups WHERE active = 1");

        // Récupérer les groupes associés au produit
        $selected_groups = $wpdb->get_col($wpdb->prepare(
            "SELECT group_id FROM {$wpdb->prefix}product_addon_relationships WHERE product_id = %d",
            $product_id
        ));

    ?>
        <div id="product_addons_options" class="panel woocommerce_options_panel">
            <div class="options_group">
                <p class="form-field">
                    <label><?php _e('Select Addons', 'product-addons'); ?></label>
                    <?php foreach ($groups as $group): ?>
                        <label class="checkbox">
                            <input type="checkbox"
                                name="product_addons[]"
                                value="<?php echo $group->id; ?>"
                                <?php checked(in_array($group->id, $selected_groups)); ?>>
                            <?php echo esc_html($group->title); ?>
                        </label>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>
    <?php
    }

    public function save_product_addons($product_id)
    {
        global $wpdb;

        // Supprimer les anciennes relations
        $wpdb->delete(
            $wpdb->prefix . 'product_addon_relationships',
            array('product_id' => $product_id)
        );

        // Ajouter les nouvelles relations
        if (isset($_POST['product_addons']) && is_array($_POST['product_addons'])) {
            foreach ($_POST['product_addons'] as $group_id) {
                $wpdb->insert(
                    $wpdb->prefix . 'product_addon_relationships',
                    array(
                        'product_id' => $product_id,
                        'group_id' => intval($group_id)
                    )
                );
            }
        }
    }
    // Nouvelle méthode pour la page de liste
    public function list_page()
    {
        global $wpdb;

        // Gestion de la suppression
        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
            $id = intval($_GET['id']);
            if (wp_verify_nonce($_GET['_wpnonce'], 'delete_addon_' . $id)) {
                $wpdb->delete(
                    $wpdb->prefix . 'product_addon_groups',
                    array('id' => $id),
                    array('%d')
                );
                wp_redirect(admin_url('admin.php?page=product-addons&message=deleted'));
                exit;
            }
        }

        // Récupération des addons
        $addons = $wpdb->get_results("
            SELECT g.*, 
                   COUNT(DISTINCT f.id) as fields_count,
                   COUNT(DISTINCT r.product_id) as products_count
            FROM {$wpdb->prefix}product_addon_groups g
            LEFT JOIN {$wpdb->prefix}product_addon_fields f ON g.id = f.group_id
            LEFT JOIN {$wpdb->prefix}product_addon_relationships r ON g.id = r.group_id
            GROUP BY g.id
            ORDER BY g.title ASC
        ");

        // Affichage des messages
        if (isset($_GET['message'])) {
            $message = '';
            switch ($_GET['message']) {
                case 'deleted':
                    $message = 'Addon deleted successfully.';
                    break;
                case 'saved':
                    $message = 'Addon saved successfully.';
                    break;
            }
            if ($message) {
                echo '<div class="notice notice-success is-dismissible"><p>' . esc_html($message) . '</p></div>';
            }
        }
    ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">Product Addons</h1>
            <a href="<?php echo admin_url('admin.php?page=product-addons-new'); ?>" class="page-title-action">Add New</a>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Fields</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($addons)): ?>
                        <tr>
                            <td colspan="5">No addons found. <a href="<?php echo admin_url('admin.php?page=product-addons-new'); ?>">Create your first addon</a>.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($addons as $addon): ?>
                            <tr>
                                <td>
                                    <strong>
                                        <a href="<?php echo admin_url('admin.php?page=product-addons-new&edit=' . $addon->id); ?>">
                                            <?php echo esc_html($addon->title); ?>
                                        </a>
                                    </strong>
                                </td>
                                <td><?php echo intval($addon->fields_count); ?></td>
                                <td><?php echo intval($addon->products_count); ?></td>
                                <td>
                                    <span class="status-<?php echo $addon->active ? 'active' : 'inactive'; ?>">
                                        <?php echo $addon->active ? 'Active' : 'Inactive'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo admin_url('admin.php?page=product-addons-new&edit=' . $addon->id); ?>"
                                        class="button button-small">Edit</a>

                                    <a href="<?php echo wp_nonce_url(admin_url('admin.php?page=product-addons&action=delete&id=' . $addon->id), 'delete_addon_' . $addon->id); ?>"
                                        class="button button-small delete-addon"
                                        onclick="return confirm('Are you sure you want to delete this addon?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
<?php
    }

    // Sauvegarder les addons sélectionnés lors de l'ajout au panier
    public function add_cart_item_data($cart_item_data, $product_id, $variation_id)
    {
        global $wpdb;

        if (!isset($_POST['product_addons'])) {
            return $cart_item_data;
        }

        $addons_data = array();
        foreach ($_POST['product_addons'] as $field_id => $selected_options) {
            // Récupérer les informations du champ
            $field = $wpdb->get_row($wpdb->prepare(
                "SELECT f.*, g.title as group_title 
            FROM {$wpdb->prefix}product_addon_fields f 
            JOIN {$wpdb->prefix}product_addon_groups g ON f.group_id = g.id 
            WHERE f.id = %d",
                $field_id
            ));

            if (!$field) continue;

            $options_data = array();
            if (!is_array($selected_options)) {
                $selected_options = array($selected_options);
            }

            foreach ($selected_options as $option_id) {
                $option = $wpdb->get_row($wpdb->prepare(
                    "SELECT * FROM {$wpdb->prefix}product_addon_options 
                WHERE id = %d AND field_id = %d",
                    $option_id,
                    $field_id
                ));

                if ($option) {
                    $options_data[] = array(
                        'label' => $option->label,
                        'price' => $option->price,
                        'visual_type' => $option->visual_type,
                        'visual_value' => $option->visual_value
                    );
                }
            }

            if (!empty($options_data)) {
                $addons_data[] = array(
                    'group_title' => $field->group_title,
                    'field_label' => $field->label,
                    'field_type' => $field->type,
                    'options' => $options_data
                );
            }
        }

        if (!empty($addons_data)) {
            $cart_item_data['product_addons'] = $addons_data;
        }

        return $cart_item_data;
    }

    // Afficher les addons dans le panier
    public function get_item_data($item_data, $cart_item)
    {
        if (isset($cart_item['product_addons'])) {
            foreach ($cart_item['product_addons'] as $addon) {
                $options_text = array();
                $total_price = 0;

                foreach ($addon['options'] as $option) {
                    $option_text = $option['label'];
                    if ($option['price'] > 0) {
                        $option_text .= ' (+' . wc_price($option['price']) . ')';
                        $total_price += $option['price'];
                    }
                    $options_text[] = $option_text;
                }

                $item_data[] = array(
                    'key' => $addon['field_label'],
                    'value' => implode(', ', $options_text)
                );
            }
        }
        return $item_data;
    }

    // Sauvegarder les addons dans la commande
    public function add_order_item_meta($item, $cart_item_key, $values, $order)
    {
        if (isset($values['product_addons'])) {
            $item->add_meta_data('_product_addons', $values['product_addons']);

            // Ajouter aussi en format lisible
            foreach ($values['product_addons'] as $addon) {
                $options_text = array();
                foreach ($addon['options'] as $option) {
                    $option_text = $option['label'];
                    if ($option['price'] > 0) {
                        $option_text .= ' (+' . wc_price($option['price']) . ')';
                    }
                    $options_text[] = $option_text;
                }

                $item->add_meta_data(
                    $addon['field_label'],
                    implode(', ', $options_text),
                    true
                );
            }
        }
    }

    // Ajouter l'en-tête des addons dans l'administration des commandes
    public function add_order_item_header()
    {
        echo '<th class="product-addons">Addons</th>';
    }

    // Afficher les addons dans l'administration des commandes
    public function add_order_item_value($product, $item, $item_id)
    {
        $addons = $item->get_meta('_product_addons');
        echo '<td class="product-addons">';
        if ($addons) {
            foreach ($addons as $addon) {
                echo '<strong>' . esc_html($addon['field_label']) . ':</strong><br>';
                foreach ($addon['options'] as $option) {
                    echo esc_html($option['label']);
                    if ($option['price'] > 0) {
                        echo ' (+' . wc_price($option['price']) . ')';
                    }
                    echo '<br>';
                }
            }
        }
        echo '</td>';
    }
}

new ProductAddons();


register_activation_hook(__FILE__, 'product_addons_install');

function product_addons_install()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // Table des groupes d'addons
    $table_groups = $wpdb->prefix . 'product_addon_groups';
    $sql1 = "CREATE TABLE IF NOT EXISTS $table_groups (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        title varchar(255) NOT NULL,
        position int(11) DEFAULT 0,
        active tinyint(1) DEFAULT 1,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    // Table des champs
    $table_fields = $wpdb->prefix . 'product_addon_fields';
    $sql2 = "CREATE TABLE IF NOT EXISTS $table_fields (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        group_id mediumint(9) NOT NULL,
        type varchar(50) NOT NULL,
        label varchar(255) NOT NULL,
        description text,
        required tinyint(1) DEFAULT 0,
        max_selections int(11) DEFAULT 0,
        position int(11) DEFAULT 0,
        PRIMARY KEY  (id),
        FOREIGN KEY (group_id) REFERENCES $table_groups(id) ON DELETE CASCADE
    ) $charset_collate;";

    // Table des options
    $table_options = $wpdb->prefix . 'product_addon_options';
    $sql3 = "CREATE TABLE IF NOT EXISTS $table_options (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        field_id mediumint(9) NOT NULL,
        label varchar(255) NOT NULL,
        price decimal(10,2) DEFAULT 0.00,
        visual_type varchar(50) DEFAULT 'none',
        visual_value text,
        iselected tinyint(1) DEFAULT 0, /* Nouvelle colonne */
        position int(11) DEFAULT 0,
        PRIMARY KEY  (id),
        FOREIGN KEY (field_id) REFERENCES $table_fields(id) ON DELETE CASCADE
    ) $charset_collate;";

    // Table de liaison produits-addons
    $table_product_addons = $wpdb->prefix . 'product_addon_relationships';
    $sql4 = "CREATE TABLE IF NOT EXISTS $table_product_addons (
        product_id bigint(20) NOT NULL,
        group_id mediumint(9) NOT NULL,
        PRIMARY KEY  (product_id, group_id),
        FOREIGN KEY (group_id) REFERENCES $table_groups(id) ON DELETE CASCADE
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql1);
    dbDelta($sql2);
    dbDelta($sql3);
    dbDelta($sql4);
}

register_activation_hook(__FILE__, 'product_addons_update_db');

function product_addons_update_db()
{
    global $wpdb;
    $table_options = $wpdb->prefix . 'product_addon_options';
    $column = $wpdb->get_row("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$table_options' AND column_name = 'iselected'");
    if (is_null($column)) {
        $wpdb->query("ALTER TABLE $table_options ADD COLUMN iselected TINYINT(1) DEFAULT 0");
    }
}
