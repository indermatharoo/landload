<div class="col-lg-12 pad-left5 pad-right5">
    <div class="notifications">
        <h1>Notifications</h1>
        <div class="notifications-inner" style="overflow: auto;max-height: 400px;">        
            <?php
            $CI = & get_instance();
            $CI->load->library('Notification');
            $notifications = $CI->notification->getNotification();
            ?>
            <p>                

                <span style="color: #2AABE4;font-weight: 700;">
                    <?php
                    echo $notifications;
                    ?>
                </span>
            </p>                          
        </div>
    </div>
</div>