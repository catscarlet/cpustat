#cpustat
##概述

一个非常简单的CPU占用率的百分比监控工具。简单地计算，并在文本输出的CPU使用率百分比。两个版本由外壳和PHP的编码。

###之所以我做了这个

_（你可以跳过这个阶段。这只是我的投诉）_

现在有很多的工具，可以收集，报告或保存的CPU时间的百分比。他们是非常强大的，因为它们可以记录CPU性能和保存日志，或者他们有一个图形用户界面，如SAR和nmon的一个良好的可读性。

但我没有找到一个工具的CPU时间，这可以简单地输出的百分比。

早些时候，我写了一个系统状态监控，所以我需要找到一些工具来监控CPU，内存和磁盘的使用情况。我选择了'自由'和'东风'来观看内存和磁盘。但是，我无法找到一个简单的工具来监控CPU。我试着顶，发现无互动的模式下，它无法展开CPU。同样发现SAR只记录日志和nmon的唯一的工作在交互模式。

即使他们是强大的工具，也许他们有一个模式来输出简单或复杂的输出，我只需要一个非常简单的工具来输出CPU使用率，不需要历史记录的，没有必要的交互模式的一个简单的值。

所以，我决定写一个工具来让自己满意。

注意 ：
- 这个项目使用的“cat/proc/stat”收集信息，使用正则表达式，所以只能使用Linux 2.6.24和新版本工作，因为有9列。请参阅：[http://www.linuxhowtos.org/System/procstat.htm]（http://www.linuxhowtos.org/System/procstat.htm）
- 由于击不支持浮点运算，所以只有整数％。我不想用BC支持浮点计算，因为没有必要这样严格计算。

##安装

只需将文件复制到目标计算机。给bash_cpustat.sh执行权限，如果你需要它。

##用法

### PHP

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
