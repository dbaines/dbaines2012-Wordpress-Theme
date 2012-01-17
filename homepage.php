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
        // Sweet, shorthand if statement.
        (getTemplateOption(homeslides)) ? $slideCount = getTemplateOption(homeslides) : $slideCount = 5;

        // Create an array for the latest Portfoio posts
        // First five posts that match the post types of artwork, websites and motion.
        $portfolioPosts = array( 
        	'numberposts' => $slideCount,
        	'post_type' => array('artwork', 'websites', 'motion')
        );

        // Create an array for the latest Tutorials
        // First five posts that match the category tutorial in the posts post_type
        $tutorialPosts = array(
            'numberposts' => $slideCount,
            'category' => getTemplateOption(slidePostCategory)
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

        <li>
            <?php echo $SliderImage; ?>
            <hgroup class="sliderTitle">
            <?php 
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
                        $titlePrefix = "Tutorial";
                        $titleURL = "/blog/category/tutorials/";
                }
            ?>
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
        </li>
    
        <?php 
        // End The Loop
        endforeach; 
    ?>
</ul>
</div>

<?php include(TEMPLATEPATH.'/subsection.php'); ?>
<?php get_footer(); ?>