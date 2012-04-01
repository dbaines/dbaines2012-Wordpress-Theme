/***********************************
*
* TINYMCE PLUGINS
* Code Button
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.highlight', { 
     
        //

        init : function(ed, url) {
            ed.addButton('highlight', {
                title : 'Highlight selected text',
                onclick : function() {  
                     ed.selection.setContent('[hilight]' + ed.selection.getContent() + '[/hilight]'); 
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  



    });  
    tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);  

})();  