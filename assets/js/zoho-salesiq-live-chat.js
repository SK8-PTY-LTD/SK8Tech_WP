/**
 * When an element has class `live-chat`, once clicked, open live chat window. 
 * Works on <a> only.
 * @author Jack
 * @see https://help.zoho.com/portal/community/topic/open-salesiq-chat-window-on-button-click
 * @see https://stackoverflow.com/a/49607055/3381997
 * @see https://stackoverflow.com/questions/8908191/use-jquery-click-to-handle-anchor-onclick
 */
(function($){

  $(document).ready(function(){
      // write code here
      $(".live-chat a").click(function() {
			//Do stuff when clicked
			$zoho.salesiq.floatwindow.visible("show");
		});
  });

  // or also you can write jquery code like this

  jQuery(document).ready(function(){
      // write code here
  });

})(jQuery);