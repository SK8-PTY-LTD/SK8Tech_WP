
/**
* When an element has class `live-chat`, once clicked, open live chat window. 
* Works on <a> only.
* @author Jack
* @see https://help.zoho.com/portal/community/topic/open-salesiq-chat-window-on-button-click
* @see https://stackoverflow.com/questions/8908191/use-jquery-click-to-handle-anchor-onclick
*/
$(document).ready(function() {
    $(".live-chat a").click(function() {
        //Do stuff when clicked
		console.log("Called 1");
    	$zoho.salesiq.floatwindow.visible("show");
    });
});