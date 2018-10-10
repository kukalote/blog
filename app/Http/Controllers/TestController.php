<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Entity\City;
use App\Entity\Provinces;


class TestController extends Controller
{
    public function anyRuninsert()
    {
exit;
        $i = 9999;
        do{
            $num0 = mt_rand(1, 100);
            $num1 = mt_rand(1, 10);
            $num2 = mt_rand(1, 10);
            $num3 = mt_rand(1, 10);
            $num4 = mt_rand(1, 10);
            $type_num = 10^(($num0+$num1+$num3)%2);
            $num_day = mt_rand( 20, 100 ) - $num1;
            $create_date = date('Y-m-d', strtotime("-{$num_day} day"));
            $insert_data[] = [
                'cbd_id' => $num0,
                'mark_rank' => $type_num,
                'overdue_complete_num' => $num1,
                'complete_num' => $num2,
                'overdue_num' => $num3,
                'task_num' => $num4,
                'create_date' => $create_date,
            ];
            if( $i%200==0 ) {
//                $t = \App\Entity\DvSsCityDay::insert($insert_data);
                $t = \App\Entity\DvSsCbdDay::insert($insert_data);
                $insert_data = array();
                echo "{$t}\n";
            }
            $i--;
        } while( $i>=0 ) ;
//        var_dump($t);exit;
    }

    public function anyMakecity()
    {
        exit;
        try{
        $f = "/var/www/framework/blog/city_code.log";

        $handle = fopen($f, 'r');
        
        $city_name_list = array();
        if ($handle) {
            $insert_data = array();
            while (($buffer = fgets($handle, 4096)) !== false) {
                $info = explode(' ', $buffer);
                if (count($info)==2) {
                    City::insert($insert_data);
                    // 省 或 直辖市
                    $top_type = strtoupper($info[0]);
                    $top_name = trim($info[1]);
                    $insert_data = [
                        'city_name' => $top_name,
                        'type' => $top_type,
                    ];
$city_name_list[] = $top_name;
                    $top_id = City::insertGetId($insert_data);
echo "{$top_name}:{$top_id}\n";
                    $insert_data = array();
                } elseif ($top_type=='Z') {
                    // 直辖市
                    $insert_data[] = [
                        'city_name' => trim($info[0]),
                        'type' => 'O',
                        'zip_code' => trim($info[1]),
                        'zone_code' => trim($info[2]),
                        'pid' => $top_id,
                    ];
$city_name_list[] = trim($info[0]);

                    if (count($info) > 3) {
                        $insert_data[] = [
                            'city_name' => trim($info[3]),
                            'type' => 'O',
                            'zip_code' => trim($info[4]),
                            'zone_code' => trim($info[5]),
                            'pid' => $top_id,
                        ];
$city_name_list[] = trim($info[3]);
                    }
                } elseif ($top_type=='S') {
                    // 省
                    if (count($info)==4) {
                        City::insert($insert_data);
                        $insert_data = array();
                        $insert_data['type'] = $second_type = 'D';
                        $insert_data['city_name'] = $second_name = trim($info[1]);
                        $insert_data['zip_code'] = $second_zip_code = trim($info[2]);
                        $insert_data['zone_code'] = $second_zone_code = trim($info[3]);
                        $insert_data['pid'] = $top_id;
                        
$city_name_list[] = trim($info[1]);
                        $second_id = City::insertGetId($insert_data);
echo "{$second_name}:{$second_id}\n";
                        $insert_data = array();
                    } else {
                        $insert_data[] = [
                            'type' => 'O',
                            'city_name' => trim($info[0]),
                            'zip_code' => trim($info[1]),
                            'zone_code' => trim($info[2]),
                            'pid' => $second_id,
                        ];
$city_name_list[] = trim($info[0]);
                        if (count($info)>3) {
                            $insert_data[] = [
                                'type' => 'O',
                                'city_name' => trim($info[3]),
                                'zip_code' => trim($info[4]),
                                'zone_code' => trim($info[5]),
                                'pid' => $second_id,
                            ];
$city_name_list[] = trim($info[3]);
                        }
                    }
                } else {
echo "{$top_type}\n"; 
                }
            }
            City::insert($insert_data);
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            fclose($handle);
        }

var_dump($city_name_list);exit;
        } catch (\Exception $e) {
            echo "Messages : {$e->getMessage()}, Line : {$e->getLine()} \n";
            exit;
        }
    }


    public function anyMakecityWeather()
    {
        try{
            $f = "/var/www/framework/blog/weather_code.log";

            $weather_data = file_get_contents($f);
            $weather_arr = json_decode($weather_data, true);
            foreach ($weather_arr as $city) {
                if (empty($city['city_code'])) continue;
//                City::where('city_name', 'like', "{$city['city_name']}")->where('weather_code', '!=', '')->update(['weather_code'=>$city['city_code']]);
                Provinces::where('city_name', 'like', "{$city['city_name']}")
                    ->where('weather_code', '')
                    ->update(['weather_code'=>$city['city_code']]);
            }


        } catch (\Exception $e) {
            echo "Messages : {$e->getMessage()}, Line : {$e->getLine()} \n";
            exit;
        }
    }


    public function anyMakeCityPosition()
    {
        try{
            $url = 'https://jingwei.supfree.net/mengzi.asp?id=?';
            $html = file_get_contents($url);
            $html = iconv('gbk', 'utf8', $html);
            $matches = explode('cdiv', $html);
            unset($matches[0], $matches[count($matches)]);
            sort($matches);
            foreach ($matches as $key=>$matche ) {
                $matche = preg_replace('/<[^>]*>/', ' ', $matche);
                $matche = preg_replace('/[a-zA-Z"<>=\r\n\s]+/', ' ', $matche);
                $matches[$key] = explode(' ', $matche);
            }
            var_dump($matches);
        } catch (\Exception $e) {
            echo "Messages : {$e->getMessage()}, Line : {$e->getLine()} \n";
        }
        exit;
    }

    public function anyMakeCityPosition2()
    {
        try{
            $province = [
//                "上海",
//                "云南",
//                "其它岛屿",
//                "内蒙古",
//                "北京",
//                "天津",
//                "山东",
//                "河北",
//                "河南",
//                "安徽",
//                "吉林",
//                "四川",
//                "重庆",
//                "宁夏回族自治区",
//                "山西",
//                "广东",
//                "广西",
//                "新疆",
//                "江苏",
//                "江西",
//                "浙江",
//                "海南",
//                "港澳台",
//                "湖北",
//                "湖南",
//                "甘肃",
//                "福建",
//                "西藏自治区",
//                "贵州",
//                "辽宁",
//                "陕西",
//                "青海",
//                "黑龙江",
            ];
            $url = 'http://www.ximizi.com/JingWeiDu_Results.php?jingweidu_key={province}';
            $urls = array();
            $file = './city_position.log';
            foreach ($province as $val) {
//                $urls[] = str_replace('{province}', $val, $url);
                $target_url = str_replace('{province}', $val, $url);
                $html = file_get_contents($target_url);
                $positions = explode('crm_text_1', $html);
                unset($positions[0]);
                sort($positions);
//echo "{$matches[1]}";exit;

                $position_info = array();
                $count = 1;
                foreach ($positions as $key=>$position) {
                    preg_match_all('/<[^>]+>(.*)<\/[^>]+>/', $position, $matches);

//                    $position_info[] = [
//                        'city_name' => mb_substr($matches[1][0], mb_strlen($val), -4),
//                        'longitude' => floatval(mb_substr($matches[1][1], 3)),
//                        'latitude' => floatval(mb_substr($matches[1][2], 3)),
//                    ];
                    $modify_data = [
                        'longitude' => floatval(mb_substr($matches[1][1], 3)),
                        'latitude' => floatval(mb_substr($matches[1][2], 3)),
                    ];
                    $city_name = mb_substr($matches[1][0], mb_strlen($val), -4);
                    while(1) {
                        try{
                            $effect_rows = City::where('city_name', 'like', "{$city_name}%")
                                ->where('latitude', 0)
                                ->update($modify_data);
var_dump($city_name, $effect_rows);
                        } catch (\Exception $e) {
                            $effect_rows = 0;
                        }
                        break;
                    }
                    if ($effect_rows!==1) {
                        $modify_info = [
                            'city_name' => mb_substr($matches[1][0], mb_strlen($val), -4),
                            'longitude' => floatval(mb_substr($matches[1][1], 3)),
                            'latitude' => floatval(mb_substr($matches[1][2], 3)),
                        ];

                        var_dump($modify_info);
                    }
                }


//                $content = '';
//                foreach ($position_info as $val) {
//                    $content .= "{$val['city_name']} {$val['latitude']} {$val['tititude']}\n";
//                }
//                echo "$content";
//                file_put_contents($file, $content, FILE_APPEND | LOCK_EX);
            }
            

        } catch (\Exception $e) {
            echo "Messages : {$e->getMessage()}, Line : {$e->getLine()} \n";
        }
        exit;
    }


}
