$(document).ready(function(){

    var username = $("#username"),
      
      password = $("#password"),
      allFields = $([]).add(name).add(password),
      tips = $(".validateTips");
    function updateTips(t) {
      tips
        .text(t)
        .addClass("ui-state-highlight");
      setTimeout(function() {
        tips.removeClass("ui-state-highlight",1500);
      }, 500 );
    }
 
    function checkLength(o,n,min,max) {
      if ( o.val().length > max || o.val().length < min ) {
        o.addClass("ui-state-error");
        updateTips("Length of " + n + " must be between " +
          min + " and " + max + ".");
        return false;
      } else {
        return true;
      }
    }
 
    function checkRegexp(o,regexp,n) {
      if ( !( regexp.test(o.val()))) {
        o.addClass("ui-state-error");
        updateTips( n );
        return false;
      } else {
        return true;
      }
    }
    $("#dialog-form").dialog({
      autoOpen: false,
      height: 300,
      width: 350,
      modal: true,
      buttons: {
        "Login": function() {
          var bValid = true;
          allFields.removeClass( "ui-state-error" );
          bValid = bValid && checkLength( $("#username"), "username", 1, 16 );
         // bValid = bValid && checkLength( $("#password"), "password", 3, 16 );
          bValid = bValid && checkRegexp($("#username"), /^[a-z]([0-9a-z_])+$/i, "Username may consist of a-z, 0-9, underscores, begin with a letter." );
          // From jquery.validate.js (by joern), contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
         //bValid = bValid && checkRegexp( $("#password"), /^([0-9a-zA-Z])+$/, "Password field only allow : a-z 0-9" );
 
          if ( bValid ) {
             $("#login_form").submit();
             return false;  
          }
        },
       Signup: function() {
           window.location = "../wall/webroot/account";
        }
      },
      close: function() {
        allFields.val( "" ).removeClass( "ui-state-error" );
      }
    });
  

    $( ".create-user" ).click(function() {
        $( "#dialog-form" ).dialog( "open" );
      });


});
