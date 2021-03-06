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

# Fake sendmail script:

# Create a temp folder to put messages in
numPath="${TMPDIR-/tmp/}fakemail"
umask 037
mkdir -p $numPath

if [ ! -f $numPath/num ]; then
  echo "0" > $numPath/num
fi
num=`cat $numPath/num`
num=$(($num + 1))
echo $num > $numPath/num

name="$numPath/message_$num.eml"
while read line
do
  echo $line >> $name
done
exit 0
