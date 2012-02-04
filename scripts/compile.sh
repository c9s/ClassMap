#!/bin/bash
onion -d compile \
    --lib src \
    --lib vendor/pear \
    --classloader \
    --bootstrap scripts/classmap.php \
    --executable \
    --output classmap-gen.phar
chmod +x classmap-gen.phar
