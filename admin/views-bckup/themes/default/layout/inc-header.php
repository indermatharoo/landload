<div class="top">
    <div class="row">
        <div class="col-lg-6 col-sm-3">
            <img src="images/logo.png" alt="" class="img-responsive"/>
        </div>
        <div class="col-lg-6 col-sm-9">
            <div class="col-lg-6 col-sm-6">
                <div class="top-address">
                    <?php
                    $this->db = clearDbThis($this);
                    $curUser = $this->aauth->get_user();
//                    e($curUser);
                    $fid = ($this->aauth->isFranshisee()) ? $curUser->id : (($this->aauth->isUser()) ? $curUser->pid : null);
                    if ($fid):
                        $franchise = getFranchise($fid);
//                        e($franchise);
                        ?>
                        Teritory Name: <?= $franchise->territory_name ?><br>
                        Franchise No.: <?= $franchise->franchise_no ?><br>
                        <?= $franchise->region ?> 
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <div class="account">
                    <span style="font-style: italic">Welcome <?php echo ucfirst($curUser->name);  ?></span> | <a href="<?= createUrl('user/logout') ?>"><span style="color: #FEED00;">Logout</span></a>
                </div> 
            </div>
        </div>
    </div>
</div>
