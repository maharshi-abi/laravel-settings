<?php

namespace Defaultlaravelsettings\Settings\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Defaultlaravelsettings\Settings\App\Http\Requests\SettingRequest;
use Defaultlaravelsettings\Settings\App\Setting;

class SettingsController extends Controller
{
    /**
     * @var array
     * available setting types
     */
    private $types = ['TEXT' => 'Text', 'TEXTAREA' => 'Text Area',
        'BOOLEAN' => 'Boolean', 'NUMBER' => 'Number',
        'DATE' => 'Date', 'SELECT' => 'Select Options', 'FILE' => 'File'];

    /**
     * SettingsController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $hidden = [0];

        if (config('settings.show_hidden_records')) {
            $hidden[] = 1;
        }

        $settings = Setting::whereIn('hidden', $hidden);

        $search_query = $request->search;

        $search = [
            'code' => '',
            'type' => '',
            'label' => '',
            'value' => '',
        ];

        if (!empty($search_query)) {
            foreach ($search_query as $key => $value) {
                if (!empty($value)) {
                    $search[$key] = $value;
                    $settings->where($key, 'like', '%' . strip_tags(trim($value)) . '%');
                }
            }
        }

        $types = $this->types;

        $settings = $settings->paginate(config('settings.per_page', 10));

        return view('settings::index')->with(compact('settings', 'search', 'types'));
    }

    /**
     * @param $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $type = $request->type;

        if (!array_key_exists($type, $this->types)) {
            return back()->with('error', 'Invalid type provided');
        }

        return view('settings::create')->with(compact('type'));
    }

    public function store(SettingRequest $request)
    {
        $data = $request->all();

        $setting = Setting::create($data);

        return redirect(url(config('settings.route') . '/' . $setting->id . '/edit'))->with('success', 'Record has been created successfully.')
            ->with('new', true);
    }

    public function edit(SettingRequest $request, Setting $setting)
    {
        if (session('new')) {
            $new = true;
        } else {
            $new = false;
        }

        if (!$new && $setting->hidden && !config('settings.show_hidden_records')) {
            return redirect(url(config('settings.route')))->with('error', 'Permission denied!');
        }

        return view('settings::edit')->with(compact('setting'));
    }

    public function update(SettingRequest $request, Setting $setting)
    {
        $setting->code = $request->code;
        $setting->label = $request->label;
        $setting->hidden = $request->hidden;

        switch ($setting->type) {
            case 'TEXT':
            case 'TEXTAREA':
            case 'DATE':
            case 'BOOLEAN':
            case 'NUMBER':
            case 'SELECT':
                $setting->value = trim($request->value);
                break;
            case 'FILE':
                if ($request->hasFile('value')) {
                    @unlink($setting->value);

                    $destinationPath = public_path() . '/' . config('settings.upload_path');

                    if (!File::exists($destinationPath)) File::makeDirectory($destinationPath, 0775, true);

                    $value = $setting->code . '.' . $request->file('value')->getClientOriginalExtension();

                    $request->file('value')->move($destinationPath, $value);

                    $setting->value = $value;
                }
                break;
            default:
        }

        $setting->save();

        return redirect(url(config('settings.route')))->with('success', 'Record has been saved successfully.');
    }

    public function destroy(Request $request, Setting $setting)
    {
        if ($request->ajax()) {
            $tr = 'tr_' . $setting->id;
            if ($setting->type == 'FILE') {
                @unlink($setting->value);
            }
            $setting->delete();
            return response()->json(['success' => 'Record has been deleted successfully', 'tr' => $tr]);
        } else {
            return 'You can\'t proceed in delete operation';
        }
    }

    public function fileDownload(Setting $setting)
    {
        if (empty($setting->value)) {
            abort(404);
        }
        return response()->download($setting->value);
    }
}