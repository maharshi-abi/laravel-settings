<?php

namespace Defaultlaravelsettings\Settings\App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public function __construct(array $attributes = [])
    {
        $this->table = config('settings.table', 'settings');
        parent::__construct($attributes);
    }

    protected $guarded = ['id'];

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = str_slug($value, '_');
    }

    public function getTypeAttribute()
    {
        return $this->attributes['type'] = strtoupper($this->attributes['type']);
    }

    public function getValueAttribute()
    {
        $value = $this->attributes['value'];

        switch ($this->attributes['type']) {
            case 'FILE':
                if (!empty($value)) {
                    return config('settings.upload_path') . '/' . $value;
                }
                break;
            case 'SELECT':
                $values = json_decode($value, true);
                if ($values) {
                    return $values;
                } else {
                    return [];
                }
                break;
            case 'BOOLEAN':
                if ($value == 'true') {
                    return true;
                } else {
                    return false;
                }
                break;
            case 'NUMBER':
                return floatval($value);
                break;
        }

        return $value;
    }
}
