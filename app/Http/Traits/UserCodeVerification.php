<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Cache;

trait UserCodeVerification
{
    /**
     * Сгенерировать код подтверждения и записать его в кэш
     *
     * @param string|null $actionName
     * @return int
     */
    public function generateVerificationCode(string $actionName = null): int
    {
        $verificationCode = rand(10000, 99999);

        Cache::put(
            $this->getVerificationCodeKey($actionName),
            $verificationCode,
            now()->addHours(2)
        );

        return $verificationCode;
    }

    /**
     * Полуить сществующий код подтверждения из кэша
     *
     * @param string|null $actionName
     * @return int|null
     */
    public function getVerificationCode(string $actionName = null): ?int
    {
        return Cache::get($this->getVerificationCodeKey($actionName), null);
    }

    /**
     * Стереть сществующий код подтверждения из кэша
     *
     * @param string|null $actionName
     * @return int|null
     */
    public function eraseVerificationCode(string $actionName = null): ?int
    {
        return Cache::forget($this->getVerificationCodeKey($actionName));
    }

    /**
     * Получить ключ для работы с кэшем
     *
     * @param string|null $actionName
     * @return string
     */
    private function getVerificationCodeKey(string $actionName = null): string
    {
        if ($actionName) {
            return "user:{$this->id}:verification_code:{$actionName}";
        } else {
            return "user:{$this->id}:verification_code";
        }
    }
}
