 
<script type="text/javascript">
    (function() {
        function src(src){
            for(var i=0,js; js=document.getElementsByTagName('script')[i];i++){
                if((js.src.indexOf(src)>-1)){document.getElementsByTagName('script')[i].remove();}}
            return false;    
        }
        var js = JSON.parse('<?php echo json_encode($request); ?>');
        for (var i = 0; i < js.assets.length; i++) {
            if(!src(js.assets[i].src)){
                        var scpt = document.createElement('script');
                              scpt.type = 'text/javascript';
                              scpt.src    = js.base + js.assets[i].src;
                              scpt.async = true;
                              var ascpt = document.getElementsByTagName('script')[0];
                              ascpt.parentNode.insertBefore(scpt, ascpt);  
                      }
                } 
             } 
    )();
</script> 
