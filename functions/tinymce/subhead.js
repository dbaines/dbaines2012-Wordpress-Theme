/***********************************
*
* TINYMCE PLUGINS
* subhead Button
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.subhead', { 
     
        //

        init : function(ed, url) {
            ed.addButton('subhead', {
                title : 'subhead Button',
                onclick : function() {  
                     //ed.selection.setContent('[subhead file="" style="" label="' + ed.selection.getContent() + '"]');  
                     // triggers the thickbox
                        var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                        W = W - 80;
                        H = H - 84;
                        tb_show( 'subhead Button Customisation', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=subheadbtn-form' );
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  



    });  
    tinymce.PluginManager.add('subhead', tinymce.plugins.subhead);  

    // executes this when the DOM is ready
    jQuery(function(){
        // creates a form to be displayed everytime the button is clicked
        // you should achieve this using AJAX instead of direct html code like this
        var form = jQuery('<div id="subheadbtn-form"><table id="subheadbtn-table" class="form-table">\
            <tr>\
                <th><label for="subheadbtn-file">URL</label></th>\
                <td><input type="text" id="subheadbtn-file" name="file" /><br />\
                <small>The path to your file or link.</small></td>\
            </tr>\
            <tr>\
                <th><label for="subheadbtn-style">Style</label></th>\
                <td><select id="subheadbtn-style" name="style" value="3">\
                <option value="file">File</option>\
                <option value="archive">Archive</option>\
                <option value="pdf">PDF</option>\
                <option value="psd">PSD</option>\
                <option value="photo">Photo</option>\
                <option value="email">Email</option>\
                <option value="love">Love</option>\
                <option value="lock">Lock</option>\
                <option value="book">Book</option>\
                <option value="mouse">Mouse</option>\
                <option value="tick">Tick</option>\
                <option value="add">Add</option>\
                <option value="cancel">Cancel</option>\
                <option value="rss">RSS</option>\
                <option value="search">Search</option>\
                <option value="settings">Settings</option>\
                <option value="comment">Comment</option>\
                <option value="star">Star</option>\
                <option value="noicon">No Icon</option>\
                </select><br />\
                <small>Icon to show on subhead button.</small></td>\
            </tr>\
            <tr>\
                <th><label for="subheadbtn-label">Label</label></th>\
                <td><input type="text" id="subheadbtn-label" name="label" /><br />\
                <small>The label for your button.</small></td>\
            </tr>\
        </table>\
        <p class="submit">\
            <input type="button" id="subheadbtn-submit" class="button-primary" value="Insert subhead Button" name="submit" />\
        </p>\
        </div>');
        
        var table = form.find('table');
        form.appendTo('body').hide();
        
        // handles the click event of the submit button
        form.find('#subheadbtn-submit').click(function(){
            // defines the options and their default values
            // again, this is not the most elegant way to do this
            // but well, this gets the job done nonetheless
            var options = { 
                'file'          : '#nothing',
                'style'         : 'file',
                'label'         : 'subhead my file'
                };
            var shortcode = '[subhead';
            
            for( var index in options) {
                var value = table.find('#subheadbtn-' + index).val();
                
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