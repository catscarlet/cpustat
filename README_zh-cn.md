# cpustat(CPU使用率查看工具)
*概述点击这里为中国的自述。[中文文档（https://github.com/catscarlet/cpustat/blob/master/README_zh-cn.md）*

一个非常简单的CPU占用率的百分比监控工具.simply计算和CPU使用百分比输出文本，第二版书面壳/ PHP。

现在有很多工具可以统计CPU的性能。他们是非常强大的，因为他们可以记录CPU性能和保存日志，或者他们有一个图形用户界面，如SAR和nmon的一个良好的可读性。

但我不能找到一个工具，它可以简单地输出一个简单的CPU性能状态。

早些时候，我写了一个系统状态监控，所以我需要找到一些工具来监控CPU，内存和磁盘的使用情况。我选择了'自由'和'东风'来观看内存和磁盘。但我coundn't找到一个简单的工具来观看CPU。我试着顶，发现无互动的模式下，它无法展开CPU。类似的发现SAR只记录日志和nmon的只能工作在交互模式。

它们是强有力的工具，并且也许它们具有模式，以输出一个简单或复杂的输出，但我只需要一个非常简单的工具，以输出CPU使用率，无需历史日志，不需交互模式的一个简单的值。

所以，我决定写一个工具，让自己满意。

现在，它只是一个想法，我只是workinig就可以了。

注意 ：
- 这个项目使用的“猫的/ proc / STAT”收集信息，使用正则表达式，所以只能使用Linux 2.6.24，更新版本的工作，因为有9 columns.See在：[http://www.linuxhowtos.org/系统/ procstat.htm]（http://www.linuxhowtos.org/System/procstat.htm）
- 由于击不支持浮点运算，所以只有整数％。我不想用BC支持浮点计算，因为没有必要这样严格计算。

##用法

### PHP

在布劳尔打开这个，或者使用PHP php_cpustat.php：

```
PHP php_cpustat.php
```

请注意，如果你想改变输出电平，编辑文件，修改的值** $ inforlevel ='A'; **

###击只需像这样运行（执行所需的权限）：

```
./bash_cpustat.sh
```

您可以使用** -_- ^ h _ **以了解更多信息
