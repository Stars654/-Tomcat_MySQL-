<?php
function wkname()//对接代码对应标识
{
	$data = array(
	 
	    "29" => "29同系统", 
	    "27" => "27", 
	
	     "benz" => "benz", 
	     "ikun" => "ikun服务器对接", 
	     "ikunapi" => "ikun API对接", 
	       "Bsc" => "Bsc学习平台", 
	  
	     "simple" => "simple",
	    
	     "uu" => "uu学习平台",
	       "30" => "30学习平台",
	     
	     
	    );
	return $data;
}
function getWk($type, $noun, $school, $user, $pass, $name = false){//查课代码
	global $DB;
	global $wk;
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$type}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	//27查课接口
	if ($type == "27") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "school" => $school, "user" => $user, "pass" => $pass, "platform" => $noun);
		$eq_rl = $a["url"];
		$er_url = "$eq_rl/api.php?act=get";
		$result = get_url($er_url, $data);
		$result = json_decode($result, true);
		return $result;
	}
	

	
	
	
	if ($type == "Bsc") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "school" => $school, "user" => $user, "pass" => $pass, "platform" => $noun, "kcid" => $kcid);
$dj_rl = $a["url"];
$dj_url = "$dj_rl/api.php?act=get";
$result = get_url($dj_url, $data);
$result = json_decode($result, true);
return $result;}
	
	if ($type == "sxlm") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "platform" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname);
		$eq_rl = $a["url"];
		$eq_url = "$eq_rl/api.php?act=sxadd";
		$result = get_url($eq_url, $data,$cookie);
		$result = json_decode($result, true);
		if ($result["code"] == "0") {
			$b = array("code" => 1, "msg" => "下单成功");
		} else {
			$b = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;} 
	//uu学习平台查课接口 放在/Checkorder/ckjk.php 文件
if ($type == "uu") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "school" => $school, "user" => $user, "pass" => $pass, "platform" => $noun, "kcid" => $kcid);
$uu_rl = $a["url"];
$uu_url = "$uu_rl/api.php?act=get";
$result = get_url($uu_url, $data);
$result = json_decode($result, true);
return $result;}



	else if ($type == "benz") {
		$data = array("token" => $token, "school" => $school, "user" => $user, "pass" => $pass, "ptid" => $noun);
		$benz_rl = $a["url"];
		$benz_url = "https://$benz_rl/api/query";
		$result = get_url($benz_url, $data);
		$result = json_decode($result, true);
		return $result;
	}

else if ($type == "simple") {
    $data = array("token" => $token, "school" => $school, "user" => $user, "pass" => $pass, "ptid" => $noun);
    $url = $a["url"];
    $simple_url = "http://$url/Api/Get";
    $result = get_url($simple_url, $data);
    $result = json_decode($result, true);
    if ($result['code'] != 1)return ["code" => - 1, 'msg' => $result['msg']];
    foreach ($result['children'] as $row) {
        $json_data[] = ['id' => $row['id'], 'name' => $row['label']];
    }
    $b = ['code' => 1, 'msg' => '查询成功', 'userName' => $result['student'], 'data' => $json_data];
    return $b;
}




    else if($type == "ikunapi"){
       $ikun_surl = $a["url"];
       $ikun_url = $ikun_surl."/query/?platform=".urlencode($noun)."&school=".urlencode($school)."&account=".$user."&password=".$pass;
       $result =get_url($ikun_url); 
       $result = json_decode($result, true);  
       if ($result["code"] == 1){
           $courseList = $result["data"];
          foreach($courseList as $key => $value){ 
          $json_data[] = [ 
              'name' => $value['courseName'], 
              'id' => $value['courseId'], 
              'teacher' => $value['teacher'], 
              'class' => $value['class'], 
              'sort' => $value['sort'], 
              ]; 
      } 
      $b = [ 'code' => 1, 'msg' => '查询成功', 'data' => $json_data,'userName'=> $result["info"]["name"]];
            
        }else{ 
          $b = ["code" => -1, 'msg' => $result["msg"]];
      }
    return $b;}else if($type == "ikun"){
       $ikun_surl = $a["url"];
       $ikun_url = $ikun_surl."/query/?platform=".urlencode($noun)."&school=".urlencode($school)."&account=".$user."&password=".$pass;
       $result =get_url($ikun_url); 
       $result = json_decode($result, true);  
       if ($result["code"] == 1){
           $courseList = $result["data"];
          foreach($courseList as $key => $value){ 
          $json_data[] = [ 
              'name' => $value['courseName'], 
              'id' => $value['courseId'], 
              'teacher' => $value['teacher'], 
              'class' => $value['class'], 
              'sort' => $value['sort'], 
              ]; 
      } 
      $b = [ 'code' => 1, 'msg' => '查询成功', 'data' => $json_data,'userName'=> $result["info"]["name"]];
            
        }else{ 
          $b = ["code" => -1, 'msg' => $result["msg"]];
      }
    return $b;}
    //一流ck查课接口
	else if($type == "ylck"){
	   $addsalt=md5(mt_rand(0,999).time());
       $data = array("cid" => $noun, "userinfo"=>"$school $user $pass","hash"=>$addsalt);
       $yl_surl = $a["url"];
       $yl_url = "$yl_surl/api/ajax.php?act=getwk";
       $header = ["token:$token",];
       $result = post($yl_url,$data,$header); 
       $result = json_decode($result, true);  
        if ($result["code"] != 1){
            $b = ["code" => -1, 'msg' => $result["msg"]];
        }else{ 
          $courseList = $result["data"];
          foreach($courseList as $key => $value){ 
          $json_data[] = [ 
              'name' => $value['name'], 
              'id' => $value['id'], 
              ]; 
      } 
      $b = [ 'code' => 1, 'msg' => '查询成功', 'userName' => $result["userName"] , 'data' => $json_data];
      }
    return $b;}
  
  
  
  
  
//29
   if ($type == "29") {
       $data = array("uid" => $a["user"], "key" => $a["pass"], "school" => $school, "user" => $user, "pass" => $pass, "platform" => $noun, "kcid" => $kcid);
       $dx_rl = $a["url"];
       $dx_url = "$dx_rl/api.php?act=get";
       $result = get_url($dx_url, $data);
       $result = json_decode($result, true);
       return $result;}
	else {
    print_r("没有了,文件ckjk.php,可能故障：参数缺少，比如平台名错误！！！");die;
	}
}

function addWk($oid){//下单接口代码
	global $DB;
	global $wk;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$cid = $d["cid"];
	$school = $d["school"];
	$user = $d["user"];
	$pass = $d["pass"];
	$kcid = $d["kcid"];
	$kcname = $d["kcname"];
	$noun = $d["noun"];
	$miaoshua = $d["miaoshua"];
	$b = $DB->get_row("select * from qingka_wangke_class where cid='{$cid}' ");
	$hid = $b["docking"];
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$hid}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	
	/*****
	 自己可以根据规则增加下单接口    
	 
	//XXXX下单接口
	else if ($type == "XXXX") {
	$data = array("optoken" => $token,"type" => $noun);  请求体参数自己加
	$XXXX_ul = $a["url"];      变量XXXX自己命名    获取顶级域名
	$XXXX_dingdan = "http://$XXXX_ul/api/CourseQuery/api/";    请求接口   XXXX自己命名
	$result = get_url($XXXX_dingdan, $data, $cookie); 
	$result = json_decode($result, true);
	
	if ($result["code"] == "0") {
		$b = array("code" => 1, "msg" => $result["msg"]);
	} else {
		$b = array("code" => -1, "msg" => $result["msg"]);
	}
	return $b;
    }
	
	
	$token  传的token
	$school  传的学校
	$user    传的账号
	$pass    传的密码
	$noun    传的平台里面的接口编号 
	$kcid    传的课程id
	****/ 
	
 
	
	//27下单接口
    if ($type == "27") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "platform" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname);
		$eq_rl = $a["url"];
		$eq_url = "$eq_rl/api.php?act=add";
		$result = get_url($eq_url, $data,$cookie);
		$result = json_decode($result, true);
		if ($result["code"] == "0") {
			$b = array("code" => 1, "msg" => "下单成功");
		} else {
			$b = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;} 
		
		
		else if ($type == "Bsc") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "platform" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname, "kcid" => $kcid);
$dj_rl = $a["url"];
$dj_url = "$dj_rl/api.php?act=add";
$result = get_url($dj_url, $data);
$result = json_decode($result, true);
if ($result["code"] == "0") {
$b = array("code" => 1, "msg" => "下单成功");
} else {
$b = array("code" => -1, "msg" => $result["msg"]);
}
return $b;} 
		
		
		
		
		elseif ($type == "simple") {
    $data = array("token" => $token, "ptid" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "course" => $kcname, "courseid" => $kcid);
    $url = $a["url"];
    $simple_url = "http://$url/Api/Create";
    $result = get_url($simple_url, $data);
    $result = json_decode($result, true);
    if ($result["code"] == "1")$b = array("code" => 1, "msg" => "添加成功");
    else $b = array("code" => - 1, "msg" => $result['msg']);
    return $b;
}
		
		//uu学习平台下单接口 放在/Checkorder/xdjk.php 文件
else if ($type == "uu") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "platform" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname, "kcid" => $kcid);
$uu_rl = $a["url"];
$uu_url = "$uu_rl/api.php?act=add";
$result = get_url($uu_url, $data);
$result = json_decode($result, true);
if ($result["code"] == "0") {
$b = array("code" => 1, "msg" => "下单成功");
} else {
$b = array("code" => -1, "msg" => $result["msg"]);
}
return $b;} 
		
		
		
		
	
		  if ($type == "benz") {
        if ($school == "") {$school = "自动识别";} else {$school = $school;}
		$data = array("token" => $token, "ptid" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname, "kcid" => $kcid);
		$benz_rl = $a["url"];
		$benz_url = "https://$benz_rl/api/add";
		$result = get_url($benz_url, $data,$cookie);
		$result = json_decode($result, true);
		if ($result["code"] == "0") {
			$b = array("code" => 1, "msg" => "下单成功");
		} else {
			$b = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;} 
		
		 else if ($type == "ikun") {
		$ikun_surl = $a["url"];
        $ikun_url = $ikun_surl."/getorder/?platform=".urlencode($noun)."&school=".urlencode($school)."&account=".$user."&password=".$pass."&course=".urlencode($kcname)."";
        $result =get_url($ikun_url); 
        $result = json_decode($result, true);  
		if ($result["code"] == "1") {
			$b = array("code" => 1, "msg" => $result["msg"],"yid"=>$result["order_token"]);
		} else {
			$b = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;} 
		 else if ($type == "ikunapi") {
		$b = array("code" => 1, "msg" => 'ikun自动获取订单');
		return $b;} 
		
				 //土拨鼠下单接口
    else if ($type == "tuboshu") {
        $b = array("code" => 1, "msg" => "小沐提醒您：下单成功");
        return $b;
    } 
		
	//一流ck下单接口
    else if ($type == "ylck") {
		$data = array("cid" => $noun, "data[0][userinfo]" => "$school $user $pass","data[0][check_row][0][id]" => $kcid,"data[0][check_row][0][name]" => $kcname,"data[0][code]" => 1);
		$yl_rl = $a["url"];
		$yl_url = "$yl_rl/api/ajax.php?act=addwk";
		$header = ["token:$token",];
		$result = post($yl_url,$data,$header); 
		$result = json_decode($result, true);
		if ($result["code"] == "1") {
			$b = array("code" => 1, "msg" => $result["msg"]);
		} else {
			$b = array("code" => -1, "msg" => $result["msg"]);
		}
		return $b;} 
	

//29同系统接口
else if ($type == "29") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "platform" => $noun, "school" => $school, "user" => $user, "pass" => $pass, "kcname" => $kcname, "kcid" => $kcid);
$dx_rl = $a["url"];
$dx_url = "$dx_rl/api.php?act=add";
$result = get_url($dx_url, $data);
$result = json_decode($result, true);
if ($result["code"] == "0") {
$b = array("code" => 1, "msg" => "下单成功");
} else {
$b = array("code" => -1, "msg" => $result["msg"]);
}
return $b;} 
	else{
	    print_r("没有了,可能故障：参数缺少，比如平台名错误！！！");die;
	
	}
	
}

function processCx($oid)//进度代码
{
	global $DB;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$b = $DB->get_row("select hid,user,pass from qingka_wangke_order where oid='{$oid}' ");
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$b["hid"]}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	$user = $b["user"];
	$pass = $b["pass"];
	$kcname = $d["kcname"];
	$school = $d["school"];
	$pt = $d["noun"];
	$kcid = $d["kcid"];
	
	//27同步状态接口
	if ($type == "27") {
		$data = array("username" => $user);
		$eq_rl = $a["url"];
		$eq_url = "$eq_rl/api.php?act=chadan";
		$result = get_url($eq_url, $data);
		$result = json_decode($result, true);
		if ($result["code"] == "1") {
			foreach ($result["data"] as $res) {
				$yid = $res["id"];
				$kcname = $res["kcname"];
				$status = $res["status"];
				$process = $res["process"];
				$remarks = $res["remarks"];
				$kcks = $res["courseStartTime"];
				$kcjs = $res["courseEndTime"];
				$ksks = $res["examStartTime"];
				$ksjs = $res["examEndTime"];
				$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => $remarks);
			}
		} else {
			$b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
		}
		return $b;}
		//ikun同步进度
		 else if ($type == "ikun") { 
        $ikun_surl = $a["url"];
        $ikun_url = $ikun_surl."/order/?token=".$b["yid"];
        $result =get_url($ikun_url); 
        $result = json_decode($result, true);
        if ($result["states"]!='') {
        $status = $result["states"];
        $pro=explode('/',$result["progress"]);
    	$process=round($pro[0]/$pro[1]*100,2)."%";
    	if ($process=="NAN%") {
            $process="0%";
        }
        if ($result["progress"]=="无") {
            $process=$result["progress"];
        }
        if ($b["noun"]=="职教云(作业考试)") {
            $process=$result["progress"];
        }
        $remarks = $result["remarks"]; 
        $detailed = $result["detailed"]." | "; 
        $times = $result["times"]; 
        $b[] = array("code" => 1, "msg" => "查询成功", "yid" => $b["yid"], "name" => $b["name"], "kcname" => $b["kcname"], "user" => $user, "pass" => $pass,  "status_text" => $status, "process" => $process, "remarks" => $detailed.$remarks); 
        }
        return $b;
        
    }//ikun同步进度
		 else if ($type == "ikunapi") { 
        $b[] = array("code" => -1, "msg" => "自动更新");
        return $b;
        
    }
    else if ($type == "Bsc") {
$data = array("username" => $user,"uid" => $a["user"], "key" => $a["pass"], "noun" => $pt);
$dj_rl = $a["url"];
$dj_url  = "$dj_rl/api.php?act=chadan";
$result = get_url($dj_url, $data);
$result = json_decode($result, true);
if ($result["code"] == "1") {
foreach ($result["data"] as $res) {
$yid = $res["id"];
$kcname = $res["kcname"];
$status = $res["status"];
$process = $res["process"];
$remarks = $res["remarks"];
$kcks = $res["courseStartTime"];
$kcjs = $res["courseEndTime"];
$ksks = $res["examStartTime"];
$ksjs = $res["examEndTime"];
$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => $remarks);
}
} else {
$b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
}
return $b;
}
    elseif ($type == "simple") {
    if(!empty($yid))$data = array("token"=>$token, "oid"=>$yid);
    else $data = array("token" => $token, "user" => $user, "pass" => $pass, "course" => $kcname, "courseid"=>$kcid, "cid"=>$pt);
    $url = $a['url'];
    $simple_url = "http://$url/Api/Query";
    $result = get_url($simple_url, $data);
    $result = json_decode($result, true);
    if(!$result)return ["code"=>-1, "msg"=>"进度服务器出小差了，待会试试呗~"];
    if ($result["code"] != 1)return ["code"=>-1,"msg"=>$result['msg']];
    foreach ($result["data"] as $row) {
        $yid = $row['oid'];
        $user = $row['user'];
        $pass = $row['pass'];
        $kcname = $row['course'];
        $status = $row['status'];
        $progress = $row['progress'];
        $process = $row['process'];
        $kcjs = $row["kcjs"];
        $ksks = $row["ksks"];
        $ksjs = $row["ksjs"];
        if(in_array($status, ['已暂停', '明天继续', '待处理', '考试中', '平时分']))$status="进行中";
        if (!$process) $process = "暂无详情";
        // $pro = "进度：" . $progress . "% | " . $process;
        $b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $progress, "remarks" => $process);
    }
    return $b;
}
    
    else if ($type == "benz") {
		$data = array( "token" => $token,"user" => $user,"noun" => $noun);
  $benz_rl = $a["url"];
  $benz_rl = "https://$benz_rl/api/order";
  $result = get_url($benz_rl, $data,$cookie);
  $result = json_decode($result, true);
  if ($result["code"] == "1") {
   foreach ($result["data"] as $res) {
    $yid = $res["id"];
    $kcname = $res["kcname"];
    $status = $res["status"];
    $process = $res["process"];
    $remarks = $res["remarks"];
    $kcks = $res["courseStartTime"];
    $kcjs = $res["courseEndTime"];
    $ksks = $res["examStartTime"];
    $ksjs = $res["examEndTime"];
    $b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "kcks" => $kcks, "kcjs" => $kcjs, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => $remarks);
   }
  } else {
   $b[] = array("code" => -1, "msg" => "查询失败,请重试");
  }
  return $b;}


		
	
		
    //一流ck进度
 else if ($type == "ylck") {
		$data = array("cx[page]" => 1,"cx[pagesize]" => 200,"cx[qq]" => $user);
		$yl_rl = $a["url"];
		$yl_url = "$yl_rl/api/ajax.php?act=orderlist";
		$header = ["token:$token",];
		$result = post($yl_url,$data,$header);
		$result = json_decode($result, true);
		if ($result["code"] == "1") {
			foreach ($result["data"] as $res) {
				$yid = $res["oid"];
				$kcname = $res["kcname"];
				$kcid = $res["kcid"];
				$status = $res["status"];
				$process = $res["process"];
				$remarks = $res["remarks"];
				$kcks = $res["courseStartTime"];
				$kcjs = $res["courseEndTime"];
				$ksks = $res["examStartTime"];
				$ksjs = $res["examEndTime"];
				if ($res["fenshu"]!='') {
				    $fenshu = "| 考试分数：{$res["fenshu"]}";
				}
				
				$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "kcid" => $kcid, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => "$remarks $fenshu");
			}
		} else {
			$b[] = array("code" => -1, "msg" => "查询失败,请联系管理员");
		}
		return $b;}
		
		
	    if ($type == "uu") {
    $uu_rl = $a["url"];
    $kcname_encoded = urlencode($kcname);
    $user_encoded = urlencode($user);
    $uu_url = "$uu_rl/api/search?uid=".$a["user"]."&key=".$a["pass"]."&kcname=".$kcname_encoded."&username=".$user_encoded."&cid=".$d["noun"];
    $result = get_url($uu_url,$data);
    $result = json_decode($result, true);
    if ($result["code"] == "1") {
        foreach ($result["data"] as $res) {
            $yid = $res["id"];
            $kcname = $res["kcname"];
            $status = $res["status"];
            $process = $res["process"];
            $remarks = $res["remarks"];
            $kcks = $res["courseStartTime"];
            $kcjs = $res["courseEndTime"];
            $ksks = $res["examStartTime"];
            $ksjs = $res["examEndTime"];
            $zhgx = $res["zhgx"];
            $b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs, "status_text" => $status, "process" => $process, "remarks" => $remarks,"zhgx" =>  $zhgx);
        }
    } else {
        $b[] = array("code" => -1, "msg" => $result["msg"]);
    }
    return $b;
}

 
// //29
 else if ($type == "29") {
    $data = array("username" => $user);
$dx_rl = $a["url"];
$dx_url = "$dx_rl/api.php?act=chadan";
$result = get_url($dx_url, $data);
$result = json_decode($result, true);
if ($result["code"] == "1") {
foreach ($result["data"] as $res) {
$yid = $res["id"];
$kcname = $res["kcname"];
$status = $res["status"];
$process = $res["process"];
$zhgx = $res["zhgx"];
$remarks = $res["remarks"];
$kcks = $res["courseStartTime"];
$kcjs = $res["courseEndTime"];
$ksks = $res["examStartTime"];
$ksjs = $res["examEndTime"];

if ($status == '订单数据已提交入库，祝老板顺风顺水顺财神' ){
				    $remarks = '排个队，等待上号';
				}
				
				
$b[] = array("code" => 1, "msg" => "查询成功", "yid" => $yid, "kcname" => $kcname, "user" => $user, "pass" => $pass, "ksks" => $ksks, "ksjs" => $ksjs,  "zhgx"=>$zhgx,   "status_text" => $status, "process" => $process, "remarks" => $remarks);
}
} else {
$b[] = array("code" => -1, "msg" => $result["msg"]);
}
return $b;}
	else {
      $b[] = array("code" => -1, "msg" => "查询失败,请联系管理员"); 
	}
}





function budanWk($oid){//补刷代码
	global $DB;
	global $wk;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$b = $DB->get_row("select hid,yid,user from qingka_wangke_order where oid='{$oid}' ");
	$hid = $b["hid"];
	$yid = $b["yid"];
	$user = $b["user"];
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$hid}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	$cid = $d["cid"];
	$school = $d["school"];
	$user = $d["user"];
	$pass = $d["pass"];
	$kcid = $d["kcid"];
	$kcname = $d["kcname"];
	$noun = $d["noun"];
	$miaoshua = $d["miaoshua"];

	//27补刷
	if ($type == "27") {
		$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
		$eq_rl = $a["url"];
		$eq_url = "$eq_rl/api.php?act=budan";
		$result = get_url($eq_url, $data);
		$result = json_decode($result, true);
		return $result;
	} 
	
	
	elseif ($type == "simple") {
    if(!$yid)return array("code" => - 1, "msg" => "请先拉取进度后再补刷！");
    $data = array("token"=>$token,"id"=>$yid);
    $url = $a["url"];
    $simple_url = "http://$url/Api/Repeat";
    $result = get_url($simple_url, $data);
    $result = json_decode($result, true);
    if($result['code']==1)$b = array("code" => 1, "msg" => "操作成功！");
    else $b = array("code" => - 1, "msg" => $result['msg']);
    return $b;
}
if ($type == "benz") {
		$data = array("token" => $token, "id" => $yid);
		$benz_rl = $a["url"];
		$benz_url = "https://$benz_rl/api/reset";
		$result = get_url($benz_url, $data);
		$result = json_decode($result, true);
		return $result;
	} 
		 if ($type == "Bsc") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
$dj_rl = $a["url"];
$dj_url = "$dj_rl/api.php?act=budan";
$result = get_url($dj_url, $data);
$result = json_decode($result, true);
return $result;}
		 
		 //uu学习平台补刷 放在/Checkorder/bsjk.php 文件
if ($type == "uu") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
$uu_rl = $a["url"];
$uu_url = "$uu_rl/api.php?act=budan";
$result = get_url($uu_url, $data);
$result = json_decode($result, true);
return $result;}
		 
	//ikun补刷
 else if ($type == "ikun") {
        $ikun_surl = $a["url"];
        $ikun_url = $ikun_surl."/uporder/?token=".$yid."&state=".urlencode("待处理");
        $result =get_url($ikun_url); 
        $result = json_decode($result, true);
        if ($result["code"] == 1) {
            $b = array("code" => 1, "msg" => $result["msg"]);
        } else {
            $b = array("code" => -1, "msg" => $result["msg"]);
        }
   return $b;   
 }
 //ikun补刷
 else if ($type == "ikunapi") {
     $DB->query("update qingka_wangke_order set status='待处理',`bsnum`=bsnum+1 where oid='{$oid}' ");
        $b = array("code" => 1, "msg" =>"成功加入线程，正在重新上号");
   return $b;   
 }
	//一流ck补刷	
else if ($type == "ylck") {
		$data = array("oid"=>$yid);
		$yl_rl = $a["url"];
		$yl_url = "$yl_rl/api/ajax.php?act=order_budan";
		$header = ["token:$token",];
		$result = post($yl_url,$data,$header);
		$result = json_decode($result, true);
		if($result['code']=='1'){
        		$b=array("code"=>1,"msg"=>$result['msg']);	
    		}else{				
				$b=array("code"=>-1,"msg"=>$result['msg']);		
			}			
			return $b;      
	} 
	 if ($type == "29") {
       $data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
       $dx_rl = $a["url"];
       $dx_url = "$dx_rl/api.php?act=budan";
       $result = get_url($dx_url, $data);
       $result = json_decode($result, true);
       return $result;
    }

}









function ztWk($oid){
	global $DB;
	global $wk;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$b = $DB->get_row("select hid,yid,user from qingka_wangke_order where oid='{$oid}' ");
	$hid = $b["hid"];
	$yid = $b["yid"];
	$user = $b["user"];
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$hid}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	$cid = $d["cid"];
	$school = $d["school"];
	$user = $d["user"];
	$pass = $d["pass"];
	$kcid = $d["kcid"];
	$kcname = $d["kcname"];
	$noun = $d["noun"];
	$miaoshua = $d["miaoshua"];

	if ($type == "uu") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
$uu_rl = $a["url"];
$uu_url = "$uu_rl/api.php?act=zt";
$result = get_url($uu_url, $data);
$result = json_decode($result, true);
return $result;}
	else {
				$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
		}
}




function msWk($oid){
	global $DB;
	global $wk;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$b = $DB->get_row("select hid,yid,user from qingka_wangke_order where oid='{$oid}' ");
	$hid = $b["hid"];
	$yid = $b["yid"];
	$user = $b["user"];
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$hid}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	$cid = $d["cid"];
	$school = $d["school"];
	$user = $d["user"];
	$pass = $d["pass"];
	$kcid = $d["kcid"];
	$kcname = $d["kcname"];
	$noun = $d["noun"];
	$miaoshua = $d["miaoshua"];

	if ($type == "uu") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid);
$uu_rl = $a["url"];
$uu_url = "$uu_rl/api.php?act=ms_order";
$result = get_url($uu_url, $data);
$result = json_decode($result, true);
return $result;}
	else {
				$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
		}
}



function xgmm($oid,$xgmm){
	global $DB;
	global $wk;
	$d = $DB->get_row("select * from qingka_wangke_order where oid='{$oid}' ");
	$b = $DB->get_row("select hid,yid,user from qingka_wangke_order where oid='{$oid}' ");
	$hid = $b["hid"];
	$yid = $b["yid"];
	$user = $b["user"];
	$a = $DB->get_row("select * from qingka_wangke_huoyuan where hid='{$hid}' ");
	$type = $a["pt"];
	$cookie = $a["cookie"];
	$token = $a["token"];
	$ip = $a["ip"];
	$cid = $d["cid"];
	$school = $d["school"];
	$user = $d["user"];
	$pass = $d["pass"];
	$kcid = $d["kcid"];
	$kcname = $d["kcname"];
	$noun = $d["noun"];
	$miaoshua = $d["miaoshua"];

	if ($type == "uu") {
$data = array("uid" => $a["user"], "key" => $a["pass"], "id" => $yid, "xgmm" => $xgmm);
$uu_rl = $a["url"];
$uu_url = "$uu_rl/api.php?act=xgmm";
$result = get_url($uu_url, $data);
$result = json_decode($result, true);
return $result;}
	else {
				$b = array("code" => -1, "msg" => "接口异常，请联系管理员");
		}
}




?>