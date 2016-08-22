<script type="text/javascript">
$(document).ready(function(){
    $('select#EventFromDateMonth').on('change', function() {
        var val = this.value;
        $('select#EventToDateMonth').val(val);        
    });
    $('select#EventFromDateDay').on('change', function() {
        var val = this.value;
        $('select#EventToDateDay').val(val);        
    });
    $('select#EventFromDateYear').on('change', function() {
        var val = this.value;
        $('select#EventToDateYear').val(val);        
    });
});
</script>