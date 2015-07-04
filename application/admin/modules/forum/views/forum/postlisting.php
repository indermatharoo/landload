<div class="">
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
            <div class="col-sm-2">
                <a href="<?= base_url(); ?>index.php/forum/getForum/<?= $forum['parent_id']; ?>"><i class="fa fa-2x fa-arrow-left" title="Back To Topic's List" style="color: #fff"></i></a>
            </div>
            <div class="col-sm-7" style="text-align: center">
                <h3 style="margin: 0"><?= $forum['name']; ?></h3>
            </div>
            <div class="col-sm-3" style="text-align: right">
                <h3 onclick="displayPostForum();" style="margin: 0; cursor: pointer"><i class="fa fa-plus-square" title="Add New Post"></i></h3>
            </div>
        </div>
    </header>
    <section class="col-md-12 forum-topic" id="addPost">
        <form id="addForumPostForm" class="form-horizontal" action="<?= base_url(); ?>index.php/forum/addpost" method="POST">
            <input type="hidden" name="forum_id" value="<?= $forum['id']; ?>" />
            <div class="" id="formDesc">
                <input type="text" id="description" name="description" class="form-control " placeholder="Add description">
                <span class="help-block" id="formDesc-msg"></span>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6" style="text-align: right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="displayPostForum();">Cancel</button>
                </div>
            </div>
        </form>
        <script>
            function displayPostForum() {
                $('#description').val('');
                $('#formDesc').removeClass('has-error');
                $('#addPost').toggle();
            }

            $("#addForumPostForm").submit(function (event) {
                if ($('#description').val() == '') {
                    $('#formDesc').addClass('has-error');
                    $('#formDesc-msg').text('Description required');
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
                                    $('#formDesc').addClass('has-success');
                                    $('#formDesc-msg').text(data.msg);
                                    $('#description').val('');
                                    $('#addPost').slideToggle("slow");
                                    window.location.reload();
                                } else if (data.success == 0) {
                                    $('#formDesc').addClass('has-error');
                                    $('#formDesc-msg').text(data.msg);
                                }
                            }
                        });
                event.preventDefault();
            });
        </script>
    </section>
    <section class="col-md-12"  style="padding: 0">
        <div class="" style="padding: 5px; background: #EBEBEB;">
            <h3 style="margin: 0">Total Posts: <?= count($posts); ?></h3>
        </div>
        <ul>      
            <?php
            foreach ($posts as $postsDet):
                $newDate = date("d-m-Y", strtotime($postsDet['post_date']));
                ?>
                <li class="padding-20 clearfix" style="border: 1px solid #aaa; margin-top:10px">
                    <div class="col-sm-2">
                        <img src="//images.proboards.com/v5/defaultavatar.png" width="75px" height="75px" alt="" />
                        <a href="javascript:void(0)"><?= $postsDet['name']; ?></a><br/><?= $newDate; ?>
                    </div>
                    <div class="col-sm-10">
                        <div class="col-sm-12">
                            <?= $postsDet['description'] ?> 
                        </div>
                    </div>
                    <div class="col-sm-12" style="text-align: right">
                        <a class="replyform" href="<?= createUrl('forum/getTopicPost/'.$postsDet['id']); ?>">Reply</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <!--    <div class="col-md-12" style="padding: 0">
            <div class="panel panel-info">Topic Contributors</div>
            <ul class="col-md-12">
    <?php
    $contibutor = null;
    foreach ($topicContributar as $contributar):
        $contibutor .='<li>' . $contributar['name'] . '</li>';
    endforeach;
    //echo $contibutor;
    ?>
            </ul>
        </div>-->
</div>
<script>
    $('document').ready(
            function () {
                displayPostForum();
            }
    );
</script>