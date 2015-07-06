
<div class="forum-top">
    <?php
    $this->load->view(THEME . 'messages/inc-messages');
    if (count($forum) == 0) {
        $this->load->view(THEME . 'messages/inc-norecords');
    }
//            echo '<pre>';
//                print_r($forum);
//            echo '</pre>';
    ?>
</div>
<div class="forum-body">
    <header class="panel-heading">
        <div class="row">
            <div class="col-sm-1">
                <i class="fa fa-comments fa-2x"></i>
            </div>
            <div class="col-sm-10">
                <h3 style="margin: 0; text-align: center">The Creation station Forums</h3>
            </div>
            <div class="col-sm-1" style="text-align: right">
                <h3 onclick="displayAddForum();" style="cursor: pointer; margin: 0"><i class="fa fa-plus-square" title="Add New Forum"></i></h3>
            </div>
        </div>
    </header>
    <section class="col-md-12 forum-topic" id="addForum">
        <form id="addforumform" class="form-horizontal" action=<?= createUrl("forum/add") ?> method="POST">
            <span class="help-block" id="form-msg"></span>
            <div class="" id="formName">
                <input type="text" id="name" name="name" class="form-control" placeholder="Add name">
                <span class="help-block" id="formName-msg"></span>
            </div>
            <div class="" id="formDesc">
                <input type="text" id="description" name="description" class="form-control" placeholder="Add description">
                <span class="help-block" id="formDesc-msg"></span>
            </div>
            <div class=""> 
                <div class="" style="float: right; text-align: right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="displayAddForum();">Cancel</button>
                </div>
            </div>
        </form>
        <script>
            function displayAddForum() {
                $('#name').val('');
                $('#description').val();
                $('#formName').removeClass('has-error');
                $('#formName-msg').text('');
                $('#formDesc').removeClass('has-error');
                $('#formDesc-msg').text('');
                $('#addForum').toggle();
            }

            $("#addforumform").submit(function (event) {
                var formCheck = true;
                if ($('#name').val() == '') {
                    $('#formName').addClass('has-error');
                    $('#formName-msg').text('Name required');
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
    <section class="col-md-12 padding-0">
        <ul class="col-sm-12 padding-0">
            <?php foreach ($forum as $forumDet): ?>
                <li class="list-unstyled clearfix" style="border: 1px solid #aaa; margin-top: 10px">
                    <div class="col-sm-12" style="background: #EBEBEB;  padding: 10px">
                        <table width="100%">
                            <tr>
                                <td width="95%"><a href="<?= createUrl('forum/getForum/') . $forumDet['id']; ?>"><h4 style="margin: 0"><b><?= $forumDet['name'] ?></b></h4></a><?= $forumDet['description'] ?></td>
                                <td width="5%"><button data-id='<?= $forumDet['id'] ?>' type="button" class="btn btn-danger pull-right deleteBtn" ><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                            <tr><td colspan="2" style="text-align: right"><b>created by <?= $forumDet['uname'] ?> on <?= date("d-m-Y h:m", strtotime($forumDet['created_date'])) ?></b></td></tr>
                        </table>
                    </div>
                    <div class="col-sm-12" style="margin-top: 10px;">
                        <a href="<?= createUrl('forum/getForum/') . $forumDet['id'] . '/1'; ?>">
                            <i class="fa fa-plus-square fa-2x pull-right" style="cursor: pointer; padding: 3px; border-radius: 5px; background: #0081CA; color: #fff" title="Add new topic"></i>
                        </a>
                    </div>
                    <div class="col-sm-12 padding-20">                        
                        <?php
                        $topicArray = array();
                        foreach ($forumTopics as $topicK => $topicV):
                            if ($topicV['parent_id'] == $forumDet['id']):
                                $topicArray[] = $topicV['id'];
                                ?>
                                <div class="col-sm-12 topicList">
                                    <a href="<?= createUrl('forum/getTopic/') . $topicV['id']; ?>"><i class="fa fa-info-circle"></i>
                                        <?= $topicV['name'] . ' (' . setDefault($postCount[$topicV['id']], 0) . ')'; ?></a>
                                    
                                    <?php if(curUsrId()==$topicV['creator_id'])
                                    { ?>
                                    <span class="deleteForum" data-id="<?=$topicV['id']  ?>">delete</span>
                                    <?php } ?>
                                </div>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </div>

                    <div class="col-sm-12" style="border-top: 1px solid #aaa">
                        <?php
                        foreach ($latestPost as $topicPostkey => $topicPostval):
                            if (in_array($topicPostval['forum_id'], $topicArray)):
                                ?>
                                Last post - <a href="<?= createUrl('forum/getTopic/') . $topicPostval['forum_id']; ?>"><?= substr(trim($topicPostval['description']), 0, 50); ?></a> by <?= $topicPostval['name']; ?>on <?= date("d-m-Y h:m", strtotime($topicPostval['post_date'])); ?> <br/>
                                <?php
                            endif;
                        endforeach;
                        ?>                            
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
<!--    <section class="col-md-12">
        <div class="ceter-block" style="margin-top: 4px;" >
            <div class="col-md-12" style="background-color: grey">
                Latest Posts
            </div>
            <ul class="col-md-12">
    <?php
    $str = null;
    foreach ($latestPost as $postdet) {
        $str .= '<li>'
                . ' <strong>By ' . $postdet['name'] . '</strong> '
                . substr($postdet['description'], 0, 25)
                . (strlen($postdet['description']) > 25 ? '...' : '')
                . '</li>';
    }
//                echo $str;
    ?>
            </ul>
        </div>
    </section>-->
</div>
<script>
    $('document').ready(
            function () {
                displayAddForum();
                $('.deleteForum').on('click',function(){
                    var ths = this;
                    var dataId = $(this).attr('data-id');
                    console.log(dataId);
                    if(dataId!="")
                    {
                        $.ajax({
                            url:'forum/delete_topic/',
                            data:{id:dataId},
                            type:'POST',
                            dataType:'json',
                        }).done(function(data){
                            if(data.success)
                            {
                                
                                $(ths).parent().parent().remove();
                            }
                            
                        })
                    }
                })
                
                $('.deleteBtn').on('click',
                        function (e) {
                            console.log($(this).attr("data-id"));
                            $.ajax(
                                    {
                                        url: '<?= base_url(); ?>index.php/forum/delete/' + $(this).attr("data-id"),
                                        type: "POST",
                                        success: function (data, textStatus, jqXHR)
                                        {
                                            var data = jQuery.parseJSON(data);
                                            if (data.success == 1) {
                                                window.location.reload();
                                            } else if (data.success == 0) {
                                                alert(data.msg);
                                            }
                                        }
                                    });
                        });
            }
    );
</script>
