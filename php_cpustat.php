<?php

$procstatarray_s1 = getprocstat();

sleep(1);

$procstatarray_s2 = getprocstat();

$nproc = getnproc();

for ($cpuid = 0; $cpuid < $nproc; ++$cpuid) {
    $totalCpuTime[$cpuid] = $procstatarray_s2[$cpuid]['total'] - $procstatarray_s1[$cpuid]['total'];
    $idleCpuTime[$cpuid] = $procstatarray_s2[$cpuid]['idle'] - $procstatarray_s1[$cpuid]['idle'];
    $pcpu[$cpuid] = 100 * ($totalCpuTime[$cpuid] - $idleCpuTime[$cpuid]) / $totalCpuTime[$cpuid];
    $pcpu[$cpuid] = round($pcpu[$cpuid], 2);
    echo 'cpu'.$cpuid.' '.$pcpu[$cpuid].'%';
    echo "\n";
}

function getnproc()
{
    //get the number of processing units available
    exec('nproc', $nproc);
    $nproc = $nproc[0];

    return $nproc;
}

function getprocstat()
{
    $nproc = getnproc();

    exec('cat /proc/stat|grep "^cpu"|tail -n '.$nproc, $procstat);
    foreach ($procstat as $cpuid => $v) {
        preg_match('/cpu(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/', $v, $procstat_percpu);
        $tmp[$cpuid] = array(
                'user' => (int) $procstat_percpu[2],
                'nice' => (int) $procstat_percpu[3],
                'system' => (int) $procstat_percpu[4],
                'idle' => (int) $procstat_percpu[5],
                'iowait' => (int) $procstat_percpu[6],
                'irq' => (int) $procstat_percpu[7],
                'softirq' => (int) $procstat_percpu[8],
                'steal' => (int) $procstat_percpu[9],
                'guest' => (int) $procstat_percpu[10],
                'guest_nice' => (int) $procstat_percpu[11],
                );
        $tmpsum = array_sum($tmp[$cpuid]);
        $time = time();
        $tmp[$cpuid]['total'] = $tmpsum;
        $tmp[$cpuid]['time'] = $time;
    }

    return $tmp;
}
