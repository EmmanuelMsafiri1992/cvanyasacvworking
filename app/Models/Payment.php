<?php

namespace App\Models;

use App\Notifications\SubscriptionPaid;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        'package_id',
        'reference',
        'gateway',
        'total',
        'is_paid',
        'currency',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package')->withDefault();
    }

    public function applyPayment()
    {
        $now = now();

        // Extend only if user is on the same package and subscribed
        if ($this->user->subscribed() && $this->user->package_id == $this->package_id) {
            $now = $this->user->package_ends_at;
        }

        switch ($this->package->interval) {
            case 'day':
                $package_ends_at = $now->addDay($this->package->interval_number);
                break;
            case 'week':
                $package_ends_at = $now->addWeek($this->package->interval_number);
                break;
            case 'month':
                $package_ends_at = $now->addMonth($this->package->interval_number);
                break;
            case 'year':
                $package_ends_at = $now->addYear($this->package->interval_number);
                break;
            default:
                break;
        }

        $this->user->update([
            'package_id'      => $this->package_id,
            'package_ends_at' => $package_ends_at
        ]);

        $this->user->notify((new SubscriptionPaid($this))->onQueue('mail'));
    }

}
