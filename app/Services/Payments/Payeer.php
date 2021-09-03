<?php

namespace App\Services\Payments;

/**
 * Class Payeer
 *
 * @package App\Services\Payments
 */
class Payeer extends AbstractPayment
{
    const STATUS_SUCCESS = 'success';
    const STATUS_FAIL = 'fail';

    /**
     * Payeer constructor.
     *
     * @param string|null $merchantId
     * @param string|null $secret
     */
    public function __construct(string $merchantId = null, string $secret = null)
    {
        if ($merchantId === null) {
            $merchantId = config('transaction.payeer.merchant_id');
        }

        if ($secret === null) {
            $secret = config('transaction.payeer.secret');
        }

        parent::__construct($merchantId, $secret);
    }

    /**
     * Генерация подписи
     *
     * @param string $orderId ID платежа ("A-z", "_", "0-9")
     * @param float $amount Сумма платежа
     * @param string $curr Валюта
     * @param string $desc Описание
     * @return string
     */
    protected function sign(string $orderId, float $amount, string $curr, string $desc): string
    {
        $sign = [
            $this->merchantId,
            $orderId,
            number_format($amount, 2, '.', ''),
            $curr,
            base64_encode($desc),
            $this->secret
        ];

        return strtoupper(hash('sha256', implode(':', $sign)));
    }

    /**
     * Генерация ссылки для оплаты
     *
     * @param string $orderId ID платежа ("A-z", "_", "0-9")
     * @param float $amount Сумма платежа
     * @param string $desc Описание
     * @param string $currency Валюта
     * @return string
     */
    public function urlForPay(string $orderId, float $amount, string $desc, string $currency = 'USD'): string
    {
        $url = 'https://payeer.com/merchant/';

        $query = [
            'm_shop' => $this->merchantId,
            'm_orderid' => $orderId,
            'm_amount' => number_format($amount, 2, '.', ''),
            'm_curr' => $currency,
            'm_desc' => base64_encode($desc),
            'm_sign' => $this->sign($orderId, $amount, $currency, $desc)
        ];

        return $url . '?' . http_build_query($query);
    }

    /**
     * Обработка ответа от платежного сервиса
     *
     * @return array|null
     * @throws \Exception
     */
    public function processRequest(): array
    {
//        $allowedIps = ['185.71.65.92', '185.71.65.189', '149.202.17.210'];
//
//        if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIps)) {
//            throw new \Exception('Неизвестный источник.');
//        }

        if (isset($this->requestData['m_operation_id'], $this->requestData['m_sign'])) {
            $arHash = [
                $this->requestData['m_operation_id'],
                $this->requestData['m_operation_ps'],
                $this->requestData['m_operation_date'],
                $this->requestData['m_operation_pay_date'],
                $this->requestData['m_shop'],
                $this->requestData['m_orderid'],
                $this->requestData['m_amount'],
                $this->requestData['m_curr'],
                $this->requestData['m_desc'],
                $this->requestData['m_status']
            ];

            if (isset($this->requestData['m_params'])) {
                $arHash[] = $this->requestData['m_params'];
            }

            $arHash[] = $this->secret;

            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

            if ($this->requestData['m_sign'] == $sign_hash) {
                return $this->requestData;
            }
        }

        throw new \Exception('Платеж не прошел проверку.');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getStatus(): string
    {
        return (string)$this->getRequestData('m_status');
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getOrderId(): int
    {
        return (int)$this->getRequestData('m_orderid');
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function getAmount(): float
    {
        return (float)$this->getRequestData('m_amount');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getCurrency(): string
    {
        return (string)$this->getRequestData('m_curr');
    }
}
