<?php 
/**
 * Theme Footer Section for our theme.
 * 
 * Displays all of the footer section and closing of the #main div.
 *
 * @package ThemeGrill
 * @subpackage Spacious
 * @since Spacious 1.0
 */
?>

		</div><!-- .inner-wrap -->
	</div><!-- #main -->	
	<?php do_action( 'spacious_before_footer' ); ?>
		<footer id="colophon" class="clearfix">	
			<?php get_sidebar( 'footer' ); ?>	
			<div class="footer-socket-wrapper clearfix">
				<div class="inner-wrap">
					<div class="footer-socket-area">
						<nav class="small-menu" class="clearfix">
							<?php
								if ( has_nav_menu( 'footer' ) ) {									
										wp_nav_menu( array( 'theme_location' => 'footer',
																 'depth'           => -1
																 ) );
								}
							?>
							<script>
								var subject = document.getElementsByClassName('form-subject');
									for (var i = 0; i < subject.length; i++) {
										subject[i].firstChild.firstChild.firstChild.innerHTML = "I need an estimate on...";
									}
									
								var faGlyph = document.getElementsByClassName('wpcf7-list-item');
								    for (var i = 0; i < faGlyph.length; i++) {
								        if(i%2 === 0) {
								        	faGlyph[i].firstChild.innerHTML = "&#xf003;";
								        }else{
								        	faGlyph[i].firstChild.innerHTML = "&#xf095;";
									    }
									}
										
								var ref = document.getElementsByClassName('form-referral');
									for (var i = 0; i < ref.length; i++) {
										ref[i].firstChild.firstChild.firstChild.innerHTML = "How did you hear about us...";									
									}
									
								var refOther = ref[0].firstChild.firstChild;
								
								function onSelectionChange () {
									var selectedOption = refOther.options[refOther.selectedIndex];
							    	if(selectedOption.value == "Other") {
										ref[0].style.width = "48%";
										document.getElementsByClassName("form-other")[0].style.display = "block";
							    	}else{
										ref[0].style.width = "100%";
										document.getElementsByClassName("form-other")[0].style.display = "none";
							    	}
								}
								
								refOther.addEventListener('change', onSelectionChange, false);
								</script>

		    			</nav>
					</div>
				</div>
			</div>			
		</footer>
		<a href="#masthead" id="scroll-up"></a>	
	</div><!-- #page -->
	<!-- SS form tracking -->
	<script type="text/javascript">
    var __ss_noform = __ss_noform || [];
    __ss_noform.push(['baseURI', 'https://app-RI8T90.sharpspring.com/webforms/receivePostback/MzQ2MQEA/']);
    __ss_noform.push(['endpoint', 'd13b6658-7358-495f-bdc0-2a86868a32e1']);
</script>
<script type="text/javascript" src="https://koi-RI8T90.sharpspring.com/client/noform.js?ver=1.0" ></script>
	<!-- GA -->
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52709815-1', 'auto');
  ga('send', 'pageview');

</script>


<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 967291776;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/967291776/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
	<?php wp_footer(); ?>
</body>
</html>