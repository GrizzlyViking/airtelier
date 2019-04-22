<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 * @package App\Models
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $description
 * @property Carbon $birthday
 */
class Client extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'description',
        'age_group',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
