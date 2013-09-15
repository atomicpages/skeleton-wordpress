<?php

if ( !defined('ABSPATH')) exit;

/**
 * Page metadata template part file. Things like comment links, author, date/time, etc.
 *
 * @file           post-meta.php
 * @package        Skeleton WP
 * @author         Dennis Thompson
 * @copyright      2009 - 2013 AtomicPages LLC
 * @license        license.txt
 * @version        Release: 0.14.0
 * @link           http://codex.wordpress.org/Templates
 * @since          available since release 1.0
 */

?>

<h1 class="entry-title post-title"><?php the_title(); ?></h1>

<?php if ( comments_open() ) : ?>
<div class="post-meta">
<?php responsive_post_meta_data(); ?>
	<?php if ( comments_open() ) : ?>
		<span class="comments-link">
		<span class="mdash">&mdash;</span>
	<?php comments_popup_link(__('No Comments &darr;', 'responsive'), __('1 Comment &darr;', 'responsive'), __('% Comments &darr;', 'responsive')); ?>
		</span>
	<?php endif; ?>
</div><!-- end of .post-meta -->
<?php endif; ?>