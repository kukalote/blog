<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


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
}
