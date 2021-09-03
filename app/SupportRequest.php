<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

/**
 * App\SupportRequest
 *
 * @property int $id
 * @property string|null $name Имя автора обращения
 * @property string $email Почта автора обращения
 * @property string $message Сообщение автора обращения
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SupportRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SupportRequest extends Model
{
    use CrudTrait;

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
