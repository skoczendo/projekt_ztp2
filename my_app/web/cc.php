<?php
var_dump(exec('rm -R -f /home/epi/13_dabkowska/my_app/app/cache/dev'));
var_dump(exec('mkdir /home/epi/13_dabkowska/my_app/app/cache/dev'));
var_dump(exec('rm -R -f /home/epi/13_dabkowska/my_app/app/cache/prod'));
var_dump(exec('mkdir /home/epi/13_dabkowska/my_app/app/cache/prod'));
var_dump(exec('chmod -R 777 /home/epi/13_dabkowska/my_app/app/cache/*'));

