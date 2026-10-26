<form method="get" class="searchform" action="<?php bloginfo('url'); ?>/">
	<div>
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="search-input" placeholder="Search Here" />
		<span class="search_close ion" style="display: none;">&#xf129;</span>
	</div>
</form>
