<?php
/**
 * Plugin Name: Code Click-to-Copy by WPJohnny
 * Plugin URI: https://wpjohnny.com/code-click-to-copy/
 * Description: Click anywhere within <pre> code tags to automatically copy to clipboard.
 * Author:      WPJohnny, Chouffy
 * Author URI: https://wpjohnny.com/
 * Donate link: https://www.paypal.me/wpjohnny
 * Version:     0.1.3
 */

add_action('wp_footer', 'codecopy_activate');
function codecopy_activate(){
?>
<div class="codecopy_tooltip" style="display: inline-block; background: #333; color: white; padding: 0 8px; font-size: 14px; border-radius: 2px; border: 1px solid #111; position:absolute; display: none;">Click to Copy</div>
<script type="text/javascript">
	function codecopy_get_element_position(el) {
		var rect = el.getBoundingClientRect(),
		scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
		scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		return { top: rect.top + scrollTop - 30, left: rect.left + scrollLeft }
	}

	function codecopy_apply(element) {
		let drag = false;
		element.addEventListener('mousedown', () => drag = false);
		element.addEventListener('mousemove', () => drag = true);
		element.addEventListener('mouseup', function() {
			if (!drag) {
				event.stopPropagation();
				const el = document.createElement('textarea');
				el.value = element.textContent;
				document.body.appendChild(el);
				el.select();
				document.execCommand('copy');
				document.body.removeChild(el);
				codecopy_tooltip.innerHTML = 'Copied!'
			}			
		});
		element.addEventListener("mouseover", function() {
			event.stopPropagation();
			var position = codecopy_get_element_position(element);
			codecopy_tooltip.innerHTML = 'Click to Copy';
			codecopy_tooltip.style.display = 'inline-block';
			codecopy_tooltip.style.top = position.top + 'px';
			codecopy_tooltip.style.left = position.left + 'px';
		});
		element.addEventListener("mouseout", function() {
			event.stopPropagation();
			var position = codecopy_get_element_position(element);
			codecopy_tooltip.style.display = 'none';
			codecopy_tooltip.style.top ='9999px';
		});
	}

	var codecopy_tooltip = document.querySelector('.codecopy_tooltip');

	document.querySelectorAll("code").forEach(function(element) {
		codecopy_apply(element);
	});
</script>
<?php
};
