<?php

namespace App\Services\Payments;

interface PaymentInterface
{
    /**
     * @return array
     */
    public function processRequest(): array;

    /**
     * @return int
     */
    public function getOrderId(): int;

    /**
     * @return float
     */
    public function getAmount(): float;

    /**
     * @return string
     */
    public function getCurrency(): string;
}
