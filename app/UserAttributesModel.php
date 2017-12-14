<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAttributesModel extends Model
{
    /**
     * Array contendo as colunas guarded
     *
     * @var array
     */
    protected $guarded = [
        'id',
        'attribute',
        'label'
    ];
}
