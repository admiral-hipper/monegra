<?php

namespace App\Http\Controllers\Cabinet;

use App\{Wallet, WalletType};
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\{Request, JsonResponse, Response};

class WalletController extends Controller
{
    /**
     * Открыть страницу
     *
     * @return View
     */
    public function index(): View
    {
        return view('cabinet.wallet');
    }

    /**
     * Получить кошельки для таблицы
     *
     * @return JsonResponse
     */
    public function getWallets(): JsonResponse
    {
        $userWallets = \Auth::user()
            ->wallets()
            ->with('type')
            ->get();

        $responseData = [
            'rows' => [],
            'types_for_wallet_adding' => [],
            'columns' => [
                __('Type'),
                __('Number'),
                __('Actions'),
            ],
        ];

        foreach ($userWallets as &$wallet) {
            $responseData['rows'][] = [
                ['value' => $wallet->id, 'hidden' => true, 'type_id' => $wallet->type->id],
                ['value' => $wallet->type->name],
                ['value' => $wallet->number],
            ];

            unset($wallet);
        }

        $typesForWalletAdding = WalletType::query()
            ->whereNotIn('id', $userWallets->pluck('type_id')->toArray())
            ->get();

        foreach ($typesForWalletAdding as &$type) {
            $responseData['types_for_wallet_adding'][] = [
                'id' => $type->id,
                'name' => $type->name,
            ];

            unset($type);
        }

        return response()->json($responseData);
    }

    /**
     * Создать кошелек
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function storeWallet(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'type_id' => 'bail|required|integer|exists:wallet_types,id',
            'number' => 'required|string|min:2|max:128',
        ]);

        $userWallets = \Auth::user()
            ->wallets()
            ->withTrashed()
            ->get();

        $existingWalletWithSpecifiedType = $userWallets
            ->where('type_id', $requestData['type_id'])
            ->first();

        if ($existingWalletWithSpecifiedType) {
            if ($existingWalletWithSpecifiedType->deleted_at) {
                $existingWalletWithSpecifiedType->restore();

                if ($existingWalletWithSpecifiedType->number !== $requestData['number']) {
                    $existingWalletWithSpecifiedType->update([
                        'number' => $requestData['number'],
                    ]);
                }
            } else {
                return response()->json('Вы не можете создать этот кошелек', Response::HTTP_FORBIDDEN);
            }
        } else {
            \Auth::user()
                ->wallets()
                ->create([
                    'type_id' => $requestData['type_id'],
                    'number' => $requestData['number'],
                ]);
        }

        return response()->json($this->getWallets()->getData(true));
    }

    /**
     * Изменить кошелек
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateWallet(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'id' => 'bail|required|integer|exists:wallets',
            'type_id' => 'bail|required|integer|exists:wallet_types,id',
            'number' => 'required|string|min:2|max:128',
        ]);

        \Auth::user()
            ->wallets()
            ->findOrFail($requestData['id'])
            ->update([
                'type_id' => $requestData['type_id'],
                'number' => $requestData['number'],
            ]);

        return response()->json($this->getWallets()->getData(true));
    }

    /**
     * Удалить кошелек (будет установлен deleted_at)
     *
     * @param Wallet $wallet
     * @return JsonResponse
     * @throws \Exception
     */
    public function deleteWallet(Wallet $wallet): JsonResponse
    {
        $wallet->delete();

        return response()->json($this->getWallets()->getData(true));
    }
}
