#cpustat

##概述

一个非常简单的CPU使用率监控工具。一条命令，无界面，无日志。做到**简单部署，简单执行，简单输出**。共有php和bash(shell)两个版本。

###为什么要做这个

_（你可以跳过本段。这些只是我的抱怨）_

现在有很多的工具可以收集或保存的CPU的使用情况。他们一般功能都非常强大，或者可以定时记录CPU性能日志，或者有一个易读易用的图形化界面，如sar和nmon。

但是我没有找到一个能简单输出CPU实时使用率的工具。

之前我写了一个系统状态监控工具，需要一些工具来监控CPU、内存和磁盘的使用情况。我选择了'free'和'df'来查看内存和磁盘的使用情况。然而我没有找到适合用来监视CPU使用状态的软件。 我最初尝试了'top'，发现在无交互的情况下，它的输出无法展开各个CPU的使用情况。 之后我尝试了其他几款工具，发现sar只记录特定时刻的CPU使用情况，只记录日志，非实时；而nmon只工作于交互模式。

虽然这些工具十分强大，也许他们有一个模式来简单输出，然而我只需要一个非常简单的工具来输出CPU使用率，不需要历史记录的，也不需要图形界面或交互模式。

所以，我决定写一个工具来满足自己的需求。

注意 ：
- 这个项目使用的'cat/proc/stat'收集CPU的使用信息，因为采用了正则表达式来收集stat的9列输出，所以只能用于Linux 2.6.24以后的版本。详情请参阅：[http://www.linuxhowtos.org/System/procstat.htm](http://www.linuxhowtos.org/System/procstat.htm)
- 由于bash不支持浮点运算，所以只有整形输出。我不想用bc进行浮点计算，因为没有必要。

##安装

只需将文件复制到目标计算机即可。如果你需要使用shell版本，给bash_cpustat.sh加上执行权限。

##用法

# PHP
在浏览器中直接打开打开这个，或者在shell下使用php php_cpustat.php：

```
php php_cpustat.php
```

![php_cpustat.php level=s](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/php_cpustat_s.png)

注意：如果你想改变输出级别，编辑文件，修改值**$inforlevel = 'a';**

![php_cpustat.php level=a](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/php_cpustat_a.png)

注意：如果您在浏览器中直接打开php_cpustat.php，输出可能会显得很乱，因为它使用LF作为换行符，而不是CRLF。

###Bash

直接在shell下执行即可（需要执行权限）

```
./bash_cpustat.sh
```

您可以使用**_-h_**了解更多信息

![bash_cpustat.sh](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/bash_cpustat.png)

##贡献者

谢谢[梅桐天土小星星](http://weibo.com/p/1005051861229632)修复readme的语法错误。
