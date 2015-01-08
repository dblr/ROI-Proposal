<?php
/*
Template Name: PAGE ROI LIST
*/
get_header(); ?>

<!-- Row for main content area -->
	<div class="small-12 large-12 columns listings" role="main">
	<?php if ( current_user_can('manage_options') ) { ?>
	<table id="PDFsort" class="tablesorter">
		<thead>
			<tr>
			  <th width="100"><i class="fi-calendar"></i> Date</th>
			  <th width="300">Proposal Name</th>
			  <th width="250">Sales Rep</th>
			  <th width="150">Approved?</th>
			  <th width="150">PDF</th>
			</tr>
		</thead>
		<tbody>
	<?php /* Start loop */ ?>
		<?php $args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'roi',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true );
		
		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<tr>
				<td><p class="date"><?php  echo '<time class="updated" datetime="'. get_the_time('c') .'" pubdate>'. sprintf(__('%s', 'DiddyDoIt'), get_the_time('m/d/Y')) .'</time>';?></p></td>
				<td><?php the_title(); ?></td>
				<td><?php  echo get_the_author(); ?></td>
				<td>
					<?php if(get_field('approval')){ ?>
						<i class="fi-check large yes"></i><p class="hide">yes</p>
					<?php } else { ?>
						<i class="fi-x no"></i><p class="hide">no</p>
					<?php } ?> 
				</td>
				<td>
					<?php $id = $post->ID; ?>
					<a href="http://lampinator.com/roi/create/?id=<?php echo $id?>" target="_blank">View </a> <i class="fi-paperclip"> </i>

				</td>
			</tr>
		<?php endforeach; 
		wp_reset_postdata();?>
		</tbody>
	</table>
	<?php } else { ?>
	<h1> You don't have access to view this page, please consult your regoinal admin/rep</h1>
<?php } ?>
	</div>
<?php get_footer(); ?>