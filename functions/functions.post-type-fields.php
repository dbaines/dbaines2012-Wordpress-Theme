<?php
/***********************************
*
* CUSTOM POST TYPE FIELD OPTIONS
* db2012
* http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-1-intro-and-basic-fields/
* http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-2-advanced-fields/
* http://wp.tutsplus.com/tutorials/reusable-custom-meta-boxes-part-3-extra-fields/
*
***********************************/

// Reusable Field Array
$prefix = 'db_';  
$custom_meta_fields = array(  
    array(  
        'label'=> 'Text Input',  
        'desc'  => 'A description for the field.',  
        'id'    => $prefix.'text',  
        'type'  => 'text'  
    ),  
    array(  
        'label'=> 'Textarea',  
        'desc'  => 'A description for the field.',  
        'id'    => $prefix.'textarea',  
        'type'  => 'textarea'  
    ),  
    array(  
        'label'=> 'Checkbox Input',  
        'desc'  => 'A description for the field.',  
        'id'    => $prefix.'checkbox',  
        'type'  => 'checkbox'  
    ),  
    array(  
        'label'=> 'Select Box',  
        'desc'  => 'A description for the field.',  
        'id'    => $prefix.'select',  
        'type'  => 'select',  
        'options' => array (  
            'one' => array (  
                'label' => 'Option One',  
                'value' => 'one'  
            ),  
            'two' => array (  
                'label' => 'Option Two',  
                'value' => 'two'  
            ),  
            'three' => array (  
                'label' => 'Option Three',  
                'value' => 'three'  
            )  
        )  
    )  
); 

// The Callback  
function show_custom_meta_box() {  
global $custom_meta_fields, $post;  

// Use nonce for verification  
echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';  
  
    // Begin the field table and loop  
    echo '<table class="form-table">';  
    foreach ($custom_meta_fields as $field) {  
        // get value of this field if it exists for this post  
        $meta = get_post_meta($post->ID, $field['id'], true);  
        // begin a table row with  
        echo '<tr> 
                <th><label for="'.$field['id'].'">'.$field['label'].'</label></th> 
                <td>';  
                switch($field['type']) {  
                    // case items will go here  
                } //end switch  
        echo '</td></tr>';  
    } // end foreach  
    echo '</table>'; // end table  
} 

?>