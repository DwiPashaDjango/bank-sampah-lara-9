<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class BalanceWithdrawal extends Model
{
    use HasFactory, AutoNumberTrait;
    protected $table = 'balance_withdrawals';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function saldo()
    {
        return $this->belongsTo(SaldoNasabah::class, 'saldo_id', 'id');
    }

    /**
     * Return the autonumber configuration array for this model.
     *
     * @return array
     */
    public function getAutoNumberOptions()
    {
        return [
            'kode_withdrawn' => [
                'format' => function () {
                    return 'WD.' .  date('Y.m.d');
                },
                'length' => 5
            ]
        ];
    }
}
