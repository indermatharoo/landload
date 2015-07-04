<!DOCTYPE html>
<html>
    <head>
        <!-- BASICS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>The creation station</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $this->load->view("themes/" . THEME . "/headers/global.php");
        echo $CI->assets->renderHead();
        ?>

        <!-- skin -->
        <link rel="stylesheet" href="skin/default.css">
        <link rel="stylesheet" href="http://localhost/desktopdeli/js/calendar/components/bootstrap2/css/bootstrap-responsive.css">
        <link rel="stylesheet" href="http://localhost/desktopdeli/js/calendar/css/calendar.css">



    </head>
    <body>
        <div class="top-menu">
            <div class="container">
                <div class="col-lg-6 col-sm-12 col-xs-12 right">
                    <?php $this->load->view("themes/" . THEME . "/layout/inc-top"); ?>
                </div>
            </div>
        </div>
        <div class="navbar" role="navigation" data-0="line-height:85px; height:85px; background-color:rgba(0,0,0,0.3);" data-300="line-height:60px; height:60px; background-color:rgba(0,0,0,1);">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-bars color-white"></span>
                </button>
                <a href="<?php echo $CI->http->baseURL(); ?>"><img src="images/logo.png" alt="The Creationstation" class="img-responsive logo"/></a>
            </div>
            <div class="navbar-collapse collapse">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-menu"); ?>
            </div>
        </div>
        <section class="content-area">
            <div class="container"> 
                <div class="row mar-bot40">
                    <div class="subpages"> 
                        <?php
                        echo $contents;
                        ?>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="section footer">
            <div class="container">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
            </div>
        </footer>
        <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	
            <?php echo $CI->assets->renderFooter(); ?>

        <script type="text/javascript" src="http://localhost/desktopdeli/js/calendar/components/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="http://localhost/desktopdeli/js/calendar/components/underscore/underscore-min.js"></script>
        <script type="text/javascript" src="http://localhost/desktopdeli/js/calendar/components/bootstrap2/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://localhost/desktopdeli/js/calendar/components/jstimezonedetect/jstz.min.js"></script>
        <script type="text/javascript" src="http://localhost/desktopdeli/js/calendar/js/calendar.js"></script>
        <script type="text/javascript" src="http://localhost/desktopdeli/js/calendar/js/app.js"></script>
<!--        <script type="text/javascript">
            (function ($) {
                "use strict";
                var options = {
                    events_source: 'http://localhost/desktopdeli/franchisee/event/' + '?uid=<?= $franchisee['user_id']; ?>',
                    view: 'month',
                    tmpl_path: 'http://localhost/desktopdeli/js/calendar/tmpls/',
                    tmpl_cache: false,
                    day: '2014-04-17',
                    onAfterEventsLoad: function (events) {
                        if (!events) {
                            return;
                        }
                        var list = $('#eventlist');
                        list.html('');

                        $.each(events, function (key, val) {
                            $(document.createElement('li'))
                                    .html('<a href="' + val.url + '">' + val.title + '</a>')
                                    .appendTo(list);
                        });
                    },
                    onAfterViewLoad: function (view) {
                        $('.page-header h3').text(this.getTitle());
                        $('.btn-group button').removeClass('active');
                        $('button[data-calendar-view="' + view + '"]').addClass('active');
                    },
                    classes: {
                        months: {
                            general: 'label'
                        }
                    }
                };

                var calendar = $('#calendar').calendar(options);

                $('.btn-group button[data-calendar-nav]').each(function () {
                    var $this = $(this);
                    $this.click(function () {
                        calendar.navigate($this.data('calendar-nav'));
                    });
                });

                $('.btn-group button[data-calendar-view]').each(function () {
                    var $this = $(this);
                    $this.click(function () {
                        calendar.view($this.data('calendar-view'));
                    });
                });

                $('#first_day').change(function () {
                    var value = $(this).val();
                    value = value.length ? parseInt(value) : null;
                    calendar.setOptions({first_day: value});
                    calendar.view();
                });

                $('#language').change(function () {
                    calendar.setLanguage($(this).val());
                    calendar.view();
                });

                $('#events-in-modal').change(function () {
                    var val = $(this).is(':checked') ? $(this).val() : null;
                    calendar.setOptions({modal: val});
                });
                $('#events-modal .modal-header, #events-modal .modal-footer').click(function (e) {
                    //e.preventDefault();
                    //e.stopPropagation();
                });
            }(jQuery));
        </script>-->
    </body>
</html>