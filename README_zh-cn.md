#cpustat

##概述

一个非常简单的CPU使用率监控工具。一条命令，无界面，无日志。做到**简单部署，简单执行，简单输出**。共有php和bash(shell)两个版本。

###为什么要做这个

_（你可以跳过这一段。这些只是我的抱怨）_

现在有很多的工具可以收集报告或保存的CPU的使用情况狂。他们功能强大，或者可以记录CPU性能日志，或者有一个易读易用的图形化界面，如sar和nmon。

但是我没有找到一个能简单输出CPU实时使用率的工具

之前我写了一个系统状态监控工具，需要一些工具来监控CPU，内存和磁盘的使用情况。我使用'free'和'df'来查看内存和磁盘的使用情况。然而，我没有找到能用来监视CPU使用状态的软件。
我最初尝试了'top'，发现在无交互的情况下，它的输出无法展开各个CPU的使用情况。
之后我尝试了其他几款工具，发现sar只记录特定时刻的CPU使用情况，只记录日志，非实时；而nmon只工作于交互模式。

虽然这些工具十分强大，也许他们有一个模式来简单输出，然而我只需要一个非常简单的工具来输出CPU使用率，不需要历史记录的，也不需要图形界面或交互模式。

所以，我决定写一个工具来满足自己的需求。

注意 ：
- 这个项目使用的"cat/proc/stat"收集CPU的信息信息，因为使用正则表达式固定了stat的9列s，所以只能使用Linux 2.6.24和新版本工作，因为有9列。请参阅：[[http://www.linuxhowtos.org/System/procstat.htm]（http://www.linuxhowtos.org/System/procstat.htm）](http://www.linuxhowtos.org/System/procstat.htm]（http://www.linuxhowtos.org/System/procstat.htm）)
- 由于击不支持浮点运算，所以只有整数％。我不想用BC支持浮点计算，因为没有必要这样严格计算。

##安装

只需将文件复制到目标计算机。给bash_cpustat.sh执行权限，如果你需要它。

##用法

# PHP
在布劳尔打开这个，或者使用PHP php_cpustat.php：

```
php php_cpustat.php
```

![php_cpustat.php level=s](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/php_cpustat_s.png)

注意：如果你想改变输出电平，编辑文件，修改的值**$inforlevel = 'a';**

![php_cpustat.php level=a](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/php_cpustat_a.png)

注意：如果您在布劳尔打开php_cpustat.php，输出会显得很乱，因为它使用LF作为换行符，而不是CRLF。

###击只需像这样运行（执行所需的权限）：

```
./bash_cpustat.sh
```

您可以使用**_-h_**以了解更多信息

![bash_cpustat.sh](https://raw.githubusercontent.com/catscarlet/cpustat/master/snapshot/bash_cpustat.png)

##贡献者

谢谢[梅桐天土小星星](http://weibo.com/p/1005051861229632)修复自述的语法错误。
