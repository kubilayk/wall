<!DOCTYPE html>
<html>
  <head>
    <title>Entry_view</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.css" rel="stylesheet" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js?ver=1.3.2'></script>
    <script type="text/javascript" src="js/incrementing.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script> 
          function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    if(value<10)
    {
    value++;
  }
    document.getElementById('number').value = value;
}
function decreaseValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    if(value>0)
    {
    value=value-1;
  }
    document.getElementById('number').value = value;
}
    </script>
  </head>
<body>
  <form>
   <input type="text" id="number" value="0"/> 
   <a href="#"><i class="icon-thumbs-up" onclick="incrementValue()" value="Increment Value"></i> </a>
   <a href="#"><i class="icon-thumbs-down" onclick="decreaseValue()" value="Increment Value"></i> </a>
</form>


                              
  </body>
</html>