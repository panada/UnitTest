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
        
        $.get( "UnitTest/test?f=<?=$val?>", function( data ) {
            
            var n = data.indexOf("error");
            if(n != -1){
               data = '<font color=\"red\">'+data+'</font>';
            }
            
            $( "#<?=$i?>" ).append( "<strong><?=$i.' '.$val?></strong><br>"+data );
        });  
        <?php
        $i++;
    }
    
    ?>
</script>
