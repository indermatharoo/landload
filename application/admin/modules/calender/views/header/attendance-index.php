<script type="text/javascript">
    $(document).ready(function () {
       $('.booking_attendance').change(function(){
          var res = $(this).find(":selected").val(); 
          var tid = $(this).attr('tid');
          $.post('calender/attendance/ticket/',{id:tid,is_used:res},function(data){},'json');
       });
    });
</script>
