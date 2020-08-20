<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 异步接口返回结果标准方法(for vue)
     * @param $data
     * @param string $msg
     * @param string $action
     * @param int $errno
     * @return array
     */
    protected function asyncShowResult($data, $msg = '', $action = 'success',$errno = 0)
    {
        return [
            'error' => $errno,
            'action' => $action,
            'msg' => $msg,
            'data' => $data,
        ];
    }

    /**
     * 异步接口返回错误标准方法(for vue)
     * @param $err_msg
     * @param int $errno
     * @param string $action
     * @param array $data
     * @return array
     */
    protected function asyncShowError($err_msg, $errno = 10000, $action = 'alert', $data = array())
    {
        return $this->asyncShowResult($data, $err_msg, $action, $errno);
    }
}
