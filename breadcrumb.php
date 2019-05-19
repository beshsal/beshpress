
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php bloginfo('url'); ?>">Home</a>
	</li>
	<li class="breadcrumb-item active">
		<?php 
		if (is_single()) {
			ucwords(the_title());
		} elseif (is_search()) {
			if (strlen( trim(get_search_query()) ) == 0) {
      	echo "Empty Search";
    	} else {	
				echo "Search Results for: " . ucwords(get_search_query());
			}
		} elseif (is_author()) {
			echo 'By Author: ' . get_the_author();		
		} elseif (is_category()) {
			echo "Category: "; ucwords(single_cat_title());
		} elseif (is_tag()) {
			echo "Tag: "; single_tag_title();
		} elseif (is_day()) {
	    echo 'By Day: ' . get_the_date();
	  } elseif (is_month()) {
	    echo 'By Month: ' . get_the_date('F Y');
	  } elseif (is_year()) {
	    echo 'By Year: ' . get_the_date('Y');
	  } elseif (is_404()) {
	  	echo "Page Not Found";
	  } elseif (is_post_type_archive()) {
    	post_type_archive_title();
		} else {
			echo ucwords(PAGENAME);
		}		 
		?>
	</li>
</ol>