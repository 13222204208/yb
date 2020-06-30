<?php

namespace App\Http\Controllers\Api;

use App\Model\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAuthRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json('reg！',200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterAuthRequest $request)
    {
        if ($request->register_ip) {
            if(!filter_var($request->register_ip, FILTER_VALIDATE_IP)) {
                $request->register_ip ="错误的ip格式";
            }
        }else{
            $request->register_ip ="无法获取ip";
        }

            $user = new UserInfo;
            $user->username = $request->username;
            $user->password = bcrypt($request->password);
            $user->register_ip = $request->register_ip;
            $user->register_time = date('Y-m-d H:i:s',time());
            $user->save();
    
    /*         if ($this->loginAfterSignUp) {
                return $this->login($request);
            } */
    
            return response()->json([
                'code' => 201,
                'msg' =>"注册成功",
                'data' => $user
            ]);
             }

 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
