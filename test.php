<?php
/**
 * 体彩大乐透模拟机选随机号码
 * @copyright LUCKY
 * @author Cfp
 * @file test.php
 * @version v.1.0
 * @date  2018/4/3 19:47
 *
 */

/**
 * Class LotteryClass
 * @author Cfp
 * @$_type int 彩票类型 1 大乐透 2 待定 3 待定
 * @$_num int 模拟数据组数
 * @date  2017/9/14 13:58
 */
class LotteryClass {
    public $_type;//1体彩大乐透
    public $_num;//模拟数据组数

    function __construct($type='',$num=''){ //初始化对象，将初始化值放在括号内
        $this->_num=$num;
        $this->_type=$type;
    }

    public function setType($value){
        $this->_type = $value;
    }

    public function setNum($value){
        $this->_num = $value;
    }

    //体彩大乐透
    public function getLotteryNumberDLT(){
        $temp_str = '';
        $temp_arr = array_merge($this->getNoRand(1,35,5),$this->getNoRand(1,12,2));//生成大乐透模拟数据数组

        foreach($temp_arr as $key => $value){//拼接成数组
            if($value < 10 ){
                $temp_value = '0'.$value;//一个数则做前置0处理
            }else{
                $temp_value = $value;
            }
            if($key == 4){
                $temp_str .= $temp_value.'  +  ';
            }else{
                $temp_str .= $temp_value.' _ ';
            }
            $temp_str .= $temp_value.' _ ';
        }
        return trim($temp_str,' _ ');
    }

    public function getLotteryNumberDLTArray(){
        $temp_arr = array_merge($this->getNoRand(1,35,5),$this->getNoRand(1,12,2));//生成大乐透模拟数据数组
        return $temp_arr;
    }
    public function getLotteryNumberDLTArrayMore(){
        $temp_data = array();
        if($this->_num){
            for($i=1;$i<=$this->_num;$i++){
                $temp_data[$i]= $this->getLotteryNumberDLTArray();
            }
        }
        return $temp_data;
    }

    public function getLotteryNumberDLTMore(){
        $temp_data = array();
        //$temp_data['0'] = '体彩大乐透，祝君中奖~';
        if($this->_num){
            for($i=1;$i<=$this->_num;$i++){
                $temp_data[$i]= $this->getLotteryNumberDLT();
            }
        }
        return $temp_data;
    }

    protected function getNoRand($begin=0,$end=20,$limit=5){
        $rand_array=range($begin,$end);
        shuffle($rand_array);//调用现成的数组随机排列函数
        $arr_tmp = array_slice($rand_array,0,$limit);
        sort($arr_tmp);
        return $arr_tmp;//截取前$limit个
    }

}

$Lottery_obj = new LotteryClass(1,5);
//$test_data = $Lottery_obj->getLotteryNumberDLTMore();
$test_data2 = $Lottery_obj->getLotteryNumberDLTArrayMore();

//var_dump($test_data2);

/*
array (size=6)
  0 => string '体彩大乐透，祝君中奖~' (length=31)
  1 => string '18 _ 21 _ 02 _ 20 _ 09  +  11 _ 12' (length=34)
  2 => string '28 _ 07 _ 18 _ 09 _ 27  +  10 _ 07' (length=34)
  3 => string '08 _ 06 _ 12 _ 19 _ 30  +  04 _ 03' (length=34)
  4 => string '32 _ 01 _ 26 _ 18 _ 16  +  09 _ 11' (length=34)
  5 => string '34 _ 08 _ 21 _ 15 _ 07  +  08 _ 04' (length=34)
*/

?>
