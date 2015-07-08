<header class="panel-heading">
    <div class="row">
        <div class="col-sm-11">
            <h3 style="margin: 0; text-align: center">Manage Slide Show</h3>
        </div>
        <div class="col-sm-1">
            <a href="slideshow/slideshow/add" style="color: #fff;" title="Add Slide Show"><i class="fa fa-plus-square fa-2x"></i></a>
        </div>
    </div>
</header>

<?php $this->load->view('inc-messages'); ?>

<?php
if (count($slideshows) == 0) {
    $this->load->view('inc-norecords');
    return;
}
?>

<div class="table">
    <table class="table" >
        <tr>
            <th width="70%">Slide Show Name</th>
            <th width="30%">Action</th>
        </tr>
        <?php
        foreach ($slideshows as $item) {
            $enable_disable_link = 'slideshow/disable/' . $item['slideshow_id'];
            $enable_disable_text = 'Disable';
            if ($item['active'] == 0) {
                $enable_disable_text = 'Enable';
                $enable_disable_link = 'slideshow/enable/' . $item['slideshow_id'];
            }
            ?>
            <tr class="<?php echo alternator('', 'alt'); ?>">
                <td><?php echo $item['slideshow_title']; ?></td>
                <td><a href="slideshow/slide/index/<?php echo $item['slideshow_id']; ?>">Slides</a> |
                    <a href="<?php echo $enable_disable_link; ?>" onclick="return confirm('Are you sure you want to Enable/Disable this Slideshow?');"><?php echo $enable_disable_text; ?></a> |
                    <a href="slideshow/edit/<?php echo $item['slideshow_id']; ?>">Edit</a> |
                    <a href="slideshow/delete/<?php echo $item['slideshow_id']; ?>" onclick="return confirm('Are you sure you want to delete this Slideshow?');">Delete</a>
                </td>
            <?php } ?>
    </table>
</div>
