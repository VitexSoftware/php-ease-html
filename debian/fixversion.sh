#!/bin/bash
VERSTR=`dpkg-parsechangelog --show-field Version`
COMPOSER_VERSTR=`echo ${VERSTR}|sed 's/-/./g'`
echo update debian/php-ease-html/usr/share/php/EaseHtml/composer.json version to ${COMPOSER_VERSTR}
sed -i -e '/\"version\"/c\    \"version\": \"'${COMPOSER_VERSTR}'",' debian/php-ease-html/usr/share/php/EaseHtml/composer.json
