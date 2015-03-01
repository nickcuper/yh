<?php

return CMap::mergeArray(
    include __DIR__ . '/../../common/config/main.php',
    array(
        'basePath' => __DIR__ . DIRECTORY_SEPARATOR . '..',
        'name' => 'Yahoo Quotes',
    )
);
