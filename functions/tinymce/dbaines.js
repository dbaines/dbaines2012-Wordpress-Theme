/***********************************
*
* TINYMCE PLUGINS
*
***********************************/
(function() {  

    tinymce.create('tinymce.plugins.dbaines', { 


        init : function(ed, url) {
            ed.addButton('quote', {
                title : 'Highlight selected text',
                image : url+'/image.png',
                onclick : function() {  
                     ed.selection.setContent('[hilight]' + ed.selection.getContent() + '[/hilight]'); 
                }  
            });  

            ed.addButton('wpse-rules', {
                title : 'Highlight selected text',
                image : url+'/image.png',
                onclick : function() {  
                     ed.selection.setContent('[hilight]' + ed.selection.getContent() + '[/hilight]'); 
                }  
            });  

        },  

        createControl : function(n, cm) {  
            return null;  
        },  




    });  
    tinymce.PluginManager.add('download', tinymce.plugins.dbaines);  

})();  