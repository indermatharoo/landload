<div class="box box-solid">
    <div class="box-header">
        <i class="fa fa-bar-chart-o"></i>
        <h3 class="box-title">Franchise Stats</h3>
        <div class="box-tools pull-right">
            <button data-widget="collapse" class="btn btn-default btn-sm"><i class="fa fa-minus"></i></button>
            <button data-widget="remove" class="btn btn-default btn-sm"><i class="fa fa-times"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <?php if (!count($data)): ?>
            <h3 class="box-title">No Target Assigned Yet</h3>
        <?php endif; ?>
        <?php foreach ($data as $key => $data1): ?>
            <h3 class="box-title"><?php echo Event::$types1[$key] ?></h3>
            <div class="row">
                <?php
                foreach ($data1 as $index => $value):
                    foreach ($value as $key1 => $value1):
                        $title = '';
                        if ($key1 == 'no_of_event')
                            $title = 'Events';
                        if ($key1 == 'no_of_customer')
                            $title = 'Customer';
                        $percentage = arrIndex($value1, 'percentage');
                        $temp = array();
                        $temColor = array();
                        $mcolor = '#f56954';
                        foreach ($colors as $key => $color):
                            $temColor[arrIndex($color, 'percentage')] = $color;
                            $temp[] = arrIndex($color, 'percentage');
                        endforeach;
                        $temp[] = $percentage;
                        if (count($temp) > 1) {
                            sort($temp);
                            $result = array_search($percentage, $temp);
                            $resultIndex = arrIndex($temp, $result + 1);
                            if (arrIndex($temColor, $resultIndex)) {
                                $arr = arrIndex($temColor, $resultIndex);
                                $mcolor = $arr['color'];
                            }
                        }
                        ?>
                        <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                            <div>
                                <canvas width="90" height="90"></canvas>
                                <input data-readonly="true" type="text" data-fgcolor="<?php echo $mcolor ?>" data-height="150" data-width="150" data-thickness="0.3" data-skin="tron" value="<?php echo arrIndex($value1, 'percentage') ?>" class="knob" style="width: 64px; height: 40px; position: absolute; vertical-align: middle; margin-top: 40px; margin-left: -92px; border: 0px none; background: none repeat scroll 0% 0% transparent; font: bold 24px Arial; text-align: center; color: rgb(245, 105, 84); padding: 0px;">;
                            </div>
                            <div class="knob-label"><?php echo ucfirst(strtolower($index)) . ' ' . $title ?></div>
                        </div><!-- ./col -->            
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div><!-- /.row -->
        <?php endforeach; ?>
    </div><!-- /.box-body -->
</div>
<script src="<?php echo base_url() . 'js/jquery.knob.js' ?>"></script>
<script>
    $(document).ready(function() {
        console.log(123);
    });
    $(function() {
        /* jQueryKnob */

        $(".knob").knob({
            /*change : function (value) {
             //console.log("change : " + value);
             },
             release : function (value) {
             console.log("release : " + value);
             },
             cancel : function () {
             console.log("cancel : " + this.value);
             },*/
            draw: function() {

                // "tron" case
                if (this.$.data('skin') == 'tron') {
//                return false;
                    var a = this.angle(this.cv)  // Angle
                            , sa = this.startAngle          // Previous start angle
                            , sat = this.startAngle         // Start angle
                            , ea                            // Previous end angle
                            , eat = sat + a                 // End angle
                            , r = true;

                    this.g.lineWidth = this.lineWidth;

                    this.o.cursor
                            && (sat = eat - 0.3)
                            && (eat = eat + 0.3);

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value);
                        this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                        this.g.beginPath();
                        this.g.strokeStyle = this.previousColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });
        /* END JQUERY KNOB */

        //INITIALIZE SPARKLINE CHARTS
        $(".sparkline").each(function() {
            var $this = $(this);
            $this.sparkline('html', $this.data());
        });

        /* SPARKLINE DOCUMENTAION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
        drawDocSparklines();
        drawMouseSpeedDemo();

    });
</script>