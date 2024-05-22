<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_information', 'address', 'ic_no'];

    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}
