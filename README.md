# cpustat
A very simple cpu usage calculation ,simply output text of cpu usage percentages ,two version writing by shell/php .

Nowadays there are a lot of tools can statistic cpu performance .They are very powerful because they can record cpu performance and save the log , or they have a good readability with a GUI ,such as sar and nmon.

But I can't find a tool which can simply output a easy cpu performance status .

Earlier I wrote a system status monitor , so I need to find some tools to monitor the usage of cpu , memory and disk . I chose 'free' and 'df' to watch memory and disk . but I coundn't find a simple tool to watch cpu . I tried top and found it couldn't unfold cpu without interactive mode. Similar found sar only record log and nmon only work in interactive mode.

They are powerful tools , and maybe they have a mode to output a simple or complex output ,but I only need a very simple tool to output a simple value of cpu usage , no need of history log, no need of interactive mode.

So I decide to writing a tool to make myself satisfied.

Now it is just an idea and I'm just workinig on it .

Note : This project use 'cat /proc/stat' to collect information ,using regex , so only work with Linux 2.6.24 and newer version because of 9 columns.See in:[http://www.linuxhowtos.org/System/procstat.htm](http://www.linuxhowtos.org/System/procstat.htm)
