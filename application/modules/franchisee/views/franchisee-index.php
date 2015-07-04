<div class="col-lg-6">
    <div class="col-lg-12">
        <h3 class="box-title">Please enter your postcode in the space below and we will find the nearest Creation Station</h3>
        <div class="row">
            <form action="<?= base_url(); ?>franchisee/index" class="location" method="post">
                <div class="col-xs-6">
                    <input type="text" name="p" placeholder="Your postcode..." class="form-control postcode">
                </div>
                <div class="col-xs-4">
                    <select class="form-control country" name="c">
                        <option value="0">Select</option>
                        <?php foreach ($territory as $country) {  ?>
                            <option value="<?=$country['territory_name'];?>"><?=$country['territory_name'];?></option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="col-xs-2">
                    <button type="submit" class="btn btn-info btn-flat search">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-12 f-location">
        <?php foreach ($franchisee as $row) { ?>
            <div class="location">
                <h4 class="mar-bot10 mar-top10"><?= $row['name']; ?></h4>
                <p><?= $row['bussiness_address']; ?></p>
                <p style="text-align: right"><a href="<?= base_url(); ?>franchisee/detail/<?= $row['id']; ?>">view detail</a></p>
            </div>
        <?php } ?>
    </div>
</div> 
<div class="col-lg-6">
    <div id="map"></div>
</div>
<script>
    var locations = <?php echo json_encode($mapFranchisee); ?>;
//    console.log(locations);
</script>