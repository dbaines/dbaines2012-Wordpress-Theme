/***********************************
*
* TINYMCE PLUGINS
* dividers Button
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.dividers', { 
     
        //

        init : function(ed, url) {
            ed.addButton('dividers', {
                title : 'Insert Divider/Back To Top/Clear',
                onclick : function() {  
                     //ed.selection.setContent('[dividers file="" style="" label="' + ed.selection.getContent() + '"]');  
                     // triggers the thickbox
                        var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                        W = W - 80;
                        H = H - 84;
                        tb_show( 'Select your divider type', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=dividersbtn-form' );
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  



    });  
    tinymce.PluginManager.add('dividers', tinymce.plugins.dividers);  

    // executes this when the DOM is ready
    jQuery(function(){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="dividersbtn-form"><table id="dividersbtn-table" class="form-table">\
            <tr>\
                <th><label for="dividersbtn-type">Type</label></th>\
                <td><select id="dividersbtn-type" name="type" value="3">\
                <option value="hr">HR</option>\
                <option value="backtotop">Back To Top</option>\
                <option value="clear">Empty Clear</option>\
                </select><br />\
                <small>Select your type of divider.</small></td>\
            </tr>\
        </table>\
        <p class="submit">\
            <input type="button" id="dividersbtn-submit" class="button-primary" value="Insert Divider" name="submit" />\
        </p>\
        </div>');
        
        var table = form.find('table');
        form.appendTo('body').hide();
        
        // handles the click event of the submit button
        form.find('#dividersbtn-submit').click(function(){
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = { 
                'type'          : ''
                };
            var shortcode = '[divider';
            
            for( var index in options) {
                var value = table.find('#dividersbtn-' + index).val();
                
                // attaches the attribute to the shortcode only if it's different from the default value
                if ( value !== options[index] )
                    shortcode += ' ' + index + '="' + value + '"';
            }
            
            shortcode += ']';
            
            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            
            // closes Thickbox
            tb_remove();
        });
    });

})();  