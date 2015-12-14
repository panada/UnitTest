<div id="modelResult">
    <h2>Models</h2>

</div>

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
    
    <?php
    foreach ($models as $val)
    {
        ?>      
        $.get( "http://localhost/septiadi/UnitTest/test?f=<?=$val?>", function( data ) {
            $( "#modelResult" ).append( "<strong><?=$val?></strong><br>"+data+'<hr>' );
        });  
        <?php
    }
    
    ?>
</script>
