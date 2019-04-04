<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("form").submit(function(){
        alert("Submitted");
    });
    $('input[type=file]').change(function() { 
    // select the form and submit
    $('form').submit(); 
});
});
</script>
</head>
<body>

<form action="">
  
  <input type="file" valign="baseline" />
 
</form> 

</body>
</html>


