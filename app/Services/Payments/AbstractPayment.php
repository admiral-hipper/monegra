<?php

namespace App\Services\Payments;

/**
 * Class AbstractPayment
 *
 * @package App\Services\Payments
 */
abstract class AbstractPayment implements PaymentInterface
{
    /** @var string */
    protected $merchantId;

    /** @var string */
    protected $secret;

    /** @var array */
    protected $requestData = [];

    /**
     * Payeer constructor.
     *
     * @param string|null $merchantId
     * @param string|null $secret
     */
    public function __construct(string $merchantId = null, string $secret = null)
    {
        $this->merchantId = $merchantId;
        $this->secret = $secret;
        $this->setRequestData($_REQUEST);
    }

    /**
     * @param array $data
     */
    public function setRequestData(array $data): void
    {
        $this->requestData = $data;
    }

    /**
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function getRequestData(?string $name = null)
    {
        if ($name === null) {
            return $this->requestData;
        } else if (isset($this->requestData[$name])) {
            return $this->requestData[$name];
        }

        throw new \Exception('Invalid request param name.');
    }
}
