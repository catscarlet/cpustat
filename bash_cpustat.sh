#!/bin/bash

#

NPROC=(`nproc`)
#echo $NPROC
for (( i = 0; i < $NPROC; i++ )); do
((sedline=i+2))
procstat_t1=(`cat /proc/stat | grep '^cpu' |sed -n "$sedline,$sedline p"`)
user[$i]=${procstat_t1[1]}
nice[$i]=${procstat_t1[2]}
system[$i]=${procstat_t1[3]}
idle[$i]=${procstat_t1[4]}
iowait[$i]=${procstat_t1[5]}
irq[$i]=${procstat_t1[6]}
softirq[$i]=${procstat_t1[7]}
steal[$i]=${procstat_t1[8]}
guest[$i]=${procstat_t1[9]}
guest_nice[$i]=${procstat_t1[10]}
#echo cpu$i ${user[$i]} ${nice[$i]} ${system[$i]} ${idle[$i]} ${iowait[$i]} ${irq[$i]} ${softirq[$i]} ${steal[$i]} ${guest[$i]} ${guest_nice[$i]}
((total[$i]=user[$i]+nice[$i]+system[$i]+idle[$i]+iowait[$i]+irq[$i]+softirq[$i]+steal[$i]+guest[$i]+guest_nice))
#echo ${total[$i]}
done
