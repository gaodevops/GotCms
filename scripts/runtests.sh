#!/bin/bash

cd "$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

source functions.sh

if ! commandExists phpunit
then
    if ! commandExists ./phpunit
    then
        echo "Phpunit not found"
        exit 0
    else
        phpunit="../scripts/phpunit"
    fi
else
    phpunit="phpunit"
fi

phpunit_opts="-d zend.enable_gc=0 --verbose"
phpunit_groups=

cd ../
while [ -n "$1" ] ; do
  case "$1" in
    ALL|all)
     phpunit_groups=""
     break ;;

    Gc|Datatypes|Modules|ZfModules)
     phpunit_groups="${phpunit_groups:+"$phpunit_groups,"}$1"
     shift ;;
    *)

    if [[ ! -f "$(pwd)/$1" ]]
    then
      phpunit_opts="${phpunit_opts:+"$phpunit_opts "}$1"
    else
      phpunit_file="${phpunit_file:+"$phpunit_file "}$1"
    fi
     shift ;;
  esac
done

cd "tests"
echo $phpunit $phpunit_opts ${phpunit_groups:+--group $phpunit_groups} $phpunit_file
$phpunit $phpunit_opts ${phpunit_groups:+--group $phpunit_groups} $phpunit_file
