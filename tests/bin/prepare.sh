#!/usr/bin/env sh

#
# JBZoo CrossCMS
#
# This file is part of the JBZoo CCK package.
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.
#
# @package   CrossCMS
# @license   MIT
# @copyright Copyright (C) JBZoo.com,  All rights reserved.
# @link      https://github.com/JBZoo/CrossCMS
#

sudo apt-get update -qq
sudo apt-get install -y -qq postfix

sudo service postfix stop
smtp-sink -d "%d.%H.%M.%S" 127.0.0.1:2500 1000 &
echo -e '#!/usr/bin/env bash\nexit 0' | sudo tee /usr/sbin/sendmail
echo 'sendmail_path = "/usr/sbin/sendmail -t -i "' | sudo tee "/home/travis/.phpenv/versions/`php -i | grep "PHP Version" | head -n 1 | grep -o -P '\d+\.\d+\.\d+.*'`/etc/conf.d/sendmail.ini"
