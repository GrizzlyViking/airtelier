<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Message
 * @package App\Models
 *
 * @property int $id
 * @property int $sender_id
 * @property int $recipient_id
 * @property string $subject
 * @property string $message
 * @property Carbon $sent
 */
class Message extends Model
{
    protected $dates = [
        'sent'
    ];

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'subject',
        'message',
        'sent',
    ];

    public function sender()
    {
        $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        $this->hasOne(User::class, 'recipient_id');
    }
}
