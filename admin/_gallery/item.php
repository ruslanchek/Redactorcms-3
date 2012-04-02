<?php
    usleep(500000);
    print json_encode(
        array(
            'id'            => $_GET['id'],
            'sort'          => $_GET['id'],
            'pic_src'       => 'pic'.$_GET['id'].'.jpg',
            'name'          => 'name '.$_GET['id'],
            'description'   => 'desc '.$_GET['id']
        )
    );
?>