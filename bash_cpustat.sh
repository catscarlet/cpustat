#!/bin/bash
_s=0
_a=0
sleep=1

#Simple output
simple_output(){
for (( i = 0; i < $NPROC; i++ )); do
((pcpu[$i]= 100 * (total_subtracted[$i]-idle_subtracted[$i]) / total_subtracted[$i]))
echo -e cpu$i "\t" ${pcpu[$i]}%
done
}

#All information output
all_output(){
echo -e "CPUID\tuser\tnice\tsystem\tidle\tiowait\tirq\tsoftirq\tsteal\tguest\tguest_nice";
for (( i = 0; i < $NPROC; i++ )); do
((user_p[$i]= 100 * user_subtracted[$i]/total_subtracted[$i]))
((nice_p[$i]= 100 * nice_subtracted[$i]/total_subtracted[$i]))
((idle_p[$i]= 100 * idle_subtracted[$i]/total_subtracted[$i]))
((system_p[$i]= 100 * system_subtracted[$i]/total_subtracted[$i]))
((iowait_p[$i]= 100 * iowait_subtracted[$i]/total_subtracted[$i]))
((irq_p[$i]= 100 * irq_subtracted[$i]/total_subtracted[$i]))
((softirq_p[$i]= 100 * softirq_subtracted[$i]/total_subtracted[$i]))
((steal_p[$i]= 100 * steal_subtracted[$i]/total_subtracted[$i]))
((guest_p[$i]= 100 * guest_subtracted[$i]/total_subtracted[$i]))
((guest_nice_p[$i]= 100 * guest_nice_subtracted[$i]/total_subtracted[$i]))
echo -e cpu$i"\t"${user_p[$i]}"\t"${nice_p[$i]}"\t"${system_p[$i]}"\t"${idle_p[$i]}"\t"${iowait_p[$i]}"\t"${irq_p[$i]}"\t"${softirq_p[$i]}"\t"${steal_p[$i]}"\t"${guest_p[$i]}"\t"${guest_nice_p[$i]}
done
}

#Information for help
do_help() {
   cat <<EOF

A very simple cpu usage percentages monitor tools .Simply calculate and output cpu usage percentages in text .Two versions coding by shell and php .

Usage $0 [-a|-s|-h]

Options
  -s: Print simple cpu usages(default)
  -a: Print all kinds of works of cpu usages
  -h: Print this messsage

For more information , please refer to : https://github.com/catscarlet/cpustat

EOF
}

#Error message
do_error() {
    do_help 1>2
    exit 1
}

#Here start the cpustat
while getopts "ash" op; do
    case "$op" in
        s)  _s=1
            ;;
        a)  _a=1
            ;;
        h) do_help
            exit
            ;;
        *) do_help
            exit
            ;;
    esac
done



NPROC=(`nproc`)
for (( i = 0; i < $NPROC; i++ )); do
((sedline=i+2))
procstat_t1=(`cat /proc/stat | grep '^cpu' |sed -n "$sedline,$sedline p"`)
user_t1[$i]=${procstat_t1[1]}
nice_t1[$i]=${procstat_t1[2]}
system_t1[$i]=${procstat_t1[3]}
idle_t1[$i]=${procstat_t1[4]}
iowait_t1[$i]=${procstat_t1[5]}
irq_t1[$i]=${procstat_t1[6]}
softirq_t1[$i]=${procstat_t1[7]}
steal_t1[$i]=${procstat_t1[8]}
guest_t1[$i]=${procstat_t1[9]}
guest_nice_t1[$i]=${procstat_t1[10]}
((total_t1[$i]=user_t1[$i]+nice_t1[$i]+system_t1[$i]+idle_t1[$i]+iowait_t1[$i]+irq_t1[$i]+softirq_t1[$i]+steal_t1[$i]+guest_t1[$i]+guest_nice))
done

sleep $sleep

for (( i = 0; i < $NPROC; i++ )); do
((sedline=i+2))
procstat_t2=(`cat /proc/stat | grep '^cpu' |sed -n "$sedline,$sedline p"`)
user_t2[$i]=${procstat_t2[1]}
nice_t2[$i]=${procstat_t2[2]}
system_t2[$i]=${procstat_t2[3]}
idle_t2[$i]=${procstat_t2[4]}
iowait_t2[$i]=${procstat_t2[5]}
irq_t2[$i]=${procstat_t2[6]}
softirq_t2[$i]=${procstat_t2[7]}
steal_t2[$i]=${procstat_t2[8]}
guest_t2[$i]=${procstat_t2[9]}
guest_nice_t2[$i]=${procstat_t2[10]}
((total_t2[$i]=user_t2[$i]+nice_t2[$i]+system_t2[$i]+idle_t2[$i]+iowait_t2[$i]+irq_t2[$i]+softirq_t2[$i]+steal_t2[$i]+guest_t2[$i]+guest_nice))
done

for (( i = 0; i < $NPROC; i++ )); do
((user_subtracted[$i]=user_t2[$i]-user_t1[$i]))
((nice_subtracted[$i]=nice_t2[$i]-nice_t1[$i]))
((idle_subtracted[$i]=idle_t2[$i]-idle_t1[$i]))
((system_subtracted[$i]=system_t2[$i]-system_t1[$i]))
((iowait_subtracted[$i]=iowait_t2[$i]-iowait_t1[$i]))
((irq_subtracted[$i]=irq_t2[$i]-irq_t1[$i]))
((softirq_subtracted[$i]=softirq_t2[$i]-softirq_t1[$i]))
((steal_subtracted[$i]=steal_t2[$i]-steal_t1[$i]))
((guest_subtracted[$i]=guest_t2[$i]-guest_t1[$i]))
((guest_nice_subtracted[$i]=guest_nice_t2[$i]-guest_nice_t1[$i]))
((total_subtracted[$i]= total_t2[$i]-total_t1[$i]))
done

[ "$1" = "" ] && _s=1

if [ $_s = 1 ]; then
    simple_output
fi

if [ $_a = 1 ]; then
    all_output
fi
