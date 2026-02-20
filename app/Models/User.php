<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'email',
    'phone',
    
    // 'national_id',
    // 'id_image',
    // 'gender',
    // 'nationality',
    // 'government_id_type',
    // 'government_id_number',
    // 'address',
    'password',
   
    
    
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     
    
    public function loanApplications()
    {
        return $this->hasMany(LoanApplication::class);
    }
    public function loanDisbursements()
    {
        return $this->hasMany(LoanDisbursement::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function guarantors()
    {
        return $this->hasMany(Guarantor::class);
    }

  

    public function activeGuarantors()
    {
    return $this->hasMany(Guarantor::class)
         ->whereNull('deleted_at')
        ->whereIn('status', ['pending', 'approved']);
     }

     public function personalProfile()
    {
    return $this->hasOne(PersonalProfile::class);
    }

    public function academicProfile()
    {
    return $this->hasOne(AcademicProfile::class);
    }

    

    public function isFullyApproved(): bool
   {
    return optional($this->personalProfile)->status === 'approved'
        && optional($this->academicProfile)->status === 'approved';
     }



public function isEligibleForLoan(): bool
{
    return
        $this->personalProfile?->status === 'approved' &&
        $this->academicProfile?->status === 'approved' &&
        $this->guarantors()
            ->where('status', 'approved')
            ->count() >= 2;
}


}
