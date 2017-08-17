<?php
/**
 * Created by PhpStorm.
 * User: wangzd
 * Date: 2017/3/17
 * Time: 上午11:16
 */

namespace SimpleShop\Store\Exceptions;

use RuntimeException;
use Log;

class ReturnException extends RuntimeException
{
    /**
     * @var int http的状态码
     */
    protected $statusCode = 500;

    /**
     * @var int 错误的个数
     */
    protected $errorNum = 1;

    /**
     * @var array 错误的信息
     */
    private $messages;

    /**
     * @var array 最终的错误信息
     */
    protected $output;

    /**
     * @var null|\Throwable
     */
    protected $previous;

    /**
     * ReturnException constructor.
     *
     * @param string $messages
     * @param int $errorCode
     * @param \Throwable|null $e
     */
    public function __construct($messages, int $errorCode = 0, \Throwable $e = null)
    {
        // 将output保存进属性
        $this->setMessage($messages)->setErrorNum()->msgArrayToStr()->messageHandler();
        // 将前一个异常放进属性
        $this->previous = $e;
        // 处理前一个异常
        $this->previousHandle();

        parent::__construct($this->messages, $errorCode);
    }

    /**
     * 返回异常的http状态码
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * 返回错误的个数
     *
     * @return int
     */
    public function getErrorNum(): int
    {
        return $this->errorNum;
    }

    /**
     * 将其他类型的message转化为字符串
     *
     * @return $this
     */
    protected function msgArrayToStr()
    {
        $output = '';
        foreach ($this->messages as $index => $item) {
            if ($index == $this->errorNum - 1) {
                $output .= $item;
            } else {
                $output .= $item . ' | ';
            }
        }

        $this->messages = $output;

        return $this;
    }

    /**
     * 设定errorNum
     *
     * @return $this
     */
    protected function setErrorNum()
    {
        if (is_array($this->messages)) {
            $this->errorNum = count($this->messages);
        }

        return $this;
    }

    /**
     * 设置message
     *
     * @param $messages
     * @return $this
     */
    private function setMessage($messages)
    {
        $this->messages = (array)$messages;


        return $this;
    }

    /**
     * 处理message
     *
     * @return array
     */
    protected function messageHandler(): array
    {
        $input = [
            'serverInternal' => [
                '$srvmessage' => $this->messages ?? '操作失败',
            ],
        ];

        $output = [
            'code'     => $this->errorNum,
            'messages' => $input
        ];

        return $this->output = $output;
    }

    /**
     * 获取输出信息
     *
     * @return array
     */
    public function getOut(): array
    {
        return $this->output;
    }

    /**
     * 日志处理
     *
     * @param \Exception $e
     * @param string $message
     * @param string $method
     * @return void
     */
    protected function setLog(\Exception $e, string $message = '服务器错误', string $method = 'info')
    {
        Log::$method($message, [
            'file'    => $e->getFile(),
            'line'    => $e->getLine(),
            'message' => $e->getMessage(),
            'trace'   => $e->getTraceAsString(),
        ]);
    }

    /**
     * 处理异常链的前一个异常
     *
     * @return $this
     */
    protected function previousHandle()
    {
        if (! is_null($this->previous)) {
            Log::error($this->previous->getMessage(),
                ['file' => $this->previous->getFile(), 'line' => $this->previous->getLine()]);
        }

        return $this;
    }
}