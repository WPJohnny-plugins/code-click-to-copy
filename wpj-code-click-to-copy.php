<?php
/**
 * Plugin Name: Code Click-to-Copy by WPJohnny
 * Plugin URI: https://wpjohnny.com/code-click-to-copy/
 * Description: Simple plugin that automatically copies content in pre and code tags to clipboard (when clicked). Other plugins out there do the same but create a little [COPY] button that you have to aim for. Mine doesn't require any aiming, just click anywhere on the code block and it copies the whole thing. Customizable hover tooltip lets you know it's copied.
 *
 * For sites sharing code-commands, this plugin will save users time from having to highlight and copy-paste bits of text back and forth. It's especially helpful for large globs of code that scroll off-screen, or when copying on your mobile phone. I've added more features to make it more helpful.
 *
 * Features:
 * - Easy aim - click anywhere on text block to copy entire text, no need to aim for tiny text or clipboard icon.
 * - Tooltip text customization - change tooltip text.
 * - Tooltip color options - customize tooltip background and text colors.
 * - Tooltip hover custom CSS - completely restyle the tooltip hover.
 * - Tooltip function custom CSS - apply tooltip function to other CSS classes. Allowing copy function on any content block, not only code blocks.
 * Author: <a href="https://wpjohnny.com">WPJohnny</a>
 * Donate link: https://www.paypal.me/wpjohnny
 * Version:     1.0.0
 */

/**
 * Load plugin textdomain.
 */



add_action( 'init', 'codeClickToCopyLoadTextdomain' );
function codeClickToCopyLoadTextdomain() {
    load_plugin_textdomain( 'click_to_copy', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

// Add admin menu
add_action('admin_menu', 'code_click_to_copy_admin_menu');
function code_click_to_copy_admin_menu() {
    add_submenu_page(
        'options-general.php', // Parent slug (Settings)
        'Code Click to Copy Settings',
        'Code Click to Copy',
        'manage_options',
        'code-click-to-copy',
        'code_click_to_copy_settings_page'
    );
}

// Register settings
add_action('admin_init', 'code_click_to_copy_settings_init');
add_action('admin_enqueue_scripts', 'enqueue_admin_scripts');

function code_click_to_copy_settings_init() {
    register_setting('code_click_to_copy', 'code_click_to_copy_settings');

    add_settings_section(
        'code_click_to_copy_section',
        'Tooltip Customizations',
        'code_click_to_copy_section_callback',
        'code-click-to-copy'
    );

    // 1. Tooltip Background Color
    add_settings_field(
        'tooltip_background',
        'Tooltip Background Color',
        'tooltip_background_callback',
        'code-click-to-copy',
        'code_click_to_copy_section'
    );

    // 2. Tooltip Text Color
    add_settings_field(
        'tooltip_text_color',
        'Tooltip Text Color',
        'tooltip_text_color_callback',
        'code-click-to-copy',
        'code_click_to_copy_section'
    );

    // 3. Tooltip Copy Text
    add_settings_field(
        'click_to_copy_text',
        'Tooltip Copy Text',
        'click_to_copy_text_callback',
        'code-click-to-copy',
        'code_click_to_copy_section'
    );

    // 4. Tooltip Copied Text
    add_settings_field(
        'copied_text',
        'Tooltip Copied Text',
        'copied_text_callback',
        'code-click-to-copy',
        'code_click_to_copy_section'
    );

    // 5. Tooltip Hover CSS Class
    add_settings_field(
        'tooltip_custom_class',
        'Tooltip Hover CSS Class',
        'tooltip_custom_class_callback',
        'code-click-to-copy',
        'code_click_to_copy_section'
    );

    // 6. Tooltip Function CSS Class
    add_settings_field(
        'custom_css_class',
        'Tooltip Function CSS Class',
        'custom_css_class_callback',
        'code-click-to-copy',
        'code_click_to_copy_section'
    );
}

function code_click_to_copy_section_callback() {
    // Removed extra explanation text
}

function tooltip_background_callback() {
    $options = get_option('code_click_to_copy_settings');
    $background = isset($options['tooltip_background']) ? $options['tooltip_background'] : '#333333';
    // Convert 3-digit hex to 6-digit if needed
    if (preg_match('/^#([0-9A-F])([0-9A-F])([0-9A-F])$/i', $background, $matches)) {
        $background = '#' . $matches[1] . $matches[1] . $matches[2] . $matches[2] . $matches[3] . $matches[3];
    }
    echo '<div style="display:flex;align-items:center;gap:10px;">';
    echo '<input type="color" name="code_click_to_copy_settings[tooltip_background]" value="' . esc_attr($background) . '" style="width:50px;height:30px;">';
    echo '<input type="text" class="hex-input" value="' . esc_attr($background) . '" style="width:100px;" placeholder="#000000">';
    echo ' <a href="#" class="reset-color" data-default="#333333">Reset</a>';
    echo '</div>';
}

function tooltip_text_color_callback() {
    $options = get_option('code_click_to_copy_settings');
    $text_color = isset($options['tooltip_text_color']) ? $options['tooltip_text_color'] : '#ffffff';
    // Convert 3-digit hex to 6-digit if needed
    if (preg_match('/^#([0-9A-F])([0-9A-F])([0-9A-F])$/i', $text_color, $matches)) {
        $text_color = '#' . $matches[1] . $matches[1] . $matches[2] . $matches[2] . $matches[3] . $matches[3];
    }
    echo '<div style="display:flex;align-items:center;gap:10px;">';
    echo '<input type="color" name="code_click_to_copy_settings[tooltip_text_color]" value="' . esc_attr($text_color) . '" style="width:50px;height:30px;">';
    echo '<input type="text" class="hex-input" value="' . esc_attr($text_color) . '" style="width:100px;" placeholder="#000000">';
    echo ' <a href="#" class="reset-color" data-default="#ffffff">Reset</a>';
    echo '</div>';
}

function click_to_copy_text_callback() {
    $options = get_option('code_click_to_copy_settings');
    $val = isset($options['click_to_copy_text']) ? $options['click_to_copy_text'] : '';
    echo '<input type="text" name="code_click_to_copy_settings[click_to_copy_text]" value="' . esc_attr($val) . '" placeholder="Click to Copy (default)" />';
}

function copied_text_callback() {
    $options = get_option('code_click_to_copy_settings');
    $val = isset($options['copied_text']) ? $options['copied_text'] : '';
    echo '<input type="text" name="code_click_to_copy_settings[copied_text]" value="' . esc_attr($val) . '" placeholder="Copied! (default)" />';
}

function tooltip_custom_class_callback() {
    $options = get_option('code_click_to_copy_settings');
    $val = isset($options['tooltip_custom_class']) ? $options['tooltip_custom_class'] : 'codeCopyTooltip';
    echo '<input type="text" name="code_click_to_copy_settings[tooltip_custom_class]" value="' . esc_attr($val) . '" placeholder="e.g. my-tooltip-class" />';
    echo '<br><small style="color:#666;">Use default <code>codeCopyTooltip</code> class, or restyle tooltip hover with your own.</small>';
}

function custom_css_class_callback() {
    $options = get_option('code_click_to_copy_settings');
    if (isset($options['custom_css_class']) && trim($options['custom_css_class']) !== '') {
        $custom_class = $options['custom_css_class'];
    } else {
        $custom_class = 'code, pre';
    }
    echo '<input type="text" name="code_click_to_copy_settings[custom_css_class]" value="' . esc_attr($custom_class) . '" placeholder="e.g. my-copy-class,another-class" />';
    echo '<br><small style="color:#666;">Enter class names (without dot or spaces) to apply tooltip function, separate by comma if multiple. Can add to, or replace existing default class <code>code, pre</code>.</small>';
}



function code_click_to_copy_settings_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('code_click_to_copy');
            do_settings_sections('code-click-to-copy');
            submit_button('Save Settings');
            ?>
        </form>
        <p style="margin-top:30px; color:#555;">
            Like this plugin? <a href="https://www.paypal.me/wpjohnny" target="_blank">Buy me a beer</a> or <a href="https://wordpress.org/plugins/comment-reply-email/" target="_blank">leave a 5-star review</a>.
        </p>
    </div>
    <?php
}

add_action('wp_footer', 'codeCopyActivate');
add_action('admin_footer', 'codeCopyActivate');
function codeCopyActivate(){
    $options = get_option('code_click_to_copy_settings');
    $clickToCopyStr = isset($options['click_to_copy_text']) && $options['click_to_copy_text'] !== '' ? $options['click_to_copy_text'] : __('Click to Copy', 'click_to_copy');
    $copiedMessage = isset($options['copied_text']) && $options['copied_text'] !== '' ? $options['copied_text'] : __('Copied!', 'click_to_copy');
    $tooltip_bg = isset($options['tooltip_background']) ? $options['tooltip_background'] : '#333333';
    $tooltip_text = isset($options['tooltip_text_color']) ? $options['tooltip_text_color'] : '#ffffff';
    if (isset($options['custom_css_class'])) {
        $custom_class = $options['custom_css_class'];
    } else {
        $custom_class = 'code';
    }
    $tooltip_custom_class = isset($options['tooltip_custom_class']) ? trim($options['tooltip_custom_class']) : 'codeCopyTooltip';
?>




<div class="codeCopyTooltip <?php echo esc_attr($tooltip_custom_class); ?>" style="display: inline-block; background: <?php echo esc_attr($tooltip_bg); ?>; color: <?php echo esc_attr($tooltip_text); ?>; padding: 0 8px; font-size: 14px; border-radius: 2px; border: 1px solid #111; position: absolute; display: none;">
<?= $clickToCopyStr; ?></div>
<script type="text/javascript">
    function getElementPosition(el) {
        var rect = el.getBoundingClientRect(),
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        return { top: rect.top + scrollTop - 30, left: rect.left + scrollLeft }
    }

    async function copyToClipboard(text) {
        try {
            console.log('Code Click to Copy: Attempting to copy text:', text.substring(0, 50) + '...');
            // Try modern Clipboard API first
            if (navigator.clipboard && window.isSecureContext) {
                console.log('Code Click to Copy: Using modern Clipboard API');
                await navigator.clipboard.writeText(text);
                console.log('Code Click to Copy: Successfully copied with Clipboard API');
                return true;
            } else {
                console.log('Code Click to Copy: Using fallback execCommand method');
                // Fallback for older browsers or non-secure contexts
                const textArea = document.createElement('textarea');
                textArea.value = text;
                textArea.style.position = 'fixed';
                textArea.style.left = '-999999px';
                textArea.style.top = '-999999px';
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                
                try {
                    document.execCommand('copy');
                    document.body.removeChild(textArea);
                    console.log('Code Click to Copy: Successfully copied with execCommand');
                    return true;
                } catch (err) {
                    document.body.removeChild(textArea);
                    console.error('Code Click to Copy: execCommand failed:', err);
                    return false;
                }
            }
        } catch (err) {
            console.error('Code Click to Copy: Failed to copy: ', err);
            return false;
        }
    }

    function applyCodeCopy(element) {
        element.style.cursor = 'pointer';
        element.style.position = 'relative';
        
        element.addEventListener("click", async function(event) {
            event.stopPropagation();
            const textToCopy = element.textContent || element.innerText;
            
            const success = await copyToClipboard(textToCopy);
            
            if (success) {
                codeCopyTooltip.innerHTML = <?= json_encode($copiedMessage); ?>;
                codeCopyTooltip.style.display = 'block';
                
                // Hide tooltip after 2 seconds
                setTimeout(() => {
                    codeCopyTooltip.style.display = 'none';
                }, 2000);
            } else {
                codeCopyTooltip.innerHTML = 'Failed to copy';
                codeCopyTooltip.style.display = 'block';
                
                setTimeout(() => {
                    codeCopyTooltip.style.display = 'none';
                }, 2000);
            }
        });
        
        element.addEventListener("mouseover", function(event) {
            event.stopPropagation();
            var position = getElementPosition(element);
            codeCopyTooltip.innerHTML = <?= json_encode($clickToCopyStr); ?>;
            codeCopyTooltip.style.display = 'inline-block';
            codeCopyTooltip.style.top = position.top + 'px';
            codeCopyTooltip.style.left = position.left + 'px';
        });
        
        element.addEventListener("mouseout", function(event) {
            event.stopPropagation();
            codeCopyTooltip.style.display = 'none';
        });
    }

    var codeCopyTooltip = document.querySelector('.<?php echo esc_js($tooltip_custom_class); ?>');

    (function() {
        var selector = '<?php echo esc_js($custom_class); ?>';
        if(selector.indexOf(',') !== -1) {
            selector = selector.split(',').map(function(sel) {
                sel = sel.trim();
                if (/^[a-zA-Z][a-zA-Z0-9-]*$/.test(sel)) {
                    return sel;
                } else if (sel.startsWith('.')) {
                    return sel;
                } else {
                    return '.' + sel;
                }
            }).join(', ');
        } else {
            selector = selector.trim();
            if (!selector.startsWith('.') && !/^[a-zA-Z][a-zA-Z0-9-]*$/.test(selector)) {
                selector = '.' + selector;
            }
        }
        
        // console.log('Code Click to Copy: Looking for elements with selector:', selector);
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                var elements = document.querySelectorAll(selector);
                // console.log('Code Click to Copy: Found', elements.length, 'elements on DOMContentLoaded');
                elements.forEach(function(element) {
                    applyCodeCopy(element);
                });
            });
        } else {
            var elements = document.querySelectorAll(selector);
            // console.log('Code Click to Copy: Found', elements.length, 'elements immediately');
            elements.forEach(function(element) {
                applyCodeCopy(element);
            });
        }
        
        // Also handle dynamically added content
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) { // Element node
                        if (node.matches && node.matches(selector)) {
                            applyCodeCopy(node);
                        }
                        if (node.querySelectorAll) {
                            node.querySelectorAll(selector).forEach(function(element) {
                                applyCodeCopy(element);
                            });
                        }
                    }
                });
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    })();
</script>
<?php
};

function enqueue_admin_scripts($hook) {
    if ('settings_page_code-click-to-copy' !== $hook) {
        return;
    }
    wp_add_inline_script('jquery', '
        jQuery(document).ready(function($) {
            // Function to convert 3-digit hex to 6-digit
            function expandHex(hex) {
                if (hex.match(/^#([0-9A-F])([0-9A-F])([0-9A-F])$/i)) {
                    return hex.replace(/^#([0-9A-F])([0-9A-F])([0-9A-F])$/i, "#$1$1$2$2$3$3");
                }
                return hex;
            }

            // Function to validate hex color
            function isValidHex(hex) {
                return /^#[0-9A-F]{6}$/i.test(hex) || /^#[0-9A-F]{3}$/i.test(hex);
            }

            // Sync color picker with HEX input
            $("input[type=color]").on("input", function() {
                var color = expandHex($(this).val());
                $(this).next(".hex-input").val(color);
            });

            // Sync HEX input with color picker
            $(".hex-input").on("input", function() {
                var color = $(this).val();
                if (isValidHex(color)) {
                    var expandedColor = expandHex(color);
                    $(this).prev("input[type=color]").val(expandedColor);
                    $(this).val(expandedColor);
                }
            });

            // Reset functionality
            $(".reset-color").on("click", function(e) {
                e.preventDefault();
                var defaultColor = $(this).data("default");
                var colorInput = $(this).prevAll("input[type=color]");
                var hexInput = $(this).prevAll("input.hex-input");
                colorInput.val(defaultColor);
                hexInput.val(defaultColor);
            });
        });
    ');
}



