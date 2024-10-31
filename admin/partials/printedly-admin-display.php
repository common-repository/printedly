<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://expresspixel.com
 * @since      1.0.0
 *
 * @package    Printedly
 * @subpackage Printedly/admin/partials
 */
?>
<?php
$oauth_token = get_option('printedly_oauth_token');
?>
<?php if(!$oauth_token) : ?>
  <div class="wrap">
  <div id="welcome-panel" class="welcome-panel">
		<input type="hidden" id="welcomepanelnonce" name="welcomepanelnonce">
			<div class="welcome-panel-content">
        <br />
        <br />
	<h2>Printedly T-shirt Designer!</h2>
	<p class="about-description">Your online T-shirt designer Control Panel in WordPress.</p>
  <p class="hide-if-no-customize">Get more enquiries, simplify ordering for customers, get quick quotes, unlimited images</p>

	<div class="welcome-panel-column-container">
	<div class="welcome-panel-column">
			<a class="button button-primary button-hero load-customize" href="https://my.printedly.com/oauth/authorize?client_id=3&response_type=code&scope=&redirect_uri=<?php echo admin_url('admin-post.php?action=printedly_oauth') ?>&platform=wordpress">Connect To Control Panel</a>
        <br />
        <br />
        <br />
        <br />
			</div>


	</div>
	</div>
		</div>
		</div>
<? else: ?>
<script type='text/javascript'>//<![CDATA[
    var pymParent = null;
	jQuery(document).ready(function() {
		$ = jQuery;

    $.ajax({
        type: "GET",
        url: "https://my.printedly.com/wordpress/oauth-login",
        contentType: "application/json",
        xhrFields: {
          withCredentials: true
        },
        beforeSend: function(xhr, settings) {
          xhr.setRequestHeader("Authorization", "Bearer <?php echo $oauth_token ?>");
        },
        success: function(data){
          console.log(data);
          $('#printedly_contact_email').text(data.email);
          //var pymParent = new pym.Parent('printedly-frame', "http://my.printedly.com/<?php echo $iframe_url ?>", {});
        }
    });

	});
	//]]>

</script>
<div class="wrap">
<div id="welcome-panel" class="welcome-panel">
  <input type="hidden" id="welcomepanelnonce" name="welcomepanelnonce">
    <div class="welcome-panel-content">
      <br />
      <br />
<h2>Logged in to Printedly as: <strong id="printedly_contact_email"></strong> </h2>
<p class="hide-if-no-customize">Select a section you would like to go to. Note: links will open in a new window.</p>

<div class="welcome-panel-column-container">
<div class="welcome-panel-column">
  <h3>Get Started</h3>
    <a class="button button-primary button-hero load-customize" target="_blank" href="https://my.printedly.com/products">Configure Designer</a>
      <br />
      <br />
      <br />
      <br />
    </div>

    <div class="welcome-panel-column">
		<h3>Configuration and Data</h3>
		<ul>


					<li><a href="https://my.printedly.com/products" target="_blank" class="welcome-icon welcome-cart ">Products</a></li>
			<li><a href="https://my.printedly.com/categories" target="_blank" class="welcome-icon welcome-categories">Categories</a></li>
					<li><a href="https://my.printedly.com/clip-art" target="_blank" class="welcome-icon welcome-clip-art">Clip Art</a></li>
		</ul>
	</div>

  <div class="welcome-panel-column">
		<h3>&nbsp;</h3>
		<ul>
      <li><a href="https://my.printedly.com/pricing" target="_blank" class="welcome-icon welcome-pricing">Pricing</a></li>
  <li><a href="https://my.printedly.com/delivery" target="_blank" class="welcome-icon welcome-delivery">Delivery Settings</a></li>
      <li><a href="https://my.printedly.com/orders" target="_blank" class="welcome-icon welcome-orders">Orders</a></li>
		</ul>
	</div>


</div>
</div>
  </div>
  </div>
<!--<div id="printedly-frame"></div>-->
<!--<iframe seamless id="printedly-frame" src="blank.html" frameborder="0" scrolling="no"></iframe>-->
<? endif; ?>
