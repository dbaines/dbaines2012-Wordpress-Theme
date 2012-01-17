<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>

<div class="homepageSliderWrapper">
<ul class="homepageSlider">

    <?php 

        // Pull the slide count from our Wordpress Theme Options
        // If it's set, set it to what it's set to, if it isn't set, set it to a default value of 5.
        include('functions/get.options.php'); 
        // Sweet, shorthand if statement.
        ($db2011_homeslides) ? $slideCount = $db2011_homeslides : $slideCount = 5;

        // Create an array for the latest Portfoio posts
        // First five posts that match the post types of artwork, websites and motion.
        $portfolioPosts = array( 
        	'numberposts' => $slideCount,
        	'post_type' => array('artwork', 'websites', 'motion')
        );

        // Create an array for the latest Tutorials
        // First five posts that match the category tutorial in the posts post_type
        $tutorialPosts = array(
            //'numberposts' => $slideCount,
            //'category' => '9'
        );

        // get_posts on both of those arrays, baby.
        $lastPortfoios = get_posts( $portfolioPosts );
        $lastTutorials = get_posts( $tutorialPosts );

        // Merge those suckers.
        $sliderPosts = array_merge($lastPortfoios,$lastTutorials);

        // Sorty by [post_date]
        foreach ($sliderPosts as $key => $row) {
            $orderByDate[$key] = $row->post_date;
        }
        $sliderPostsSorted = array_multisort($orderByDate, SORT_DESC, $sliderPosts);


        // Debuging dump
        //var_dump($sliderPosts);

        // Strip the array down to just five results
        // I realise I'm trimming $sliderPosts and not $sliderPostsSorted, I guess the array_multisort 
        // affects the original array as it's now sorted. $sliderPostsSorted is now not an array. Go figure.
        $sliderPostsTrimmed = array_slice($sliderPosts, 0, $slideCount);

        // Start the loop using our trimmed array of 5 tutorials and portfolio posts
        foreach($sliderPostsTrimmed as $post) : setup_postdata($post); 

            // Check for post-type context and apply different variables
    		if ( get_post_type()=='artwork' ) {
                // Artwork post types have images stored in a different area, so let's grab that info
                // This is a convoluted method of getting that data and inserting it in to our SliderImage variable
                $imageid = get_post_meta($post->ID, 'File Upload', true); 
                // This is a method to get the link for the image if you wanted to hyperlink the thumbnail. 
                // I no longer link the thumbnails to larger images but kept it here if someone needed it.
                // $LargeImageLink = wp_get_attachment_url( $imageid );
                $SliderImage = wp_get_attachment_image( $imageid, "Large Slider" );
    		} else {
                // Everything else has the images stored as the post thumbnail
                $SliderImage =  get_the_post_thumbnail( $post->ID, "Large Slider" );
    		}

            // Fallback image for ones without images
            if(!$SliderImage) {
                $SliderImage = "<img src='".get_bloginfo("template_url")."/images/slider_fallback.jpg' alt='".get_the_title()."' />";
            }

        ?>

        <li class="<?php echo get_post_type(); ?>">

            <?php 
            // Lets create some contextual variables
            // $titlePrefix will display either the post type or tutorial string
            // $titleURL will hold the URL to view more of either the post type, or tutorials.
                switch (get_post_type()) {
                    case 'artwork':
                        $titlePrefix = "Artwork";
                        $titleURL = "/artwork/";
                        break;

                    case 'motion':
                        $titlePrefix = "Motion";
                        $titleURL = "/motion/";
                        break;

                    case 'websites':
                        $titlePrefix = "Website";
                        $titleURL = "/websites/";
                        break;

                    case 'post':
                        // Ideally I might want some sort of test for a tutorial category first, in case I was to use more than one category of posts.
                        $titlePrefix = "Tutorial";
                        $titleURL = "/blog/category/tutorials/";
                }
            ?>

            <?php
                // Now lets seperate the tutorials from the portfolio posts and display them differently.
                if ( $titlePrefix == "Tutorial") : ?>
                    
                    <div class="sliderPostLeft">

                        <figure class="tutorial-image">
                            <a href="<?php the_permalink(); ?>" title="Read Tutorial: <?php the_title(); ?>">
                                <?php if (has_post_thumbnail()) : // If has post thumbnail ?>
                                    <?php the_post_thumbnail(); ?>
                                <?php else : // if doesn't have post thumbnail, show default fallback ?>
                                    <img src="<?php bloginfo('template_url'); ?>/images/tutorial-thumbnail.png" alt="tutorial" />
                                <?php endif; ?>
                            </a>
                        </figure>

                    </div>
                    <div class="sliderPostRight">

                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

                        <div class="entry-meta">
                            Posted on <time datetime="<?php the_date('c'); ?>" pubdate><?php the_time('F jS, Y') ?> at exactly <?php the_time('g:i a') ?></time>
                        </div><!-- .entry-meta -->
            
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                            <div class="clear"></div>
                        </div>

                    </div>

                    <hgroup class="sliderTitle">
                        <h3><a href="<?php echo($titleURL); ?>" title="View more"><?php echo($titlePrefix); ?></a></h3><br />
                        <h2>
                        <?php if(get_post_type() == "artwork") : ?>
                            <a href="<?php echo($titleURL) ?>?trigger=<?php the_id(); ?>" title="View <?php the_title(); ?>" class="colorboxThis" id="post<?php the_id(); ?>"><?php the_title(); ?></a>
                        <?php else : ?>
                            <a href="<?php the_permalink(); ?>" title="View <?php the_title(); ?>"><?php the_title(); ?></a>
                         <?php endif; ?>
                        </h2><br />
                        <h4><?php the_date(); ?></h4>
                    </hgroup>


            <?php 
                // Non-tutorial posts will display like so:
                else: ?>

                <?php echo $SliderImage; ?>
                <hgroup class="sliderTitle">
                
                    <h3><a href="<?php echo($titleURL); ?>" title="View more"><?php echo($titlePrefix); ?></a></h3><br />
                    <h2>
                    <?php if(get_post_type() == "artwork") : ?>
                        <a href="<?php echo($titleURL) ?>?trigger=<?php the_id(); ?>" title="View <?php the_title(); ?>" class="colorboxThis" id="post<?php the_id(); ?>"><?php the_title(); ?></a>
                    <?php else : ?>
                        <a href="<?php the_permalink(); ?>" title="View <?php the_title(); ?>"><?php the_title(); ?></a>
                     <?php endif; ?>
                    </h2><br />
                    <h4><?php the_date(); ?></h4>
                </hgroup>

            <?php endif; ?>
        </li>
    
        <?php 
        // End The Loop
        endforeach; 
    ?>
</ul>
</div>

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>