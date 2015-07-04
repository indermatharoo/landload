<!--<script>

    $(document).ready(function() {
        var ca = false;
        $(".internal_message span.view").click(function() {
            var n = $(this).attr('id');
            if (".internal_message_view") {
                $(".internal_message_view").fadeOut("fast", function() {
                    $(".internal_message_view").remove();
                });
            }

            setTimeout(function() {
                $("#" + n + "_d").after("<div class=\"internal_message_view\"></div>");
                $(".internal_message_view").slideDown("fast");
                $.get('/system/messages_rpc.php?view=' + n, function(data) {
                    $(".internal_message_view").html(data);
                });
                $("#" + n + "_s").addClass("read");
            }, 300);
        });
        $(".internal_message span.delete").click(function() {
            var n = $(this).attr('id');
            if (confirm("Are you sure you wish to delete this message?")) {
                $.get('/system/messages_rpc.php?delete=' + n, function(data) {
                    $("#" + n + "line").fadeOut("fast", function() {
                        $("#" + n + "line").remove();
                    });
                });
            }
        });
    });
</script>-->
<!--<pre>-->

<script type="text/javascript">
    $(document).ready(function() {
        $(".view").click(function() {
            $(this).parents('.message').next('.message_view').toggle();
        });

        $('span.delete').click(function() {
            var id = $(this).attr('id');
            if (confirm('Are you sure you want to Delete this Order')) {
                $.post('customer/dashboard/msgdel', {id: id}, function(data) {
                    $('.delete-pop').html(data.message);
                    $('.delete-pop').bPopup({autoClose: 800});
                    $(this).parents('.message').hide();
                }, 'json');
            } 

        });
    });
</script>

<style type="text/css">
    .message_view{
        display: none;
    }
    .msg-btn {
        float: right;
    }
    .delete-pop{
        background: none repeat scroll 0 0 white;
        border-radius: 6px;
        display: none;
        font-size: 15px;
        height: 100px;
        padding: 36px;
        text-align: center;
        width: 300px;
        color:#006C86;
    }
   .subject {
    font-size: 15px;
}
body{
    font-size: 14px !important;
}
</style>
<div class="delete-pop"></div>

<?php $this->load->view('inc-messages'); ?>

<div class="col-lg-8 col-lg-offset-2">
    <div style="line-height:60px;font-weight:bold;text-align:center;font-size: 2.2em">Welcome to your internal Jaspers E-Mail</div>
    <div class="col-lg-12" style="padding: 10px;">
        <?php foreach ($message as $m) { ?>
            <div id="message_<?= $m['id']; ?>_dline" class="message col-lg-12">
                <div id="message_<?= $m['id']; ?>_s" class="subject col-lg-6"><?= $m['subject']; ?></div>
                <div class="col-lg-6">
                    <div class="msg-btn"><span id="message_<?= $m['id']; ?>" class="view"><img border="0" src="http://mccreative.jaspersonline.co.uk/jasper2/system/shared/images/mail-read.png"></span><span id="<?= $m['id']; ?>"  class="delete"><img border="0" src="http://mccreative.jaspersonline.co.uk/jasper2/system/shared/images/mail-delete.png"></span></div>
                </div>
            </div>
            <div class="col-lg-12 message_view"><?= $m['content']; ?></div>
        <?php } ?>
    </div>
</div>