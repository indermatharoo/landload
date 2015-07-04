<h1>Manage Template</h1>
<div id="ctxmenu"><a href="cms/template/add">Add Template</a></div>
<?php $this->load->view(THEME.'messages/inc-messages'); ?>
<?php if(count($templates) == 0) { $this->load->view(THEME.'messages/inc-norecords'); } else {?>
<div class="tableWrapper">    
<table width="100%" border="0" cellpadding="2" cellspacing="0">
    <tr>
      <th width="80%">Template</th>
      <th width="20%">Action</th>
    </tr>
<?php foreach($templates as $item) { ?>
	<tr class="<?php echo alternator('', 'alt');?>">
      <td><?php echo $item['template_name'];?></td>
      <td><a href="cms/template/edit/<?php echo $item['template_id'];?>">Edit</a> | <a href="cms/template/delete/<?php echo $item['template_id'];?>" onclick="return confirm('Are you sure you want to delete this Template?');">Delete</a></td>
    </tr>
<?php } ?>
</table>
</div>
<?php } ?>
<p style="text-align:center"><?php echo $pagination;?></p>