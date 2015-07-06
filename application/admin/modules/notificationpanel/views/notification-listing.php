<header class="panel-heading">
    <div class="row">
        <div class="col-sm-12">
            <h3 style="margin: 0">Notification Panel</h3>
        </div>
    </div>
</header>
<div class="col-lg-12">
    <?php $this->load->view(THEME . 'messages/inc-messages'); ?>
</div>
<div class="col-lg-12">
    <?php
    if (count($notification) == 0) {
        $this->load->view(THEME . 'messages/inc-norecords');
    }
    ?>
</div>
<div class="col-sm-12 padding-0">
    <form action="notificationpanel/add" method="post" enctype="multipart/form-data" name="addNotification" id="addNotification">
        <ul>
            <?php
            foreach ($notification as $key => $notificationVal):
                $for_group = explode(',', $notificationVal['for_group']);
                ?>
                <li class="col-lg-12 mar-bot10 padding-0" style="border: 1px solid #aaa;">
                    <table class="table" style="margin: 0">
                        <tr style="background: #EAEAEA;">
                            <th>Module</th>
                            <th>Action</th>
                            <th>Group</th>
                            <th>Assign</th>
                            <th>Active</th>
                        </tr>
                        <tr>
                            <td>
                                <?= $notificationVal['display_class_name'] ?>
                            </td>
                            <td>
                                <?= $notificationVal['display_action_name'] ?>
                            </td>
                            <td>
                                <?php
                                $JS = 'id="grp-' . $notificationVal['id'] . '", class="grp form-control"  data-id="' . $notificationVal['id'] . '"';
                                $availGrps = $this->aauth->list_groups();
                                $grpArr = array();
                                $grpArr[0] = 'Choose Group';
                                foreach ($availGrps as $grpKey => $grpVal) {
                                    if (in_array($grpVal->id, $for_group)) {
                                        $grpArr[$grpVal->id] = $grpVal->name;
                                    }
                                }
                                $grpArr['allgrp'] = 'All Groups';
                                $selGrp = '0';
                                if (!empty($notificationVal['grp'])) {
                                    $selGrp = explode(',', $notificationVal['grp']);
                                }
                                echo form_dropdown('grp[' . $notificationVal['id'] . ']', $grpArr, $selGrp, $JS);
                                ?>
                            </td>
                            <td>
                                <?php
                                $JS = 'id="assigne-' . $notificationVal['id'] . '", class="assigne form-control" data-id="' . $notificationVal['id'] . '"';
                                $assignArr = array();
                                $assignerArr = array();
                                if (!empty($notificationVal['assigne'])) {
                                    $assignArr = explode(',', $notificationVal['assigne']);
                                    if ($notificationVal['grp'] == 'allgrp') {
                                        foreach ($group[$notificationVal['grp']] as $toAssignGrp => $toAssignVal) {
                                            if (in_array($toAssignGrp, $for_group)) {
                                                $assignerArr[$toAssignGrp] = $toAssignVal;
                                            }
                                        }
                                    } else
                                        $assignerArr = $group[$notificationVal['grp']];
                                }
                                echo form_dropdown('assigne[' . $notificationVal['id'] . '][]', $assignerArr, $assignArr, $JS);
                                ?>
                            </td>
                            <td>
                                <input type="checkbox" value="1"
                                       name="active[<?= $notificationVal['id']; ?>]"
                                       <?= $notificationVal['active'] == 1 ? "checked" : ""; ?> >
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <input  maxlength="100" 
                                        type="text"
                                        class="form-control"
                                        data-id="<?= $notificationVal['id']; ?>"
                                        name="msg[<?= $notificationVal['id']; ?>]"
                                        value="<?= setDefault($notificationVal['msg'], '') ?>"
                                        placeholder="Add message here with specify {name}"
                                        />
                            </td>
                        </tr>
                    </table>
                </li>
            <?php endforeach; ?>
            <li>
                <p align="center" class="col-lg-12">
                    <input type="submit" name="button" id="button" value="Submit" class="btn btn-primary">
                </p>
            </li>
        </ul>
    </form>
</div>
<?php $this->load->view('headers/notification-listing'); ?>