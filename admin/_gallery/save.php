<?php
    usleep(300001);
    print json_encode(
        array(
            'status'        => true,
            'message'       => 'ok'.$_POST['id']
        )
    );
?>