<div class="row content-bg col-lg-8">    
    <div class='col-lg-12 padding-0'>
        <div class="close1 pull-right">X</div>
    </div>
    <div class="col-lg-6 pad-right0" style="border-right: 1px solid #aaa;">
        <h4>You can read the terms and condition from <a href="<?php echo site_url1(base_url()) . 'terms-and-conditions' ?>">here</a> </h4>
    </div>
    <div class="col-lg-6">
        <h4>If You can reset your password from <a href="<?php echo createUrl('user/edit' . curUsrId()) ?>">here</a></h4>
    </div>
    <div class="col-lg-7">
        <form>
            <input type="checkbox" name='dont_show_again' style="vertical-align: top">  Don't show this message again.<br>
            <input type='submit' name="submit" value='Save' class="btn btn-primary mar-top10">
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('input[name="submit"]').on('click', function () {
            var val = $('input[name="dont_show_again"]').is(':checked');
            if (!val)
                return false;
            $.post('<?php echo createUrl('user/IsFirstTimeLogin') ?>', {val: val}, function (response) {
                $('.close1').trigger('click');
            });
            return false;
        });
    });
</script>