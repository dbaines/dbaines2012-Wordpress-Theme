/***********************************
*
* TINYMCE PLUGINS
* demodownload Button
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.demodownload', { 
     
        //

        init : function(ed, url) {
            ed.addButton('demodownload', {
                title : 'Insert a Demo/Download Button',
                onclick : function() {  
                     //ed.selection.setContent('[demodownload file="" style="" label="' + ed.selection.getContent() + '"]');  
                     // triggers the thickbox
                        var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                        W = W - 80;
                        H = H - 84;
                        tb_show( 'demodownload Button Customisation', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=demodownloadbtn-form' );
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },

    });  
    tinymce.PluginManager.add('demodownload', tinymce.plugins.demodownload);  

    // executes this when the DOM is ready
    jQuery(function(){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="demodownloadbtn-form"><table id="demodownloadbtn-table" class="form-table">\
            <tr>\
                <td colspan="2">\
                    <p>Both fields are optional, but at least one field is required to make sure you don\'t look silly.</p>\
                </td>\
            </tr>\
            <tr>\
                <th><label for="demodownloadbtn-demo">Demo</label></th>\
                <td><input type="text" id="demodownloadbtn-demo" name="demo" /><br />\
                <small>Demo URL</small></td>\
            </tr>\
            <tr>\
                <th><label for="demodownloadbtn-download">Download</label></th>\
                <td><input type="text" id="demodownloadbtn-download" name="download" /><br />\
                <small>Download URL</small></td>\
            </tr>\
        </table>\
        <p class="submit">\
            <input type="button" id="demodownloadbtn-submit" class="button-primary" value="Insert Demo/Download Button" name="submit" />\
        </p>\
        </div>');
        
        var table = form.find('table');
        form.appendTo('body').hide();
        
        // handles the click event of the submit button
        form.find('#demodownloadbtn-submit').click(function(){
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = { 
                'demo'          : '',
                'download'      : ''
                };
            var shortcode = '[demodownload';
            
            for( var index in options) {
                var value = table.find('#demodownloadbtn-' + index).val();
                
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