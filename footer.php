<?php
/**
 * The template for displaying the footer
 * @package sl-boilerplate-v1
 */
?>

</main>

<footer class="footer">

	<div class="pre-socket"></div><!--pre-socket-->

	<div class="socket">

		<div class="container cols-4">

			<div class="col colophon">&copy; Ross & Ross <?php echo date ('Y');?></div>

			<div class="col sl-boilerplate-v1">

				<a href="https://sl-boilerplate-v1.co.uk"><?php get_template_part('inc/img/sl-boilerplate-v1', 'logo');?></a>

			</div>

			<div class="col mandatory">

				<a href="<?php echo home_url() . '/terms-conditions'; ?>">Terms</a>

				<span class="divider">|</span>

				<a href="<?php echo home_url() . '/privacy-policy'; ?>">Privacy</a>

			</div>

		</div>

	</div>

	</div><!--socket-->

</footer>

</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
