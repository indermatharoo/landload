<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
             <i class="fa fa-file-text-o fa-2x"></i>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Manage Pages</h3>
        </div>
        <div class="col-sm-1" style="text-align: right">
            <?php if ($this->aauth->isFranshisor()): ?>
                <a href="cms/page/add"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-plus-square" title="Add New Page"></i></h3></a>
            <?php endif; ?>
        </div>
    </div>
</header>
<div class="col-sm-12">
    <?php
    $this->load->view(THEME . 'messages/inc-messages');
    if (count($pages) == 0) {
        $this->load->view(THEME . 'messages/inc-norecords');
        echo "</div>";
        return;
    }
    ?>
</div>
<div class="tableWrapper mar-top10">
    <?php echo $pagetree; ?>
</div>

<!--<div id="dialog-modal" title="Working">
        <p style="text-align: center; padding-top: 40px;">Updating the sort order...</p>
</div>-->