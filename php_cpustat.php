<?php

$timerange = null;
$inforlevel = 's';
//if you need to use this in brower or want to adjust timerange, just set value like $_GET or number .
//$timerange = $_GET['timerange'];
//$timerange = 5;
//$inforlevel = 's'
if ($timerange) {
    echopcpu($inforlevel, $timerange);
} else {
    echopcpu();
}

function echopcpu($inforlevel = 's', $timerange = 1)
{
    //echo $timerange;
    $procstat_t1 = getprocstat();
    sleep($timerange);
    $procstat_t2 = getprocstat();
    $nproc = getnproc();
    for ($cpuid = 0; $cpuid < $nproc; ++$cpuid) {
        foreach ($procstat_t2[$cpuid] as $column => $value) {
            $diffstat[$cpuid][$column] = $procstat_t2[$cpuid][$column] - $procstat_t1[$cpuid][$column];
        }
        $diffstat[$cpuid]['total'] = array_sum($procstat_t2[$cpuid]) - array_sum($procstat_t1[$cpuid]);
        $pcpu = 100 * ($diffstat[$cpuid]['total'] - $diffstat[$cpuid]['idle']) / $diffstat[$cpuid]['total'];
        var_dump($pcpu);
        $pcpu = round($pcpu, 2);
        echo 'cpu'.$cpuid."\t".$pcpu.'%';
        echo "\n";
    }
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
    //get the information of processing units by cat /proc/stat
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
/*
        $tmpsum = array_sum($tmp[$cpuid]);
        $time = time();
        $tmp[$cpuid]['total'] = $tmpsum;
        $tmp[$cpuid]['time'] = $time;
*/
    }

    return $tmp;
}
