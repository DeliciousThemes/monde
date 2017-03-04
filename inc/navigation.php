<?php
/*

Posts Navigation Function

*/
function monde_navigation($monde_pages = '', $monde_range = 2)
{
	$monde_show_items = ($monde_range * 2)+1; 
	global $paged;
	if($monde_pages == '')
	{
		global $wp_query, $monde_blog_query;
		if (is_page_template('template-blog.php')) {
			$monde_pages = $monde_blog_query->max_num_pages;
		}
		else $monde_pages = $wp_query->max_num_pages;
		if(!$monde_pages)
		{
		 $monde_pages = 1;
		}
	}  

	if(1 != $monde_pages)
		{
		echo "<div class=\"pagenav\">";
		if($paged > 2 && $paged > $monde_range+1 && $monde_show_items < $monde_pages) echo "<a href='".esc_url(get_pagenum_link(1))."'>".esc_html__('&laquo;', 'monde')." ".esc_html__('First', 'monde')."</a>";
		if($paged > 1 && $monde_show_items < $monde_pages) echo "<a href='".esc_url(get_pagenum_link($paged - 1))."'>".esc_html__('&lsaquo;', 'monde')." ".esc_html__('Previous', 'monde')."</a>";

		for ($i=1; $i <= $monde_pages; $i++)
		{
			if (1 != $monde_pages &&( !($i >= $paged+$monde_range+1 || $i <= $paged-$monde_range-1) || $monde_pages <= $monde_show_items ))
				{
					 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".esc_url(get_pagenum_link($i))."' class=\"inactive\">".$i."</a>";
				}
		}

		if ($paged < $monde_pages && $monde_show_items < $monde_pages) echo "<a href=\"".esc_url(get_pagenum_link($paged + 1))."\">".esc_html__('&rsaquo;', 'monde')."</a>";
		if ($paged < $monde_pages-1 &&  $paged+$monde_range-1 < $monde_pages && $monde_show_items < $monde_pages) echo "<a href='".esc_url(get_pagenum_link($monde_pages))."'>".esc_html__('&raquo;', 'monde')."</a>";
		echo "</div>\n";
		}
	}
?>