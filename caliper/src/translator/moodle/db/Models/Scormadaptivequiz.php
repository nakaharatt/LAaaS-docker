<?php

namespace udzuki\translator\moodle\db\Models;

use Illuminate\Database\Eloquent\Model;

class Scormadaptivequiz extends Model
{
    protected $table = 'scormadaptivequiz';

    public function getIdAttribute($value): string
    {
        return "{$this->getConnection()->getConfig('app_url')}/mod/scormadaptivequiz/{$value}";
    }

    public function getCourseAttribute($value): int
    {
        return $value;
    }

    public function getNameAttribute($value): string
    {
        return $value;
    }
}