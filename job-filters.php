<?php
/* 
 * this file is located in wp-content/themes/jobify/job-filters.php
 *
 */

$s_categories 	= get_option( 'job_manager_enable_categories' ) && get_terms( 'job_listing_category' );
$s_regions 		= get_terms( 'job_listing_region' );
wp_enqueue_script( 'wp-job-manager-ajax-filters' );
?>

<form class="job_filters">

	<div class="search_jobs">
		<div class="row">
			<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

			<div class="<?php echo $s_categories ? 'col-md-6 col-sm-6' : 'col-md-12 col-sm-12'; ?> col-xs-12 search_location">
				<label for="search_location"><?php _e( 'Location', 'jobify' ); ?></label>			
				<div class="has-select">
					<div class="select">
						<select name="search_region" id="search_region">
							<option value="0" selected="selected">Alle regios</option>
							<?php foreach ( $s_regions as $region ) { ?>
							<option value="<?php echo $region->slug; ?>"><?php echo $region->name; ?></option>
							<?php } ?>
						</select>				
					</div>
				</div>	
			</div>

			<?php if ( $categories ) : ?>
				<?php foreach ( $categories as $category ) : ?>
					<input type="hidden" name="search_categories[]" value="<?php echo sanitize_title( $category ); ?>" />
				<?php endforeach; ?>
			<?php elseif ( $show_categories && $s_categories && ! is_tax( 'job_listing_category' ) ) : ?>
				<div class="col-md-6 col-sm-12 search_categories">
					<label for="search_categories"><?php _e( 'Category', 'jobify' ); ?></label>
					<?php wp_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => __( 'All Job Categories', 'jobify' ), 'name' => 'search_categories', 'orderby' => 'name' ) ); ?>
				</div>
			<?php endif; ?>

			<?php /* OLD REMOVED THIS!!!
			<div class="<?php echo $s_categories ? 'col-md-6 col-sm-6' : 'col-md-12 col-sm-12'; ?> col-xs-12 search_location">
				<label for="search_location"><?php _e( 'Location', 'jobify' ); ?></label>
				<div class="has-select">
					<div class="select">
						<select name="search_location" id="search_location">
							<option value="0" selected="selected">Alle regios</option>
							<?php foreach ( $s_regions as $region ) { ?>
							<option value="<?php echo $region->name; ?>"><?php echo $region->name; ?></option>
							<?php } ?>
						</select>				
					</div>
				</div>		
			</div>

			<div class="<?php echo $s_categories ? 'col-md-4 col-sm-6' : 'col-md-5 col-sm-6'; ?> col-xs-12 search_keywords">
				<label for="search_keywords"><?php _e( 'Keywords', 'jobify' ); ?></label>
				<input type="text" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e( 'All Jobs', 'jobify' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
			</div>

			<div class="<?php echo $s_categories ? 'col-md-3 col-sm-6' : 'col-md-5 col-sm-6'; ?> col-xs-12 search_location">
				<label for="search_location"><?php _e( 'Location', 'jobify' ); ?></label>
				<input type="text" name="search_location" id="search_location" placeholder="<?php esc_attr_e( 'Any Location', 'jobify' ); ?>" value="<?php echo esc_attr( $location ); ?>" />
			</div>
			*/ ?>

			<?php // do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>
		</div>
	</div>

	<?php if ( ! is_tax( 'job_listing_type' ) && empty( $job_types ) ) : ?>
		<ul class="job_types">
			<?php foreach ( get_job_listing_types() as $type ) : ?>
				<li><label for="job_type_<?php echo $type->slug; ?>" class="<?php echo sanitize_title( $type->name ); ?>"><input type="checkbox" name="filter_job_type[]" value="<?php echo $type->slug; ?>" <?php checked( 1, 1 ); ?> id="job_type_<?php echo $type->slug; ?>" /> <?php echo $type->name; ?></label></li>
			<?php endforeach; ?>
		</ul>
	<?php elseif ( $job_types ) : ?>
		<?php foreach ( $job_types as $job_type ) : ?>
			<input type="hidden" name="filter_job_type[]" value="<?php echo sanitize_title( $job_type ); ?>" />
		<?php endforeach; ?>
	<?php endif; ?>

	<div class="showing_jobs"></div>
</form>
