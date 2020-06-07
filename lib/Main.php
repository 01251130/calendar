<?php

    // TODO: 画面側に渡したい変数を、戻り値として返却すること！！！！
    class Calendar{
        public function run(){
            if($_SERVER['REQUEST_METHOD'] === 'GET'){
                return $this->makeCalender();
            }
        }

        private function makeCalender(){
            $weeklyCount = 7; // 1週間の日数
            $dayname = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', );
            if(!isset($_GET['ym'])){
                $firstDay = new DateTime('first day of this month');
                $lastDay = new DateTime('last day of this month');
                $targetYm = $firstDay;
            }else{
                $targetYm = $_GET['ym'];
                $targetYm = DateTime::createFromFormat('Ymd', $targetYm);
                $firstDay = new DateTime('first day of ' . $targetYm->format('Y-m'));
                $lastDay =  new DateTime('last day of ' . $targetYm->format('Y-m'));
            }
            $weekNumber = $firstDay->format('w'); // 今月1日の曜日を取得
            $lastDay = $lastDay->format('t'); // 月末の日付を取得

            $data['weeklyCount'] = $weeklyCount;
            $data['dayname'] = $dayname;
            $data['firstDay'] = $firstDay;

            $data['befYm'] = $targetYm->modify('-1 month')->format('Ymd'); // 先月
            $data['aftYm'] = $targetYm->modify('+2 month')->format('Ymd'); // 来月（$targetYmが先月になっているため、+2する必要あり）

            // 日付を、1週間ごとに分割
            // 1週目
            $weeksDate = array();
            $weeksDate[0] = array();
            $counter = 0;
            for($i=0; $i < $weekNumber ;$i++){
                $weeksDate[0][] = '';
            }
            for($i=0; $i < ($weeklyCount - $weekNumber); $i++){
                $counter++;
                $weeksDate[0][] = $counter;
            }
            // 2週目以降
            for($x=1; $counter < (int)$lastDay; $x++){
                $weeksDate[$x] = array();
                for($y=0; $y < 7; $y++){
                    $counter++;
                    $weeksDate[$x][] = $counter;
                    // 月末の日付が来たらLOOP終了
                    if($counter === (int)$lastDay){
                        break;
                    }
                }
            }
            $data['weeksDate'] = $weeksDate;
            
            return $data;
        }
    }
