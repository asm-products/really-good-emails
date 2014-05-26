<!-- Facebook Like -->
<div class="socialButton facebook">

	<div id="fb-root"></div>

	<script>(function(d, s, id) {

	var js, fjs = d.getElementsByTagName(s)[0];

	if (d.getElementById(id)) return;

	js = d.createElement(s); js.id = id;

	js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";

	fjs.parentNode.insertBefore(js, fjs);

	}(document, 'script', 'facebook-jssdk'));</script>

	<div class="fb-like" data-href="<?php echo get_permalink(); ?>" data-send="false" data-layout="button_count" data-show-faces="false"></div>

</div>



<!-- Twitter Tweet -->
<div class="socialButton twitter">

	<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

</div>



<!-- Google Plus 1 -->
<div class="socialButton google">

	<div class="g-plusone"></div>

	<script type="text/javascript">

	(function() {

	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;

	po.src = 'https://apis.google.com/js/plusone.js';

	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);

	})();

	</script>

</div>



<!-- Pinterest Pin -->
<div class="socialButton pinterest">

	<?php // vars
	
	$thetitle = str_replace(' ', '%20', get_the_title());

	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'standard' ); ?>

	<a href="//pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;media=<?php echo $image[0]; ?>&amp;description=<?php echo $thetitle; ?>" data-pin-do="buttonPin" data-pin-config="beside">

	<img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" alt="Pint It"/>

	</a>

	<script type="text/javascript">

	(function(d){

	var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');

	p.type = 'text/javascript';

	p.async = true;

	p.src = '//assets.pinterest.com/js/pinit.js';

	f.parentNode.insertBefore(p, f);

	}(document));

	</script>

</div>