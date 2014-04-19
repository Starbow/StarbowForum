/**
 * Custom script specific to the StarBow forum
 */
(function($, window, undefined) {
    if(window.Starbow !== undefined) {
        throw('The Starbow object is already defined, are you loading this script multiple times?');
    }
    
    window.Starbow = {
        
    };
   
    $(document).ready(function() {
        //Bind toggle handling for spoiler tags
        $('.starbow_spoiler_toggler').on('click', function() {
            $(this).siblings().andSelf().toggle();
        });
        
        //Because MyBB's "MyCode" doesn't seem to support any kind of conditionals
        // (like "if the spoiler title exists, render the title span"), we render
        // the title span as display:none; by default and then show any title spans
        // with non-empty contents
        $('.starbow_spoiler_title').each(function() {
            if($(this).find('.starbow_spoiler_title_contents').contents().length) {
                $(this).show();
            }
        });
    });
})(jQuery, window);