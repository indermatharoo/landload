<?php

$output = exec('git pull origin master 2>&1');
print_r($output);
exit;
