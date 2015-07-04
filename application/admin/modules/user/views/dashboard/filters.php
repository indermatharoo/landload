<?php
//e($franchises);
?>
<style>
    .btn-group button{
        background: #3c8dbc;
        border-color: #3c8dbc;
        color: #fff;
    }
</style>
<div class="col-lg-12 padding-0 mar-bot10">
    <div class="col-lg-4 padding-0">
        <select name="regions[]" id="regions" multiple="" style="display: none;" class="filter">
            <?php foreach ($regions as $region): ?>
                <option value="<?php echo arrIndex($region, 'id') ?>"><?php echo arrIndex($region, 'name') ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!--    <div class="col-lg-4">
            <select name="franchisee[]" id="franchises" multiple="" style="display: none;" class="filter">
    <?php foreach ($franchises as $franchise): ?>
                                                                                                            <option value="<?php echo arrIndex($franchise, 'id') ?>"><?php echo arrIndex($franchise, 'name') ?></option>
    <?php endforeach; ?>
            </select>
        </div>-->
    <div class="col-lg-2 pull-right">
        <?php
        $years = array(
            '2014-2015' => '2014-2015',
            '2015-2016' => '2015-2016',
            'custom_filter' => 'Custom Date',
        );
        $selectedYear = $this->session->userdata('year');
        $selectedYear = ($selectedYear) ? $selectedYear : '2014-2015';
        ?>
        <select name="year[]" id="year" style="display: none;" class="filter">
            <!--            <option selected="selected" value="2014-2015">2014-2015</option>
                        <option value="2015-2016">2015-2016</option>-->
            <?php foreach ($years as $year): ?>
                <option <?php echo ($year == $selectedYear) ? 'selected="selected"' : ''; ?> value="<?php echo $year ?>"><?php echo $year ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <!--    <div class="col-lg-2">
            <select name="reporttype" id="reporttype" class="filter">
                <option value="default">Default</option>
                <option value="region_customer">Region Customer</option>            
                <option value="franchise_customer">Franchise Customer</option>            
                <option value="region_income">Region Income</option>            
                <option value="franchise_income">Franchise Income</option>            
            </select>
        </div>-->
</div>
<!--<input class="form-control" id="event_date" type="text" name="eventdate" value="">-->
<div class="clearfix"></div>
<script>
    $(function () {
        $('input[name="eventdate"]').daterangepicker({
            timePicker: true,
            format: 'DD-MM-YYYY h:mm',
            timePickerIncrement: 5,
            timePicker12Hour: false,
            timePickerSeconds: false
        });
    });
    $(document).ready(
            function () {
                reset_selection('#regions', 'All Regions Selected');
                reset_selection('#franchises', 'All Franchises Selected');
                $('#year,#reporttype').multiselect();
                $('select.filter').on('change', function () {
                    savefilter(this, this.id, $(this).val());
                });
            }
    );
    function savefilter(element, id, val) {
        var url = '<?php echo createUrl('user/ajax/dashboard/saveFilter/') ?>';
        if (val == 'Custom Date') {
            window.location = '<?php echo createUrl('user/customdate') ?>';
            return false;
        }
        $.post(url, {id: id, val: val}, function (response) {
            if (id == 'year' && val != 'Custom Date') {
                var url = '<?php echo createUrl('user/dashboard/'); ?>' + val.replace('-', '/');
                window.location.href = url;
                return false;
            }
            sendRequest(id, val);
        });
    }
    function sendRequest(id, val) {
        var reporttype = '<?php echo $this->session->userdata('reporttype') ?>';
        switch (id) {
            case 'regions':
                updateFranchise();
                updateReport('<?php echo createUrl('user/ajax/dashboard/regionReport/'); ?>');
                break;
            case 'franchises':
                updateReport('<?php echo createUrl('user/ajax/dashboard/franchiseReport/'); ?>');
                break;
            case 'reporttype':
                switch (val) {
                    case 'region_customer':
                    case 'region_income':
                        updateReport('<?php echo createUrl('user/ajax/dashboard/regionReport/'); ?>');
                        break;
                    case 'franchise_customer':
                    case 'franchise_income':
                        updateReport('<?php echo createUrl('user/ajax/dashboard/franchiseReport/'); ?>');
                        break;
                    case 'default':
                        updateReport('<?php echo createUrl('user/ajax/dashboard/back') ?>');
                        break;
                }
        }
    }
    function updateReport(url) {
        $.post(url, function (response) {
            $('.table_cont').html(response);
        });
    }
    function updateFranchise(xhr) {
        var url = '<?php echo createUrl('user/ajax/dashboard/regionfranchise/'); ?>';
        $.get(url, function (response) {
            $('#franchises').html(response);
            $('#franchises').multiselect('rebuild');
            reset_selection('#franchises', 'All Franchises Selected');
        });
    }

    function reset_selection(id, text) {
        $(id).multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            allSelectedText: text
        });
        $(id).multiselect('selectAll', false);
        $(id).multiselect('updateButtonText');
    }
    function l(v) {
        console.log(v);
    }
</script>