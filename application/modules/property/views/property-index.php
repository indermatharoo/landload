<div class="col-lg-6">
    <div class="col-lg-12 f-location">
        <?php foreach ($property as $row) { ?>
            <div class="location">
                <h4 class="mar-bot10 mar-top10"><?=$row['unit_number']; ?></h4>
                <p><?= $row['pname']; ?></p>
                <p style="text-align: right"><a href="<?= base_url(); ?>property/detail/<?= $row['id']; ?>">view detail</a></p>
            </div>
        <?php } ?>
    </div>
</div> 
