<html >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Creation Station - Information Pack</title>
    </head>
    <body>
        <div style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px">
            <p style="font: 18px Arial, Helvetica, sans-serif; margin-bottom:2px">Creation Station- Information Pack</p>
            <p style="margin-top:0px">Dated - <?php echo $today_date; ?></p>
            <div style="margin-bottom: 12px; border-bottom: 2px solid #666; clear: both;"></div>

            Hello <?php echo $sendername; ?><br />

            Thank you for your recent  Creation Station request, there's just one more quick step. Please use the confirmation link below to verify that you give us permission to send you email.<br>
            <a href="<?php echo createUrl('contact/checked/')?><?php echo $verifynumber; ?>">Please click here</a> to verify your email address</br>
            Many thanks,<br />
            Kind regards<br />
            Sarah Cressall<br />
            Founder & Managing Director<br />
            The Creation Station<br />
            The Creation Station Ltd | Inspiration House | Creativity Drive | Unit 3 Woodbury Business Park | Woodbury, Devon | EX5 1LD | United Kingdom 0844 854 9100 
        </div>
    </body>
</html>