$(function() {

                
    $("#ratingicon div").html('<div class="inc button icon-thumbs-up "></div><br/><div class="dec button icon-thumbs-down"></div>');
    

    $(".button").click(function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
    
        if ($button.text() == "+") {
    	  var newVal = parseFloat(oldValue) + 1;
    	  // AJAX save would go here
    	} else {
    	  // Don't allow decrementing below zero
    	  if (oldValue >= 1) {
    	      var newVal = parseFloat(oldValue) - 1;
    	      // AJAX save would go here
    	  }
    	}
    	$button.parent().find("input").val(newVal);
    });

});

function incrementValue(i)
{
    var value = parseInt(document.getElementById('number'+i).value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<10)
    {
    value++;
  }
    document.getElementById('number'+i).value = value;
}
function decreaseValue(i)
{
    var value = parseInt(document.getElementById('number'+i).value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>1)
    {
    value=value-1;
  }
    document.getElementById('number'+i).value = value;
}
