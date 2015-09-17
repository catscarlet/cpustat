<?php


$procstatarray_s1 = getprocstat();

foreach ($procstatarray_s1 as $cpuid => $procstat_s1) {
    $totalCpuTime_s1[$cpuid] = array_sum($procstat_s1);
    $idleCpuTime_s1[$cpuid] = $procstat_s1['idle'];
}

sleep(1);

$procstatarray_s2 = getprocstat();

foreach ($procstatarray_s2 as $cpuid => $procstat_s2) {
    $totalCpuTime_s2[$cpuid] = array_sum($procstat_s2);
    $idleCpuTime_s2[$cpuid] = $procstat_s2['idle'];
}

for ($cpuid = 0; $cpuid < 2; ++$cpuid) {
    $totalCpuTime[$cpuid] = $totalCpuTime_s2[$cpuid] - $totalCpuTime_s1[$cpuid];
    $idleCpuTime[$cpuid] = $idleCpuTime_s2[$cpuid] - $idleCpuTime_s1[$cpuid];
    $pcpu[$cpuid] = 100 * ($totalCpuTime[$cpuid] - $idleCpuTime[$cpuid]) / $totalCpuTime[$cpuid];
    $pcpu[$cpuid] = (int)$pcpu[$cpuid];
    echo $pcpu[$cpuid].'%';
    echo "\n";
}

//function calculatepcpu(){}


function getprocstat()
{
    exec('nproc', $nproc);
    $nproc = $nproc[0];
    //$nproc = 1;
    exec('cat /proc/stat|grep "^cpu"|tail -n '.$nproc, $procstat);
    foreach ($procstat as $k => $v) {
        preg_match('/cpu(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)\s+(\d+)/', $v, $procstat_percpu);
        $tmp[$k] = array(
                //'cpu' => (int) $procstat_percpu[1],
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
    }
    //echo $k;
    //var_dump($tmp);
    return $tmp;
}
