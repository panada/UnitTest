<div id="modelResult">
    <h2>Models</h2>

</div>

<script src="/septiadi/site/js/jquery.js"></script>
<script>
    
    <?php
    $i = 1;
    foreach ($models as $val)
    {
        ?>      
        $( "#modelResult" ).append( "<div id='<?=$i?>'></div><hr>" );
        
        //~ $.get( "UnitTest/test?f=<?=$val?>", function( data ) {
            //~ 
            //~ var n = data.indexOf("error");
            //~ if(n != -1){
               //~ data = '<font color=\"red\">'+data+'</font>';
            //~ }
            //~ 
            //~ $( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
        //~ });  
        
        
        $.ajax({
            url: "UnitTest/test?f=<?=$val?>",
            statusCode: {
                200: function(data) {            
                    var n = data.indexOf("error");
                    if(n != -1){
                       data = '<font color=\"red\">'+data+'</font>';
                    }
                    $( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                301: function() {
                    data = '<font color=\"red\"><b>Error 301</b> - Moved Permanently</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                400: function() {
                    data = '<font color=\"red\"><b>Error 400</b> - Bad Request</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                401: function() {
                    data = '<font color=\"red\"><b>Error 401</b> - Unauthorized</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                403: function() {
                    data = '<font color=\"red\"><b>Error 403</b> - Forbidden</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                404: function() {
                    data = '<font color=\"red\"><b>Error 404</b> - Not Found</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                408: function() {
                    data = '<font color=\"red\"><b>Error 408</b> - Request Timeout</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                409: function() {
                    data = '<font color=\"red\"><b>Error 409</b> - Conflict</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                500: function() {
                    data = '<font color=\"red\"><b>Error 500</b> - Internal Server Error</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                502: function() {
                    data = '<font color=\"red\"><b>Error 502</b> - Bad Gateway</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                },
                504: function() {
                    data = '<font color=\"red\"><b>Error 504</b> - Gateway Timeout</font>';$( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
                }
            }
            
        });
        <?php
        $i++;
    }
    
    ?>
</script>
