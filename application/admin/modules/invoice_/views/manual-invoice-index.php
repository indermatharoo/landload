<header class="panel-heading">
    <div class="row">
        <div class="col-sm-1" style="text-align: right">
            <a href="invoice"><h3 style="cursor: pointer; margin: 0; color: #fff"><i class="fa fa-arrow-left" title="Back to Invoice"></i></h3></a>
        </div>
        <div class="col-sm-10">
            <h3 style="margin: 0; text-align: center;">Manual Invoice</h3>
        </div>
    </div>
</header>
<div class="col-lg-12 padding-0 mar-top15">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" class="add-user">
        <div class="form-group">
            <div class="col-sm-6">
                <select class="form-control margin-bot-7" id="type" name="franchise_id">
                    <option val="0">Select Franchisee *</option>
                    <?php
                    foreach($rows as $row):
                    ?>
                    <option value="<?php echo $row["id"];?>"><?php echo $row['fname']."(".$row['email'].")";?></option>
                  <?php endforeach; ?>
                </select>
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="due_on" name="due_on" value="" placeholder="Due Date *">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6">
                <input type="text" class="form-control" id="particular" name="particular" value="" placeholder="Particular *">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control" id="amount" name="amount" value="" placeholder="Installment Amount *">
            </div>
        </div>
        
 
        <div class="form-group">
            <div class="col-sm-12 center">
                <button type="submit" name="button" id="button" class="btn btn-primary preview-add-button btn-fix-width">Add</button>
            </div>
        </div>
    </form>
</div>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    $( "#due_on" ).datepicker({ dateFormat: 'yy-mm-dd',minDate: 0 });
  });
  </script>
