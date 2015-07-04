<?php if ($branch) { ?>
<h3>Branch Found</h3>
<p><span><strong><?php echo $branch['branch_name']; ?></strong></span><br />

        <?php if ($branch['phone']) { ?><strong>Tel:</strong> <?php echo $branch['phone']; ?><br /><?php } ?>
        <?php if ($branch['phone']) { ?><strong>Email:</strong> <a href="mailto:<?php echo $branch['email']; ?>"><?php echo $branch['email']; ?></a><br /><?php } ?>
        <?php if ($branch['website']) { ?><a href="<?php echo $branch['website']; ?>" target="_blank"><?php echo $branch['website']; ?></a><?php } ?>
    </p>
<?php } else { ?>
    <h4>No Branch Found</h4>
    <p><span>Unable to find any branch in your area</span></p>
<?php } ?>
<!--<div class="back_btn"><a href="javascript:void(0);"><img src="images/back-btn.png" width="39" height="40"></a></div>-->
