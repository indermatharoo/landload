<div class="col-lg-12">
    <header class="panel-heading">
        <div class="row">
            <div class="col-sm-6">
                <h3 style="margin: 0">Region User</h3>
            </div>
            <div class="col-sm-6" style="text-align: right">
                <a href="region"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-home" title="Manage User"></i></h3></a>
            </div>
        </div>
    </header>
    <div class="col-lg-12 padding-0 mar-top15">



        <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="username" name="name" value="<?php echo arrIndex($model, 'name') ?>" placeholder="Name">
                </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="sort" name="sort" value="<?php echo arrIndex($model, 'sort') ?>" placeholder="Sort">
                </div>
                <input type="hidden" name="id" value="<?php echo arrIndex($model, 'id') ?>">
            </div>
            <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Add</button>
        </form>                    
        <br/>
        <div class="alert alert-danger alert-dismissable" style="display:none">
            Region already exists with this name.
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<script>
    $('#button').click(function() {
//        $('.alert').show();
        var name = $('input[name="name"]').val(),
                url = '<?php echo createUrl('user/region/unique/') ?>' + name,
                result = false,
                id = $('input[name="id"]').val()
                ;
        if (id) {
            url += '/' + id;
        }
        if (!name)
            return result;
        $.get(url, function(response) {
            var result = JSON.parse(response);
            if (!result.status) {
                $('#form1').submit();
            } else {
                display_error();
            }
        });
        return result;
    });
    function display_error() {
        $('.alert').show();
        setTimeout(function() {
            $('.alert').hide('slow');
        }, 2000);
    }

</script>

