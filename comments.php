<?php
/**
 * The comments template file
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */
?>

<div id="comments">
	<?php
	if (have_comments()) :

		newme_comment_nav(); ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 60,
				) );
			?>
		</ul>

		<?php
		newme_comment_nav();
	endif;

	comment_form(); ?>
</div>