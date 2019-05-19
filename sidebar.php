<?php
// If the sidebar is not active, do not include the code below.
if (!is_active_sidebar('sidebar-1')) {
	return;
}
?>

<!-- Sidebar Widgets Column -->
<div class="col-md-5 col-lg-4 animated <?php if (get_query_var('paged') == 0) echo 'fadeInRight'; else echo 'fadeIn'; ?>">
	<div class="sidebar">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
</div>