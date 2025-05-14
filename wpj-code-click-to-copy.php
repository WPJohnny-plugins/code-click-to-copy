<?php
/**
 * Plugin Name: Code Click-to-Copy by WPJohnny
 * Plugin URI: https://wpjohnny.com/code-click-to-copy/
 * Description: Click anywhere within <pre> code tags to automatically copy to clipboard.
 * Author: <a href="https://wpjohnny.com">WPJohnny</a>, <a href="https://profiles.wordpress.org/zeroneit/">zerOneIT</a>
 * Donate link: https://www.paypal.me/wpjohnny
 * Version:     0.1.5
 */

/**
 * Load plugin textdomain.
 */
add_action( 'init', 'codeClickToCopyLoadTextdomain' );
function codeClickToCopyLoadTextdomain() {
  load_plugin_textdomain( 'click_to_copy', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}

add_action('wp_footer', 'codeCopyActivate');
function codeCopyActivate(){
	$clickToCopyStr = __('Click to Copy', 'click_to_copy');
	$copiedMessage = __('Copied!', 'click_to_copy');
?>
<div class="codeCopyTooltip" style="display: inline-block; background: #333; color: white; padding: 0 8px; font-size: 14px; border-radius: 2px; border: 1px solid #111; position:absolute; display: none;"><?= $clickToCopyStr; ?></div>
<script type="text/javascript">
	function getElementPosition(el) {
		var rect = el.getBoundingClientRect(),
		scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
		scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		return { top: rect.top + scrollTop - 30, left: rect.left + scrollLeft }
	}

	function applyCodeCopy(element) {
		element.addEventListener("click", function() {
			event.stopPropagation();
			const el = document.createElement('textarea');
			el.value = element.textContent;
			document.body.appendChild(el);
			el.select();
			document.execCommand('copy');
			document.body.removeChild(el);
			codeCopyTooltip.innerHTML = '<?= $copiedMessage; ?>'
		});
		element.addEventListener("mouseover", function() {
			event.stopPropagation();
			var position = getElementPosition(element);
			codeCopyTooltip.innerHTML = '<?= $clickToCopyStr; ?>';
			codeCopyTooltip.style.display = 'inline-block';
			codeCopyTooltip.style.top = position.top + 'px';
			codeCopyTooltip.style.left = position.left + 'px';
		});
		element.addEventListener("mouseout", function() {
			event.stopPropagation();
			var position = getElementPosition(element);
			codeCopyTooltip.style.display = 'none';
			codeCopyTooltip.style.top ='9999px';
		});
	}

	var codeCopyTooltip = document.querySelector('.codeCopyTooltip');

	document.querySelectorAll("code").forEach(function(element) {
		applyCodeCopy(element);
	});
</script>
<?php
};