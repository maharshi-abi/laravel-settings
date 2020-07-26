<?php

namespace MAHARSHIABI\Settings\App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                $rules = [];
                break;
            case 'POST':
                $rules = [
                    'code' => 'required|max:255|unique:settings',
                    'label' => 'required|max:255',
                    'type' => 'required|max:255',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                $setting = $this->route('setting');
                $rules = [
                    'code' => 'required|max:255|unique:settings,code,' . $setting->id,
                    'label' => 'required|max:255',
                    'value' => 'required'
                ];
                if ($setting->type == 'FILE') {
                    $rules['value'] = 'required|mimes:' . config('settings.mimes');
                }
                break;
            default:
                $rules = [];
                break;
        }

        return $rules;
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        if ($this->isMethod('PUT')) {
            $setting = $this->route('setting');
            switch ($setting->type) {
                case 'BOOLEAN':
                    $data['value'] = isset($data['value']) ? 'true' : 'false';
                    break;
                case 'SELECT':
                    $value = [];

                    $items = $this->{$setting->code};

                    if (!empty($items) && is_array($items)) {
                        foreach ($items as $item) {
                            if (empty($item['key']) || empty($item['value'])) {
                                continue;
                            }
                            $value[$item['key']] = $item['value'];
                        }
                    }
                    if (empty($value)) {
                        $data['value'] = '';
                    } else {
                        $data['value'] = json_encode($value);
                    }
                    break;
            }
        }
        if ($this->isMethod('PUT') || $this->isMethod('POST')) {
            $data['hidden'] = isset($data['hidden']) ? 1 : 0;
        }

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}