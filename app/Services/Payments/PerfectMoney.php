<?php

namespace App\Services\Payments;

class PerfectMoney extends AbstractPayment
{
    /**
     * PerfectMoney constructor.
     *
     * @param string|null $merchantId
     * @param string|null $secret
     */
    public function __construct(string $merchantId = null, string $secret = null)
    {
        if ($merchantId === null) {
            $merchantId = config('transaction.perfect_money.PAYEE_ACCOUNT');
        }

        if ($secret === null) {
            $secret = config('transaction.perfect_money.ALTERNATE_PHRASE_HASH');
        }

        parent::__construct($merchantId, $secret);
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function processRequest(): array
    {
        $string =
            $this->requestData['PAYMENT_ID'] . ':' . $this->requestData['PAYEE_ACCOUNT'] . ':' .
            $this->requestData['PAYMENT_AMOUNT'] . ':' . $this->requestData['PAYMENT_UNITS'] . ':' .
            $this->requestData['PAYMENT_BATCH_NUM'] . ':' .
            $this->requestData['PAYER_ACCOUNT'] . ':' . strtoupper(md5($this->secret)) . ':' .
            $this->requestData['TIMESTAMPGMT'];

        $hash = strtoupper(md5($string));

        if ($hash == $this->requestData['V2_HASH']) {
            return $this->requestData;
        }

        throw new \Exception('Платеж не прошел проверку.');
    }

    /**
     * @return int
     * @throws \Exception
     */
    public function getOrderId(): int
    {
        return (int)$this->getRequestData('PAYMENT_ID');
    }

    /**
     * @return float
     * @throws \Exception
     */
    public function getAmount(): float
    {
        return (float)$this->getRequestData('PAYMENT_AMOUNT');
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getCurrency(): string
    {
        return (string)$this->getRequestData('PAYMENT_UNITS');
    }

    /**
     * @param string $submitLabel Название кнопки для оплаты
     * @param string $orderId ID транзакции
     * @param float $amount Сумма
     * @param string $currency Валюта
     * @return string
     */
    public function htmlForPay(string $submitLabel, string $orderId, float $amount, string $currency = 'USD')
    {
        $pmName = config('transaction.perfect_money.PAYEE_NAME');

        $pmSuccessUrl = route('pm.success');
        $pmFailUrl = route('pm.fail');
        $pmStatusUrl = route('pm.status');

        $html = <<<HTML
<form action="https://perfectmoney.is/api/step1.asp" method="POST" target='_blank' style="margin-top: 10px;">
    <input type="hidden" name="PAYEE_ACCOUNT" value="{$this->merchantId}">
    <input type="hidden" name="PAYEE_NAME" value="{$pmName}">
    <input type="hidden" name="PAYMENT_AMOUNT" value="{$amount}">
    <input type="hidden" name="PAYMENT_UNITS" value="{$currency}">
    <input type="hidden" name="STATUS_URL" value="{$pmStatusUrl}">
    <input type="hidden" name="PAYMENT_URL" value="{$pmSuccessUrl}">
    <input type="hidden" name="NOPAYMENT_URL" value="{$pmFailUrl}">
    <input type="hidden" name="PAYMENT_ID" value="{$orderId}">
    <button type="submit" class="swal2-confirm swal2-styled" style="display: inline-block; background-color: rgb(44, 206, 109); border-left-color: rgb(44, 206, 109); border-right-color: rgb(44, 206, 109);" name="PAYMENT_METHOD">{$submitLabel}</button>
</form>
HTML;

        return $html;
    }
}
