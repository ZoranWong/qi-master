<?php

use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Support\Carbon;

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
        if (stripos($url, 'http') == 0 || stripos($url, 'https') == 0) {
            return $url;
        }
        $disk = config('admin.upload.disk');

        if ($url && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk(config('admin.upload.disk'))->url($url);
        }

        return admin_asset('/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg');
    }
}

if (!function_exists('orderNo')) {
    function orderNo($prefix = 'U', $count = 10000)
    {
        $time = (int)(microtime(true) * 1000);
        gmp_random_seed($time);
        $date = date('YmdHis');
        $next = (((int)$date) + 1);
        $ids = cache($date, []);
        if (empty($ids)) {
            $ids = [];
            for ($i = 0; $i < $count; $i++) {
                $ids[] = sprintf("%04X", $i);
            }
            shuffle($ids);
        }
//        $num = count($ids) - 1;
        $id = count($ids) > 0 ? array_pop($ids) : orderNo($prefix, $count);
//        array_splice($ids, $num, 1);
        cache([$date => $ids], Carbon::parse($next));
        return $prefix . $date . $id;
    }
}

if (!function_exists('isMobile')) {
    function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return TRUE;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;// 找不到为flase,否则为TRUE
        }
        // 判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array(
                'mobile',
                'nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return TRUE;
            }
        }
        if (isset ($_SERVER['HTTP_ACCEPT'])) { // 协议法，因为有可能不准确，放到最后判断
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return TRUE;
            }
        }
        return FALSE;
    }
}

if (!function_exists('api_route')) {
    function api_route(string $routeAlias)
    {
        return app(UrlGenerator::class)->version(config('api.version'))->route($routeAlias);
    }
}

/**
 * 将一个字符串部分字符用$re替代隐藏
 * @param string $string 待处理的字符串
 * @param int $start 规定在字符串的何处开始，
 *                            正数 - 在字符串的指定位置开始
 *                            负数 - 在从字符串结尾的指定位置开始
 *                            0 - 在字符串中的第一个字符处开始
 * @param int $length 可选。规定要隐藏的字符串长度。默认是直到字符串的结尾。
 *                            正数 - 从 start 参数所在的位置隐藏
 *                            负数 - 从字符串末端隐藏
 * @param string $re 替代符
 * @return string   处理后的字符串
 */
function hidestr($string, $start = 0, $length = 0, $re = '*')
{
    if (empty($string)) return false;
    $strarr = array();
    $mb_strlen = mb_strlen($string);
    while ($mb_strlen) {//循环把字符串变为数组
        $strarr[] = mb_substr($string, 0, 1, 'utf8');
        $string = mb_substr($string, 1, $mb_strlen, 'utf8');
        $mb_strlen = mb_strlen($string);
    }
    $strlen = count($strarr);
    $begin = $start >= 0 ? $start : ($strlen - abs($start));
    $end = $last = $strlen - 1;
    if ($length > 0) {
        $end = $begin + $length - 1;
    } elseif ($length < 0) {
        $end -= abs($length);
    }
    for ($i = $begin; $i <= $end; $i++) {
        $strarr[$i] = $re;
    }
    if ($begin >= $end || $begin >= $last || $end > $last) return false;
    return implode('', $strarr);
}

