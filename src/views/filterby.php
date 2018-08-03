<div class="filterby-cat-container">
	<ul>
		<?php foreach( $categories as $category ) : ?>
		<li><a href="javascript:void(0);" class="filterby-category" data-catid="<?php echo esc_attr( $category->term_id ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
		<?php endforeach; ?>
	</ul>
</div>