<!---d5b496ded8a765c7 -->
<!--- http://api.wunderground.com/api/d5b496ded8a765c7/forecast/q/CA/San_Francisco.json -->
<?php
$yourname = check_input($_POST['yourname']);
$city    = $_POST['city'];
$state    = $_POST['state'];
?>
<html>
    <head>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>

    </head>
    <body>
        <script>

            var mycity = "<?php echo $city; ?>";
            var mystate = "<?php echo $state; ?>";
            mycity = mycity.replace(' ','_');
            var response = '';
            var useinternet = false;
            if(useinternet){
                $.ajax({
                    url: 'http://api.wunderground.com/api/d5b496ded8a765c7/forecast/q/'+mystate+'/'+mycity+'.json',
                    type: 'GET',
                    success: function(res) {
                        response = String(res.responseText);
                        // then you can manipulate your text as you wish
                    }
                });
            }
            else{
                $.getJSON("test.json", function(json) {
                    Process(json);
                });
            }
            function Process(json){
                var simple = json.forecast.simpleforecast.forecastday;
                processArray(simple);
            }
            function processArray(jsonArray){
                var x;
                for (x in jsonArray) {
                    if(String(get_type({})) === String(get_type(jsonArray[x]))){
                        console.log("Going Down");
                        processArray(jsonArray[x]);   
                    }
                    var key = String(x);
                    console.log(x + '::' + jsonArray[x]);
                }

            }
            function get_type(thing){
                if(thing===null)return "[object Null]"; // special case
                return Object.prototype.toString.call(thing);
            }

        </script>
        <p id="demo"></p>

        <div id="City" style = "display: none">
            <?php echo $city; ?>
        </div>
        <div id = "Des"></div>
        <br />
        Your name is: <?php echo $yourname; ?><br />

    </body>
</html>

<?php
function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>