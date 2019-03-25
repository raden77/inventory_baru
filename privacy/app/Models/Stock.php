<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Yajra\Auditable\AuditableTrait;

class Stock extends Model
{
    //
    use AuditableTrait;

    protected $table = 'stock';

	protected $primaryKey = 'id';

    public $incrementing = true;
    
    protected $fillable = ['stockName', 'stockPrice', 'stockYear'];
}
