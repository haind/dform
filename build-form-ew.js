document.write('<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>');
document.write('<script type="text/javascript" src="dist/jquery.dform-1.1.0.min.js"></script>');
document.write('<style type="text/css">input, label {display: block;margin-bottom: 5px;}</style>');
document.write('<script type="text/javascript" class="demo" id="demo-1">$(function () { $.getJSON("form1.json").done(function(data){$("#demo-1-form").dform(data);});});</script>');
document.write('<form id="demo-1-form"></form>');
document.write('Build form successfully');
