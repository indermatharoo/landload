<div>
    <?php
    $this->load->view(THEME . 'messages/inc-messages');
    if (count($posts) == 0) {
        $this->load->view(THEME . 'messages/inc-norecords');
    }
    ?>
</div>
<div class="Topic-body">
    <header class="panel-heading">
        <div class="row">
            <div class="col-sm-3">
                <a href="<?= base_url(); ?>index.php/forum"><i class="fa fa-2x fa-arrow-left" title="Back To Forum" style="color: #fff"></i></a>
            </div>
            <div class="col-sm-6" style="text-align: center">
                <h3 style="margin: 0"><?= $forum['name']; ?></h3>
            </div>
        </div>
    </header>
    <section class="col-md-12 forum-topic" id="addDescription">
        <form id="addForumTopicForm" class="form-horizontal" action="<?= base_url(); ?>index.php/forum/addtopic" method="POST">
            <span class="help-block" id="form-msg"></span>
            <input type="hidden" name="forum_id" value="<?= $forum['id']; ?>" />
            <input type="hidden" name="topic" value="1" />
            <div class="form-group" id="formName">
                <div class="col-sm-12">
                    <input type="text" id="name" name="name" class="form-control" placeholder="Add topic">
                    <span class="help-block" id="formName-msg"></span>
                </div>
            </div>
            <div class="form-group" id="formDesc">
                <div class="col-sm-12">
                    <input type="text" id="description" name="description" class="form-control" placeholder="Add description">
                    <span class="help-block" id="formDesc-msg"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6" style="text-align: right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="displayDescForum();">Cancel</button>
                </div>
            </div>
        </form>
        <script>
            function displayDescForum() {
                $('#name').val('');
                $('#description').val();
                $('#formName').removeClass('has-error');
                $('#formName-msg').text('');
                $('#formDesc').removeClass('has-error');
                $('#formDesc-msg').text('');

            }

            $("#addForumTopicForm").submit(function (event) {
                var formCheck = true;
                if ($('#name').val() == '') {
                    $('#formName').addClass('has-error');
                    $('#formName-msg').text('Topic required');
                    formCheck = false;
                }
                if ($('#description').val() == '') {
                    $('#formDesc').addClass('has-error');
                    $('#formDesc-msg').text('Description required');
                    formCheck = false;
                }
                if (formCheck == false) {
                    return false;
                }

                var postData = $(this).serializeArray();
                var formURL = $(this).attr("action");
                $.ajax(
                        {
                            url: formURL,
                            type: "POST",
                            data: postData,
                            success: function (data, textStatus, jqXHR)
                            {
                                var data = jQuery.parseJSON(data);
                                if (data.success == 1) {
                                    $('#form-msg').addClass('has-success');
                                    $('#form-msg').text(data.msg);
                                    $('#name').val('');
                                    $('#description').val('');
                                    $('#addForum').slideToggle("slow");
                                    window.location.reload();
                                } else if (data.success == 0) {
                                    $('#form-msg').addClass('has-error');
                                    $('#form-msg').text(data.msg);
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                $('#form-msg').addClass('has-error');
                                $('#form-msg').text('Some error occured at server end.');
                                console.log(jqXHR);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                event.preventDefault();
            });
        </script>
    </section>
    <section class="col-md-12" style="padding: 10px 0px">
        <div class="" style="padding: 5px; background: #EBEBEB;">
            <h3 style="margin: 0">Forum topic's list!</h3>
        </div>
        <ul class="col-md-12" style="padding: 0">
            <?php
            $topic = null;
            $postCount = 0;
            foreach ($forumTopic as $topicDet):
                $topic .='<li class="clearfix" style="border: 1px solid #aaa; margin-top:10px">
                            <div class="col-sm-12 padding-10" style="background: #EBEBEB;"><div class="">
                                <a href="' . createUrl('forum/getTopic/' . $topicDet['id']) . '" alt=""><h4 style="margin:0"><b>'
                        . $topicDet['name'] . '</b></h4></a>' . $topicDet['description'] . '</div>'
                        . '<div class="" style="text-align: right;"><b>created by ' . $topicDet['uname'] . ' on ' . date("d-m-Y h:m", strtotime($topicDet['created_date'])) . '</b></div></div>';
                foreach ($posts as $postkey => $postval) {
                    if ($postval['forum_id'] == $topicDet['id'] && $postCount < 2) {
                        $topic .='<div class="col-sm-12 topicList padding-10"><div class="col-sm-12" style="padding-right: 0">
                                    <a href="' . createUrl('forum/getTopic/' . $topicDet['id']) . '"><i class="fa fa-info-circle"></i>' . substr($postval['description'], 0, 70) . '..' . '</a> <span style="float: right">started by ' . $postval['name'] . ' on ' . date("d-m-Y h:m", strtotime($postval['post_date'])) .
                                '</span></div></div>';
                        $postCount = $postCount + 1;
                    }                    
                }
                $postCount = 0;
                $topic .= '</li>';
            endforeach;
            echo $topic;
            ?>
        </ul>
    </section>

                    <!--    <section class="col-md-12" style="padding: 10px 0">
                    <div class="panel panel-info">Forum Contributors</div>
                    <ul class="col-md-12">
    <?php
    $contibutor = null;
    foreach ($forumContributar as $contributar):
        $contibutor .='<li>' . $contributar['name'] . '</li>';
    endforeach;
    //echo $contibutor;
    ?>                        
                    </ul>
                    </section>-->
</div>
<script>
    $('document').ready(
            function () {
                displayDescForum();
            }
    );
</script>