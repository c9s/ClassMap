#!/bin/bash
onion -d compile \
    --lib src \
    --lib vendor/pear \
    --classloader \
    --bootstrap scripts/classmap.php \
    --executable \
    --output classmap.phar
chmod +x classmap.phar
