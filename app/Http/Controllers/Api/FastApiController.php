<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class FastApiController extends Controller
{

        /**
         * 模拟POST提交
         * @param string $url 地址
         * @param string $data 提交的数据
         * @return string 返回结果
         */
        public function post_url($url, $data)
        {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)'); // 模拟用户使用的浏览器
        //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        //curl_setopt($curl, CURLOPT_AUTOREFERER, 1);  // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1);       // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  // Post提交的数据包x
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);     // 设置超时限制 防止死循环
        //curl_setopt($curl, CURLOPT_HEADER, 0);      // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        if(curl_errno($curl))
        {
            echo 'Errno'.curl_error($curl);//捕抓异常
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
        }

    public function register(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user= JWTAuth::authenticate($request->token);
        if ($user->username != $request->MemberAccount) {
            return response()->json([
                'code' => 0,
                'msg' => '用户名错误',
            ], 200);
        }
        $data = array();
        $data['ApiKey']= $request->ApiKey;
        $data['Timestamp'] = intval($request->Timestamp);
        $data['Game'] = $request->Game;
        $data['MemberAccount'] = $request->MemberAccount;
        $data['MemberPassword'] = $request->MemberPassword;
        $data['Hash'] = $request->Hash;
        $data = json_encode($data);
        $this->curl_post_https($request->url,$data);
    }
}
