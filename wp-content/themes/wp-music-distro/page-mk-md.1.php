<?php
/*
Template Name: Marching Knights MusicDistro
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					                        
                        <!--// PAGE HEADER //-->
						<header>
							
							<div class="page-header">
                            	<h1>
									<?php the_title(); ?>
                                    <a class="btn btn-warning pull-right" href="#"><span class="glyphicon glyphicon-exclamation-sign"></span> Report Issue</a>
                                </h1>
                            </div>
						
						</header> <!-- end article header -->
					
						
                        
                        <!--// INSTRUMENT SELECTION -->
						<?php 
							// id of the parent category called "Marching Knights" 
							$parent_cat = 8;
						?>

                        
                        
                        <div class="row">
                        	<div class="col-xs-3">
                                
                                
                                <form class="form-horizontal" role="form">
                                	                                     
                                    
									<?php 
										
										// Find the selected instrument
										$selected = isset($_REQUEST['cat']) && $_REQUEST['cat'] != '' ? $_REQUEST['cat'] : 0;
										
										echo '<h3>' . $selected . ' was selected</h3>';
										
										// Parameters for category dropdown
										$catArgs = array(
											'show_option_all'    => '',
											'show_option_none'   => '',
											'orderby'            => 'ID', 
											'order'              => 'ASC',
											'show_count'         => 1,
											'hide_empty'         => 0, 
											'child_of'           => $parent_cat,
											'exclude'            => '',
											'echo'               => 1,
											'selected'           => $selected,
											'hierarchical'       => 0, 
											'name'               => 'cat',
											'id'                 => '',
											'class'              => 'form-control',
											'depth'              => 0,
											'tab_index'          => 0,
											'taxonomy'           => 'download_category',
											'hide_if_empty'      => false,
											'walker'             => ''
										);
                                    	
										// Display dropdown for categories
										wp_dropdown_categories( $catArgs );
									?>                 
                                    
                                    <br>
                                    
                                    <!-- Submit Button -->
                                    <button type="submit" class="btn btn-primary">Go</button>                          
                                
                                </form>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                        
                        
                        <br>
                        
                        
                        <!-- Another Row -->
                        <div class="row">
                        	<div class="col-md-12">
                        		
								<?php
                                	
									// If an instrument was selected
                                    if($selected)
                                    {
                                        // For Testing
                                        echo '<p>' . $selected . ' was selected</p>';
										
										
										// Args for Arrangements wp_query
										$arrangementSelection = array(
											'post_type'			=> 'download',
											'cat'				=> $selected,
											'fields'			=> 'ids'
										);
										
										// Array of all the songs for the selected instrument
										$arrangements = new WP_Query( $arrangementSelection );
										
										
										// For Testing
										echo '<p><b>Arrangements: </b><br>';
										foreach($arrangements as $arrangement => $id)
										{
											echo $id . '<br>';
										}
										echo '</p>';
										
																				
										// Array of all types of songs (Via tags)
										$tags = wp_get_object_terms( $arrangements, 'post_tag', $optionalArgs = array() );
										
										
										// Loop through each tag and make a box for it
										foreach( $tags as $tag )
										{ ?>
                                        
                                              <div class="col-md-4">
                                                    <!-- School Songs -->
                                                    <div class="panel panel-warning">
                                                      <div class="panel-heading"><?php echo $tag->name; ?></div>
                                                      <div class="panel-body">
                                                        Panel content
                                                      </div>
                                                    </div>
                                              </div><!-- /.col-md-4 -->						
                                        
                                        <?php } // foreach $tags
										
										
                                    } // If $selected	
                                
                                ?>
                        
                        	</div><!-- /.col -->
                        </div><!-- /.row -->
					
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>