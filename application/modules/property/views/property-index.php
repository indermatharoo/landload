
<div class="col-lg-6">
    <div class="col-lg-12 f-location">
        <?php foreach ($property as $row) { ?>
            <div class="location">
                <h4 class="mar-bot10 mar-top10"><?= $row['pname']; ?></h4>
                <p><?= $row['unit_number']; ?></p>
                <div><img src="<?= $this->config->item('UNIT_IMAGE_URL').$row['unit_image']; ?>" class="img-responsive"/></div>
                <p><?= $row['description']; ?></p>
                <p style="text-align: right"><a href="<?= base_url(); ?>property/detail/<?= $row['unit_id']; ?>"><span class="btn btn-primary">view detail</span></a></p>
            </div>
        <?php } ?>
    </div>
</div> 
