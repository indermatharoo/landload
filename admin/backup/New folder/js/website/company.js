jQuery(document).ready(function($) {  
    showHide();
    function showHide(){
        var customer_id = $('#customer_type_id').val();
        if(customer_id == 2){
            $(".company_show").show();
        }else{
        $(".company_show").hide();
        }
    }
    $('#customer_type_id').change(function() {
        showHide();
        
    });
    

});