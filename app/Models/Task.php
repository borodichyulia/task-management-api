<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'status' => StatusEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getStatuses(): array
    {
        return array_column(StatusEnum::cases(), 'value');
    }
}
