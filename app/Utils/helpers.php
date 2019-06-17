<?php

if (!function_exists('upperCaseSplit')) {
    function upperCaseSplit(string $des, string $delimiter = ' ')
    {
        $strArr = preg_split('/(?=[A-Z])/', $des);
        if (count($strArr) <= 1) {
            return $des;
        }
        return strtolower(implode($strArr, $delimiter));
    }
}

if (!function_exists('underlineCaseToCamelCase')) {
    function underlineCaseToCamelCase($var)
    {
        return preg_replace_callback('/_([a-zA-Z])/', function ($res) {
            return strtoupper($res[1]);
        }, $var);
    }
}

if (!function_exists('getImageUrl')) {
    function getImageUrl($url)
    {
        $disk = config('admin.upload.disk');

        if ($url && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk(config('admin.upload.disk'))->url($url);
        }

        return admin_asset('/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg');
    }
}

if (!function_exists('orderNo')) {
    function orderNo($prefix = 'U', $count = 1000)
    {
        $time = (int)(microtime(true) * 1000);
        gmp_random_seed($time);
        $date = date('Ymdh');
        $next = (((int) $date) + 1).'0000';
        $ids = cache($date, []);
        if (empty($ids)) {
            $ids = [];
            for ($i = 0; $i < $count; $i++) {
                $ids[] = sprintf("%04X", $i);
            }
        }
        $num = random_int(0, count($ids));
        $id = $ids[$num];
        array_splice($ids, $num, 1);
        cache([$date => $ids], \Illuminate\Support\Carbon::parse($next));
        return $prefix.$date.$id;
    }
}
