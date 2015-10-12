# cpustat
##Overview

_Click here for Chinese README.[中文文档](https://github.com/catscarlet/cpustat/blob/master/README_zh-cn.md)_

A very simple cpu usage percentages monitor tools. Simply calculate and output cpu usage percentages in text. Two versions coding by shell and php.

###The reason why I made this

_(You can skip this phase. This is just my complaint)_

Nowadays there are a lot of tools that can collect, report, or save percentage of CPU time. They are very powerful because they can record cpu performance and save log, or they have a good readability with a GUI, such as sar and nmon.

But I didn't find a tool which can simply output a percentage of cpu time.

Earlier I wrote a system status monitor, so I need to find some tools to monitor the usage of cpu, memory and disk. I chose 'free' and 'df' to watch memory and disk. However, I couldn't find a simple tool to monitor cpu. I tried top and found it couldn't unfold cpu without interactive mode. Similarly found sar only record log and nmon only work in interactive mode.

Even though they are powerful tools, and maybe they have a mode to output a simple or complex output, I only need a very simple tool to output a simple value of cpu usage, no need of history log, no need of interactive mode.

So I decided to write a tool to make myself satisfied.

Note :
- This project use 'cat /proc/stat' to collect information, using regex, so only work with Linux 2.6.24 and newer version because there are 9 columns. See in:[http://www.linuxhowtos.org/System/procstat.htm](http://www.linuxhowtos.org/System/procstat.htm)
- Because Bash doesn't support floating calculation, so there is only integer %. I don't want to use bc to support floating calculation, because there is no need of such exact computation.

##Install

Just copy files to your destination computer. Give bash_cpustat.sh execute permission if you need it.

##Usage

###PHP

Open this in brower, or use php php_cpustat.php :

```
php php_cpustat.php
```

![php_cpustat.php level=s](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/php_cpustat_s.png)

Notice :If you want to change output level, edit file and change the value of **$inforlevel = 'a';**

![php_cpustat.php level=a](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/php_cpustat_a.png)

Notice :If you open php_cpustat.php in a brower, the output will seem in a mess because the it use LF for newline, not CRLF.

###Bash Simply run like this (execute permission needed):

```
./bash_cpustat.sh
```

You can use **_-h_** for more information.

![bash_cpustat.sh](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/bash_cpustat.png)

##Contributor

Thank [梅桐天土小星星](http://weibo.com/p/1005051861229632) for fixing grammatical errors of README.
