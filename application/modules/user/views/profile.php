<div class="col-lg-7" >
    <header class="panel-heading">
        <div class="row">
            <div class="col-sm-6">
                <h3 style="margin: 0"><?php echo $cususer->name ?></h3>
            </div>
        </div>
    </header>

    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <?php if ($cususer->pic): ?>
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" width="125px" src="<?php echo $this->config->item('UPLOAD_URL_USERS') . $cususer->pic ?>" class="img-circle"> </div>
                <?php else: ?>
                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle"> </div>
                <?php endif; ?>
                <div class=" col-md-9 col-lg-9 "> 
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Email:</td>
                                <td><?php echo $cususer->email ?></td>
                            </tr>
                            <tr>
                                <td>Last Login:</td>
                                <td><?php echo $cususer->last_login ?></td>
                            </tr>
                            <?php if (count($extrafields) && isset($extrafields->franchise)): ?> 
                                <tr>
                                    <td>First Name:</td>
                                    <td><?php echo $extrafields->fname ?></td>                                        
                                </tr>
                                <tr>
                                    <td>Last Name:</td>
                                    <td><?php echo $extrafields->lname ?></td>                                        
                                </tr>
                                <tr>
                                    <td>Home Address:</td>
                                    <td><?php echo $extrafields->home_address ?></td>                                        
                                </tr>
                                <tr>
                                    <td>Bussiness Address:</td>
                                    <td><?php echo $extrafields->bussiness_address ?></td>                                        
                                </tr>
                                <tr>
                                    <td>Telephone:</td>
                                    <td><?php echo $extrafields->telephone ?></td>                                        
                                </tr>
                                <tr>
                                    <td>Linkedin:</td>
                                    <td><?php echo $extrafields->linkedin ?></td>                                        
                                </tr>
                                <tr>
                                    <td>Pinterest:</td>
                                    <td><?php echo $extrafields->pinterest ?></td>                                        
                                </tr>
                                <tr>
                                    <td>Google:</td>
                                    <td><?php echo $extrafields->google ?></td>                                        
                                </tr>
                            <?php elseif (count($extrafields) && isset($extrafields->user)): ?>
                                <tr>
                                    <td>Franchise:</td>
                                    <td><?php echo $extrafields->fname ?></td>                                        
                                </tr>
                            <?php elseif (isset($extrafields->customer)): ?>
                                <tr>
                                    <td>First Name:</td>
                                    <td><?php echo $extrafields->first_name ?></td>                                        
                                </tr>                                        
                                <tr>
                                    <td>Last Name:</td>
                                    <td><?php echo $extrafields->last_name ?></td>                                        
                                </tr>                                        
                                <tr>
                                    <td>Address1:</td>
                                    <td><?php echo $extrafields->delivery_address1 ?></td>                                        
                                </tr>                                        
                                <tr>
                                    <td>Address2:</td>
                                    <td><?php echo $extrafields->delivery_address2 ?></td>                                        
                                </tr>                                        
                                <tr>
                                    <td>Telephone:</td>
                                    <td><?php echo $extrafields->delivery_phone ?></td>                                        
                                </tr>                                        
                                <tr>
                                    <td>Town:</td>
                                    <td><?php echo $extrafields->delivery_city ?></td>                                        
                                </tr>                                        
                                <tr>
                                    <td>Postcode:</td>
                                    <td><?php echo $extrafields->delivery_zipcode ?></td>                                        
                                </tr>                                        
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a href="<?php echo ($this->aauth->isCustomer()) ? "" : createUrl('user/index') ?>" data-toggle="tooltip" type="button" class="btn btn-primary">Back</a>
            <a href="<?php echo createUrl('customer/add/' . curUsrId()) ?>" data-toggle="tooltip" type="button" class="btn btn-primary">Edit</a>
        </div>
    </div>
</div>