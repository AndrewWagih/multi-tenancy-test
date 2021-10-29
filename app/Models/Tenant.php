<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Tenant extends Model
{
    use HasFactory;
    protected $connection = 'landlord';
    protected $guarded  = [];

    public function configure(){
        config([
            'database.connections.tenant.database' => $this->database,
            'cache.prefix' => $this->id
        ]);

        DB::purge('tenant');
        // app('cashe')->purge(
        //     config('cache.defualt')
        // );
        DB::reconnect('tenant');
        Schema::connection('tenant')->getConnection()->reconnect();
        return $this;
    }

    public function use(){
        app()->forgetInstance('tenant');
        app()->instance('tenant',$this);
        return $this;
    }
}
