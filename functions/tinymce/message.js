/***********************************
*
* TINYMCE PLUGINS
* message Button
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.message', { 
     
        //

        init : function(ed, url) {
            ed.addButton('message', {
                title : 'Message Box',
                onclick : function() {  
                     //ed.selection.setContent('[message file="" style="" label="' + ed.selection.getContent() + '"]');  
                     // triggers the thickbox
                        var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                        W = W - 80;
                        H = H - 84;
                        tb_show( 'Select Your Message Box', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=messagebtn-form' );
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  



    });  
    tinymce.PluginManager.add('message', tinymce.plugins.message);  

    // executes this when the DOM is ready
    jQuery(function(){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="messagebtn-form"><table id="messagebtn-table" class="form-table">\
            <tr>\
                <th><label for="messagebtn-style">Style</label></th>\
                <td><select id="messagebtn-style" name="style" value="info">\
                <option value="info">Info (Blue)</option>\
                <option value="important">Warning/Alert (Yellow)</option>\
                <option value="error">Error (Red)</option>\
                </select></td>\
            </tr>\
        </table>\
        <p class="submit">\
            <input type="button" id="messagebtn-submit" class="button-primary" value="Insert message Button" name="submit" />\
        </p>\
        </div>');
        
        var table = form.find('table');
        form.appendTo('body').hide();
        
        // handles the click event of the submit button
        form.find('#messagebtn-submit').click(function(){


            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = { 
                'style'          : 'info'
                };
            
            for( var index in options) {
                var value = table.find('#messagebtn-' + index).val();

                // Pick your shortcode
                if (value == "info") {var shortcodeType = "info";}
                else if (value == "important") {var shortcodeType = "important";}
                else if (value == "error") {var shortcodeType = "error";}
                
                // Start the shortcode
                shortcode = "["+shortcodeType+"]";

                // attaches the attribute to the shortcode only if it's different from the default value
                //shortcode += ' ' + index + '="' + value + '"';
            }

            shortcode += '[/'+shortcodeType+']';
            
            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            
            // closes Thickbox
            tb_remove();
        });
    });

})();  