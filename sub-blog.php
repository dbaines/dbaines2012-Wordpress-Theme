<div id="subsection-column1">

	<?php if (getTemplateOption('useWidgets')) : ?>
	    <?php dynamic_sidebar( 'blog-column-1' ); ?>
	<?php else : ?>

	<?php include(TEMPLATEPATH.'/subsections/blog-browse-cats.php'); ?>
	<?php include(TEMPLATEPATH.'/subsections/blog-browse-date.php'); ?>

	<?php endif; ?>

</div>
<div id="subsection-column2">

	<?php if (getTemplateOption('useWidgets')) : ?>
	    <?php dynamic_sidebar( 'blog-column-2' ); ?>
	<?php else : ?>

	<?php include(TEMPLATEPATH.'/subsections/blog-latest-comments.php'); ?>

<?php endif; ?>

</div>
<div id="subsection-column3">

	<?php if (getTemplateOption('useWidgets')) : ?>
	    <?php dynamic_sidebar( 'blog-column-3' ); ?>
	<?php else : ?>

	<?php include(TEMPLATEPATH.'/subsections/lastfm.php'); ?>
	<?php include(TEMPLATEPATH.'/subsections/friends.php'); ?>

	<?php endif; ?>

</div>