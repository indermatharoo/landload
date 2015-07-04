<?php
//e($franchisee);
?>
<div class="col-lg-6">
    <?php if (!empty($franchisee)) { ?>
        <h1><?= $franchisee['page_title']; ?></h1>
        <?php if ($franchisee['bussiness_address']) { ?>
            <h3> <?= $franchisee['bussiness_address']; ?></h3>
        <?php } ?>            
        <?php if ($franchisee['pic']) { ?>
            <div class="col-lg-12 padding-0">
                <img src="<?= $this->config->item('UPLOAD_URL_USERS') . $franchisee['pic'] ?>" alt="" class="img-responsive"/>
            </div>
        <?php } ?>
        <?= $franchisee['page_contents']; ?>
    <?php } ?>
</div>
<div class="col-lg-6">
    <div style="background: white; padding: 10px 10px 50px 10px; border-radius: 5px;">
        <div class="page-header">
            <div class="pull-right form-inline">
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary" data-calendar-nav="prev"><< Prev</button>
                    <button class="btn btn-sm" data-calendar-nav="today">Today</button>
                    <button class="btn btn-sm btn-primary" data-calendar-nav="next">Next >></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-sm btn-warning" data-calendar-view="year">Year</button>
                    <button class="btn btn-sm btn-warning active" data-calendar-view="month">Month</button>
                    <button class="btn btn-sm btn-warning" data-calendar-view="week">Week</button>
                    <!--<button class="btn btn-sm btn-warning" data-calendar-view="day">Day</button>-->
                </div>
            </div>
            <h3></h3>
        </div>
        <div class="col-lg-12">
            <div id="calendar"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="col-lg-12 padding-0 mar-top15">
        <div class="class-events">
            <table width='100%'>
                <?php foreach ($sidelinks as $links) { ?>
                    <tr class="evnts" style="height: 90px"><td width='15%'><img src='<?= $this->config->item('SIDELINKS_URL') . $links['pic'] ?>'/></td><td><a href='<?= base_url() . $links['link'] ?>'><p><?= $links['content'] ?></p></a></td><td><div style="background: <?= $links['color'] ?>; width:15px; height:15px;"></div></td></tr>
                <?php } ?>
            </table>
        </div>
        <div class="mar-top15">
            <a href="<?= createUrl('contact/franchiseenquiry/' . arrIndex($franchisee, 'id')) ?>"><img src="<?= base_url() ?>images/contact-brush.png" alt="Get in Touch" /></a>
        </div>
        <div class="frnachisee-socials mar-top20">
            <?php if (arrIndex($franchisee, 'facebook')) { ?>
                <div class="franchise-fb"><a href="<?= $franchisee['facebook'] ?>" target="_blank"><h5><?= $franchisee['page_title']; ?></h5></a></div>
            <?php } ?>
        </div>
        <div class="franchisee-testimonials mar-top20">
            <?php if ($testimonials) { ?>
                <h3>Testimonials</h3>
                <div id="myCarousel1" class="carousel" style="color: #DA0001">
                    <div class="carousel-inner" style="text-align: center">  
                        <?php
                        $c = NULL;
                        foreach ($testimonials as $testimonials) {
                            ++$c;
                            ?>
                            <div class="item <?php echo $c == 1 ? 'active' : ''; ?>" >
                                <p style="font-style:normal">"<?= strip_tags($testimonials['content']) ?>"</p>
                                <cite title="Source Title">- <?= $testimonials['name'] ?></cite>
                            </div>
                        <?php } ?>
                    </div> 
                </div>
            <?php } ?>
        </div>
    </div>
</div>
