<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Throwable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUsers()
    {
        return $this->select('id', 'name', 'email')
        ->orderBy('id', 'asc')
        ->paginate(25);
    }

    //ユーザー新規登録
    public function storeUser($request)
    {
        try{
            DB::transaction(function () use($request) {
                return $this->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password)
                ]);
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }

    //ユーザー情報更新
    public function updateUser($request, $id)
    {
        try{
            DB::transaction(function () use($request, $id) {
                $user = $this->findOrFail($id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();        
            }, 2);
        }catch(Throwable $e){
            Log::error($e);
            throw $e;
        }
    }
}
