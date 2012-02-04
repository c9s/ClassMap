#!/bin/bash
onion -d compile \
    --lib src \
    --lib vendor/pear \
    --classloader \
    --bootstrap scripts/classmap.php \
    --executable \
    --output classmap.php
chmod +x classmap.phar
