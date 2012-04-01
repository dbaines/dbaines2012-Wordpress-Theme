/***********************************
*
* TINYMCE PLUGINS
* codebox Button
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.codebox', { 
     
        //

        init : function(ed, url) {
            ed.addButton('codebox', {
                title : 'Insert Codebox',
                onclick : function() {  
                     //ed.selection.setContent('[codebox file="" style="" label="' + ed.selection.getContent() + '"]');  
                     // triggers the thickbox
                        var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                        W = W - 80;
                        H = H - 84;
                        tb_show( 'Codebox Customisation', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=codeboxbtn-form' );
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  



    });  
    tinymce.PluginManager.add('codebox', tinymce.plugins.codebox);  

    // executes this when the DOM is ready
    jQuery(function(){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="codeboxbtn-form"><table id="codeboxbtn-table" class="form-table">\
            <tr>\
                <th><label for="codeboxbtn-lang">Language</label></th>\
                <td><input type="text" id="codeboxbtn-lang" name="lang" /><br />\
                <small>Scripting Language you\'re using. Defaults to PHP if not set.</small></td>\
            </tr>\
            <tr>\
                <th><label for="codeboxbtn-line">Line (Optional)</label></th>\
                <td><input type="text" id="codeboxbtn-line" name="line" /><br />\
                <small>Line number to start at</small></td>\
            </tr>\
            <tr>\
                <th><label for="codeboxbtn-caption">Caption (Optional)</label></th>\
                <td><input type="text" id="codeboxbtn-caption" name="caption" /><br />\
                <small>Scripting Language you\'re using</small></td>\
            </tr>\
            <tr>\
                <th><label for="codeboxbtn-code">Your Code</label></th>\
                <td><textarea id="codeboxbtn-code" name="code" rows="15"></textarea><br />\
                <small>Insert the code for your code box.</small></td>\
            </tr>\
        </table>\
        <p class="submit">\
            <input type="button" id="codeboxbtn-submit" class="button-primary" value="Insert codebox Button" name="submit" />\
        </p>\
        </div>');
        
        var table = form.find('table');
        form.appendTo('body').hide();
        
        // handles the click event of the submit button
        form.find('#codeboxbtn-submit').click(function(){
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = { 
                'lang'          : '',
                'line'          : '',
                'caption'       : '',
                'code'          : ''
                };
            var shortcode = '[codebox';
            
            for( var index in options) {
                var value = table.find('#codeboxbtn-' + index).val();

                // Check for "code"
                if(index=="code") {
                    // End shortcode and insert code value
                    shortcode += ']'+value+"[/codebox]"
                } else {
                    // If not code, check if needs to be inserted and add it to the shortcode.
                    if ( value !== options[index] ) {
                        shortcode += ' ' + index + '="' + value + '"';
                    }
                }

            }
            
            // inserts the shortcode into the active editor
            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            
            // closes Thickbox
            tb_remove();
        });
    });

})();  