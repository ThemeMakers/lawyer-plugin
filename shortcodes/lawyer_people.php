<?php
/* People Shortcode */

vc_map(
	array(
		'name'        => esc_html__( 'People', 'js_composer' ),
		'base'        => 'lawyer_people',
		'params'      => array(
			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Style',
				'param_name'  => 'style',
				'value' 	  => array(
					'Style 1' 	=> 'style1',
					'Style 2'   => 'style2',
					'Style 3'   => 'style3'
				)
			),

			array(
				'type' 		  => 'dropdown',
				'heading' 	  => 'Pagination',
				'param_name'  => 'pagination',
				'value' 	  => array(
					'Disable' 	=> 'disable',
					'Enable'    => 'enable'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => 'Sorting Order',
				'param_name' => 'order',
				'value'      => array(
					'descending' => 'DESC',
					'ascending'  => 'ASC'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => 'Sort by parameter',
				'param_name' => 'order_by',
				'value'      => array(
					'No order'                     => 'none',
					'Order by post id'             => 'ID',
					'Order by author'              => 'author',
					'Order by title'               => 'title',
					'Order by post name'           => 'name',
					'Order by date'                => 'date',
					'Order by last modified date'  => 'modified',
					'Order by post/page parent id' => 'parent',
					'Random order'                 => 'rand'

				)
			),

			array(
				'type' 		  => 'textfield',
				'heading' 	  => esc_html__( 'Post Limit', 'js_composer' ),
				'param_name'  => 'limit',
				'description' => esc_html__( 'If pagination is enabled this options works as post per page.', 'js_composer' ),
			),

			array(
				'type'        => 'textfield',
				'heading'     => esc_html__( 'Predefined ids', 'js_composer' ),
				'param_name'  => 'predefined',
				'description' => 'People post ids, comma separated(ex. 12, 23, 152).'
			),

			array(
				'type' 		  => 'textfield',
				'heading' 	  => esc_html__( 'Extra class name', 'js_composer' ),
				'param_name'  => 'el_class',
				'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
				'value' 	  => ''
			),
			/* CSS editor */
			array(
				'type' 		  => 'css_editor',
				'heading' 	  => esc_html__( 'CSS box', 'js_composer' ),
				'param_name'  => 'css',
				'group' 	  => esc_html__( 'Design options', 'js_composer' )
			)

		)
	)

);
class WPBakeryShortCode_lawyer_people extends WPBakeryShortCode{
	protected function content( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'style'      => 'style1',
			'pagination' => 'disable',
			'order'      => 'DESC',
			'order_by'    => 'date',
			'limit'      => '',
			'predefined' => '',
			'el_class'   => '',
			'css'        => ''
		), $atts ) );

		$class  = ( ! empty( $el_class ) ) ? $el_class : '';
		$class .= vc_shortcode_custom_css_class( $css, ' ' );

		$limit = ! empty( $limit ) ? $limit : 4;
		$order = isset( $order ) ? $order : 'DESC';
		$order_by = isset( $order_by ) ? $order_by : 'date';

		$args = array(
			'post_type'           => 'people',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => $limit,
			'orderby'             => $order_by,
			'order'               => $order
		);

		if ( ! empty( $predefined ) ) {
			$args['post__in'] = explode( ',', $predefined );
		}

		// For pagination option
		if( $pagination == 'enable' ) {	
			$page = is_front_page() ? 'page' : 'paged';
	        $paged = get_query_var( $page ) ? get_query_var( $page ) : 1;
	        $args['paged'] = $paged;
		}

		$artcl = new WP_Query( $args );
		if ( $artcl->have_posts() ) {
			ob_start(); 
			if ( $style == 'style1' ) { ?>
				<div class="row <?php echo esc_attr( $class );?>">
					<div class="columns small-12">
						<div class="row team-person-wrapper small-collapse">
							<div class="columns small-12">
								<div class="row">
									<?php
									while ( $artcl->have_posts() ) {
										$artcl->the_post();
										$meta_data = get_post_meta( get_the_ID(), 'people_options', true ); 
										$people_id = get_the_ID(); 
										$location = get_post_meta( $people_id, 'people-location', true ); 
										$city = get_post( $location );

										$person__position = ! empty( $location ) ? $city->post_title : '';
										if ( ! empty( $person__position ) ) {
											$person__position .= ! empty( $meta_data['position'] ) ? ', ' . $meta_data['position'] : '';
										} else {
											$person__position = ! empty( $meta_data['position'] ) ? $meta_data['position'] : '';
										} ?>
										<div class="small-12 medium-6 large-3 column">
											<div class="team-person team-person--style-2">
												<?php if ( has_post_thumbnail() ): ?>
													<div class="team-person__img effect-apollo">
														<?php the_post_thumbnail(); ?>
														<div class="effect-apollo__overlay"></div>
													</div>
												<?php endif ?>
												<div class="team-person__data">
													<?php the_title( '<h5 class="team-person__name">', '</h5>' ); ?>
													<p class="team-person__position"><?php echo esc_html( $person__position ); ?></p>
													<?php if ( ! empty( $meta_data['phone'] ) ): ?>
														<a href="tel:<?php echo esc_html( $meta_data['phone'], 'tel' ) ?>" class="team-person__contact"><?php echo esc_html( $meta_data['phone'] ); ?></a>
													<?php endif ?>
													<?php if ( ! empty( $meta_data['email'])): ?>
														<a href="mailto:<?php echo esc_html( $meta_data['email'], 'mailto' ) ?>" class="team-person__contact"><?php echo esc_html( $meta_data['email'] ); ?></a>
													<?php endif ?>
													<a href="<?php the_permalink(); ?>" class="team-person__link"><?php esc_html_e( 'View profile', 'lawyer-plugin' ); ?></a>
												</div>
											</div>
										</div>
									<?php } ?>
								</div>
								<?php
								if( $pagination == 'enable' ) {
									lawyer_shortcode_pagination( $artcl->max_num_pages );
								}
								wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</div>
			
			<?php } 
			if( $style == 'style2' ) { ?>
				<div class="row <?php echo esc_attr( $class );?>">
					<?php
					while ( $artcl->have_posts() ) {
						$artcl->the_post();
						$meta_data = get_post_meta( get_the_ID(), 'people_options', true ); 
						$people_id = get_the_ID(); 
						$location = get_post_meta( $people_id, 'people-location', true ); 
						$city = get_post( $location );

						$person__position = ! empty( $location ) ? $city->post_title : '';
						if ( ! empty( $person__position ) ) {
							$person__position .= ! empty( $meta_data['position'] ) ? ', ' . $meta_data['position'] : '';
						} else {
							$person__position = ! empty( $meta_data['position'] ) ? $meta_data['position'] : '';
						} ?>
						<div class="small-6 medium-4 large-2 column">
							<div class="team-person">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="team-person__img effect-apollo">
										<?php the_post_thumbnail(); ?>
										<div class="effect-apollo__overlay"></div>
									</div>
								<?php endif ?>
								<?php the_title( '<h5 class="team-person__name">', '</h5>' ); ?>
								<p class="team-person__position"><?php echo esc_html( $person__position ); ?></p>
								<a href="<?php the_permalink(); ?>" class="team-person__link"><?php esc_html_e( 'View profile', 'lawyer-plugin' ); ?></a>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php 
				if( $pagination == 'enable' ) {
					lawyer_shortcode_pagination( $artcl->max_num_pages );
				}
				wp_reset_postdata(); ?>
			<?php } 
			if( $style == 'style3' ) { ?>
				<div class="row <?php echo esc_attr( $class );?>">
					<?php
					while ( $artcl->have_posts() ) {
						$artcl->the_post();
						$meta_data = get_post_meta( get_the_ID(), 'people_options', true );
						$people_id = get_the_ID(); 
						$location = get_post_meta( $people_id, 'people-location', true ); 
						$city = get_post( $location );

						$person__position = ! empty( $location ) ? $city->post_title : '';
						if ( ! empty( $person__position ) ) {
							$person__position .= ! empty( $meta_data['position'] ) ? ', ' . $meta_data['position'] : '';
						} else {
							$person__position = ! empty( $meta_data['position'] ) ? $meta_data['position'] : '';
						} ?>
						<div class="small-6 medium-3 column bg-1">
							<div class="team-person">
								<?php if ( has_post_thumbnail() ): ?>
									<div class="team-person__img effect-apollo">
										<?php the_post_thumbnail(); ?>
										<div class="effect-apollo__overlay"></div>
									</div>
								<?php endif ?>
								<?php the_title( '<h5 class="team-person__name">', '</h5>' ); ?>
								<p class="team-person__position"><?php echo esc_html( $person__position ); ?></p>
								<a href="<?php the_permalink(); ?>" class="team-person__link"><?php esc_html_e( 'View profile', 'lawyer-plugin' ); ?></a>
							</div>
						</div>
					<?php } ?>
				</div>
				<?php
				if( $pagination == 'enable' ) {
					lawyer_shortcode_pagination( $artcl->max_num_pages );
				}
				wp_reset_postdata(); ?>
			<?php }

			wp_reset_postdata();
			return ob_get_clean();
		}
	}
}