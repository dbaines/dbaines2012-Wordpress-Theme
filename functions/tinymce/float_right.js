/***********************************
*
* TINYMCE PLUGINS
* floatright Button
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.floatright', { 
     
        //

        init : function(ed, url) {
            ed.addButton('floatright', {
                title : 'Float Right',
                onclick : function() {  
                     ed.selection.setContent('[fright]' + ed.selection.getContent() + '[/fright]');
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  



    });  
    tinymce.PluginManager.add('floatright', tinymce.plugins.floatright);  

})();  