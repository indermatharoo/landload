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
                <a href="<?= createUrl('forum/getTopic/' . $postDetail['forum_id']); ?>"><i class="fa fa-2x fa-arrow-left" title="Back To Topic's List" style="color: #fff"></i></a>
            </div>
            <div class="col-sm-7" style="text-align: center">
                <h3 style="margin: 0"><?= character_limiter($postDetail['description'], 50); ?></h3>
            </div>
            <div class="col-sm-3" style="text-align: right">
                <h3 onclick="displayPostForum(<?= $postDetail['id']; ?>, 0);" style="margin: 0; cursor: pointer"><i class="fa fa-plus-square" title="Add New Post"></i></h3>
            </div>
        </div>
    </header>
    <section class="col-md-12 forum-topic" id="addPost">
        <form id="addForumPostForm" class="form-horizontal" action="<?= createUrl('forum/addpost'); ?>" method="POST">
            <input type="hidden" name="forum_id" value="<?= $postDetail['forum_id']; ?>" />
            <input type="hidden" id="against_post_id" name="against_post_id" value="<?= $postDetail['id']; ?>" />
            <input type="hidden" name="parent_post_id" value="<?= $postDetail['id']; ?>" />
            <div class="" id="formDesc">
                <label class="title" for="description">Description</label>
                <input type="text" id="description" name="description" class="form-control " placeholder="Add description">
                <span class="help-block" id="formDesc-msg"></span>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-6 col-sm-6" style="text-align: right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-primary" onclick="displayPostForum(<?= $postDetail['id']; ?>, 0);">Cancel</button>
                </div>
            </div>
        </form>
    </section>
    <div class="row">
        <div class="col-sm-2">
            <img src="images/bg_site.jpg" width="75px" height="75px" alt="" />
            <a href="javascript:void(0)"><?= $postDetail['uname']; ?></a><br/><?= $postDetail['post_date']; ?>
        </div>
        <div class="col-sm-10" style="text-align: justify">
            <div class="col-sm-12">
                <h4><?= $postDetail['description'] ?></h4>
            </div>
        </div>
    </div>
    <section class="col-md-12"  style="padding: 0">
        <div class="" style="padding: 5px; background: #EBEBEB;">
            <h3 style="margin: 0">Total Replies: <?= count($posts); ?></h3>
        </div>
        <ul>      
            <?php
            foreach ($posts as $postsDet):
                $newDate = date("d-m-Y", strtotime($postsDet['post_date']));
                ?>
                <li class="padding-20 clearfix" style="border: 1px solid #aaa; margin-top:10px">
                    <div class="col-sm-2">
                        <img src="images/bg_site.jpg" width="75px" height="75px" alt="" />
                        <a href="javascript:void(0)"><?= $postsDet['uname']; ?></a><br/><?= $newDate; ?>
                    </div>
                    <div class="col-sm-10">
                        <div class="col-sm-12" style="min-height: 100px">
                            <?= $postsDet['description'] ?> 
                        </div>
                        <?php
                        if (!empty($postsDet['quoted_description'])) {
                            ?>
                            <div class="quote_body col-sm-12">
                                <div class="col-sm-2 quote_avatar_container">
                                    <div class="avatar-wrapper avatar_size_quote avatar-1">
                                        <img src="//images.proboards.com/v5/defaultavatar.png" alt="Admin Avatar" width="75px">
                                    </div>
                                    <div>
                                        <a href="<?= createUrl('forum/getForum/' . $postsDet['forum_id']); ?>">
                                            <abbr class="time"><?= $postsDet['post_date'] ?></abbr>
                                        </a>
                                        <span itemscope="" itemtype="http://schema.org/Person">
                                            <a href="/user/1" class="user-link user-1 group-1" itemprop="url" title="@admin">
                                                <span itemprop="name"><?= $postsDet['quoted_user']; ?></span>
                                            </a>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-10 quote_header">
                                    <?= $postsDet['quoted_description']; ?>
                                </div>
                                <div class="quote_clear"></div>
                            </div>
                            <?php
                        }
                        ?>                        
                    </div>
                    <div class="col-sm-12" style="text-align: right">
                        <a class="replyform" onclick="displayPostForum(<?= $postsDet['id']; ?>, 1);" href="javascript:void(0);">Reply with quotes</a>
                    </div>
                </li>
                <?php
            endforeach;
            ?>
        </ul>
    </section>
</div>
<script>
    function displayPostForum(againtpostid, postReply) {
        $('#description').val('');
        $('#formDesc').removeClass('has-error');
        if (againtpostid > 0) {
            $('#against_post_id').val(againtpostid);
            if (postReply == 1) {
                if ($('#addForumPostForm').is(':visible') == false) {
                    $('#addPost').toggle();
                }
            } else {
                $('#addPost').toggle();
            }
            $('#description').focus();
        } else {
            window.location.reload(true);
        }
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