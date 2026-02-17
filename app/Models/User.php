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
    'date_of_birth',
    'national_id',
    'id_image',
    'gender',
    'nationality',
    'government_id_type',
    'government_id_number',
    'address',
    'password',
    'institution_name',
    'institution_type',
    'course_name',
    'level',
    'student_document',
    'student_registration_number',
    
    
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
    public function isEligibleForLoan(): bool
{
    return $this->approvedGuarantors()->count() >= 2
        && $this->profile_status === 'approved'
        && $this->academic_status === 'approved';
}

}
