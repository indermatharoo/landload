<?php //e($model); ?>
<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1">
            <a href="units/attributes"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Attributes"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center">Add Attribute</h3>
        </div>
    </div>
</header>
<?php $this->load->view('inc-messages'); ?>
<form  name="form" enctype="multipart/form-data" method="post" action="">
    <?php foreach ($model as $key => $value): 
        //echo $value;
        ?>
        <?php
        if ($key == 'id'):
            ?>
            <input  type="hidden" name="<?php echo $key ?>" value="<?php echo $value ?>">
            <?php
            continue;
        endif;
        $unit_type = arrIndex($model, 'unit_type');
        if ($key == 'unit_type'):
            ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>Attribute Type</label>
                    <?php /* ?>
                    
                    <select name="<?php echo $key ?>" class="form-control">
                        <option value="">Select</option>
                        <?php foreach (getUnitsTypes() as $key => $value): ?>
                            <option <?php echo ($unit_type == $key) ? 'selected="true"' : '' ?> value="<?php echo $key ?>"><?php echo $value ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php */ ?>
                    <select name="unit_type" class="form-control" autocomlete="off" >
                    <option value="">-Select Type-</option>
                    <?php foreach($propertiesType as $ptype){ ?>
                    <option value="<?php echo $ptype['short_code'] ?>" <?php if($ptype['short_code'] ==$unit_type){echo "selected";} ?>><?php echo $ptype['type'] ?></option>
                    <?php } ?>
                    </select>                    
                </div>
            </div>
            <?php
            continue;
        endif;
        if ($key == 'searchable'):
            ?>
            <div class="form-group">
                <div class="col-sm-12">
                    <label>Searchable</label>
                    <select name="<?php echo $key ?>" class="form-control">
                        <option value="">Select</option>
                        <option <?php echo ($value == 0) ? 'selected="true"' : ''; ?> value="0">No</option>
                        <option <?php echo ($value == 1) ? 'selected="true"' : ''; ?> value="1">Yes</option>
                    </select>
                </div>
            </div>
            <?php
            continue;
        endif;

        ?>
             <?php
        if($key=="type")
        {
            ?>
        <div class="form-group">
            <div class="col-sm-12">
                <label>Type</label>
                <select name="type" class="form-control">
                    <option></option>
                    <option value="text" <?php  if($value=="text"){echo "selected";} ?>>Text</option>
                    <option value="dropdown" <?php if($value=="dropdown"){echo "selected";} ?>>Dropdown</option>
                </select>
                <span class="addhhtml" style="display:<?php if(arrIndex($model, 'type')=="dropdown"){echo "block";}else{echo "none";} ?>">+</span>
            </div>
        </div>
        <?php if(arrIndex($model, 'type')=="dropdown")
            { 
            $ci = &get_instance();
            $ci->load->model('units/Attributesmodel');
            $drpdown = $ci->attributesmodel->getDropdownExists($model['id']);
            
            ?>
              <div class="form-group">
                   <div class="col-sm-12">
            <table width="30%">
                <tr><th>Value</th><th>Delete</th></tr>
            <?php
            foreach($drpdown['result'] as $ddown)
            {
            ?>
                    <tr><td><?php echo $ddown['value'] ?></td><td><input type="checkbox" name="deldrop[]" value="<?php echo $ddown['id']; ?>" ></td></tr>
            <?php }  ?>
            </table>
             </div>
                      </div>
            <?php
            } ?>   
       <div class="drpdowngen"  ></div>
        <div class="drpdwnhtml" style="display:none">   
                <div class="col-sm-12 "  >
                <label>Type</label>
                <input type="text" name="drop[]" class="form-control" >
            </div>
        </div>           
            <?php
            continue;
        }
        ?>
        <div class="form-group">
            <div class="col-sm-12">
                <label><?php echo ucfirst($key); ?></label>
                <input type="text" placeholder="<?php echo ucfirst($key); ?>" value="<?php echo $value ?>" name="<?php echo $key; ?>" class="form-control">
            </div>
        </div>
            

    <?php endforeach; ?>

    <br/>
    <div class="form-group">

        <br/><br/>
        <div class="col-sm-12">
            <input type="submit" class="btn btn-primary preview-add-button btn-fix-width" value="<?php echo (!$edit) ? 'Add' : 'Submit'; ?>"/>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="type"]').change(function(){
            if($(this).val()=="dropdown")
            {
                $('.addhhtml').show();
                $('.drpdowngen').append($('.drpdwnhtml').html()).show();
                console.log($('.drpdwnhtml').html());
            }
            else
            {
             $('.addhhtml').hide();   
            }
        })
        $('.addhhtml').click(function(){
            
            $('.drpdowngen').append($('.drpdwnhtml').html()).show();
        })
    })
</script>