<?php

$timerange = 1;
//Level 'a' for all information . Level 's' for simple information .
$inforlevel = 's';
//If you need to use this in brower or want to adjust timerange, just set value like $_GET or a new number .
//$timerange = $_GET['timerange'];

if (isset($argv[1])) {
    $inforlevel = $argv[1];
}

switch ($inforlevel) {
  case 's':
    echopcpu($timerange);
    break;
  case 'a':
    echopcpuall($timerange);
    break;
  default:
    echo "Error. Unrecognized level option. For more information ,please check https://github.com/catscarlet/cpustat\n";
    break;
}

function percentage($denominator, $numerator, $round)
{
    $percentage = 100 * $denominator / $numerator;
    $percentage = round($percentage, $round);

    return $percentage;
}

function echopcpu($timerange)
{
    $procstat_t1 = getprocstat();
    sleep($timerange);
    $procstat_t2 = getprocstat();
    $nproc = getnproc();
    for ($cpuid = 0; $cpuid < $nproc; ++$cpuid) {
        $diffstat[$cpuid] = subtractarray($procstat_t1[$cpuid], $procstat_t2[$cpuid]);
        $diffstat[$cpuid]['total'] = array_sum($procstat_t2[$cpuid]) - array_sum($procstat_t1[$cpuid]);
        $pcpu[$cpuid] = percentage(($diffstat[$cpuid]['total'] - $diffstat[$cpuid]['idle']), $diffstat[$cpuid]['total'], 2);
        echo 'cpu'.$cpuid."\t".$pcpu[$cpuid].'%';
        echo "\n";
    }
}

function echopcpuall($timerange)
{
    $procstat_t1 = getprocstat();
    sleep($timerange);
    $procstat_t2 = getprocstat();
    $nproc = getnproc();
    echo "CPUID\tuser\tnice\tsystem\tidle\tiowait\tirq\tsoftirq\tsteal\tguest\tguest_nice\n";
    for ($cpuid = 0; $cpuid < $nproc; ++$cpuid) {
        $diffstat[$cpuid] = subtractarray($procstat_t1[$cpuid], $procstat_t2[$cpuid]);
        $diffstattotal = array_sum($procstat_t2[$cpuid]) - array_sum($procstat_t1[$cpuid]);
        foreach ($diffstat[$cpuid] as $column => $value) {
            $pcpu[$cpuid][$column] = percentage($diffstat[$cpuid][$column], $diffstattotal, 2);
        }
        echo $cpuid."\t";
        foreach ($pcpu[$cpuid] as $column => $value) {
            echo $value."\t";
        }
        echo "\n";
    }
}

function getnproc()
{
    //Get the number of processing units available
    exec('nproc', $nproc);
    $nproc = $nproc[0];

    return $nproc;
}

function getprocstat()
{
    //Get the information of processing units by cat /proc/stat
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
    }

    return $tmp;
}

function subtractarray($array1, $array2)
{
    if (count($array1) != count($array2)) {
        die('something happened');
    }
    foreach ($array2 as $key => $value) {
        $difference[$key] = $array2[$key] - $array1[$key];
    }

    return $difference;
}
