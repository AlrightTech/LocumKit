<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Models\LocumlogbookFollowupProcedure;
use App\Models\LocumlogbookPracticeInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocumlogbookPracticeInfoController extends Controller
{
    private array $fields;
    private $model;
    private string $route;
    private string $page_title = 'PRACTICE INFORMATION';
    private string $heading = '';
    private string $add_heading = 'PRACTICE CHECKLIST';


    public function __construct()
    {
        $this->fields = [
            ["title" => "Practice Name", "placeholder" => "Enter name of the practice", "name" => "practice_name", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Parking", "placeholder" => "Describe where you parked you car", "name" => "appointment_time_slots", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Train", "placeholder" => "Describe walk from train station", "name" => "record_keeping", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Location", "name" => "trial_set", "placeholder" => "Where is the store located in town", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Pre-Screening", "name" => "phoropter", "placeholder" => "Describe pre-screening process", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "OCT", "placeholder" => "Yes or No", "name" => "test_chat_type", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Visual Field", "placeholder" => "Type of visual field used machine", "name" => "visualfield_machinetype", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Fundus Camera", "placeholder" => "Yes or No", "name" => "funds_camera", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "No. of Clinics", "name" => "oct", "type" => "text", "placeholder" => "No. of clinics running", "validation_rules" => "required|string|max:255"],
            ["title" => "Testing Time", "placeholder" => "Please enter allocated time for appts", "name" => "slit_lamp_type", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Record Keeping", "name" => "reading_chart", "placeholder" => "What record keeping process is in place", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Stereopsis", "placeholder" => "What type of stereopsis test is used", "name" => "stereo_test_type", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Colour Vision",  "placeholder" => "What type of colour vision test is used", "name" => "colour_vision_type", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Handover", "placeholder" => "Describe handover procedure", "name" => "pre_screening_procdure", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Children's Glasses", "placeholder" => "DO in place or is Optom responsible", "name" => "is_there_do", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Trial Frame", "placeholder" => "Yes or No", "name" => "contact_lenses", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Opthal / Ret", "placeholder" => "Yes or No", "name" => "handover_procdure", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Any Patient Leaflets", "placeholder" => "Describe which leaflets are in place", "name" => "any_patient_leaflets", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Referral Procedure", "placeholder" => "Describe referral procedure", "name" => "primary_care_services", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Staff Info", "placeholder" => "Please enter details/no. of shop floor staff", "name" => "shop_floor_staff_members", "type" => "text", "validation_rules" => "required|string|max:255"],
            ["title" => "Monitoring Sales / CER", "placeholder" => "Describe how this can be checked", "name" => "no_of_clinics_running", "type" => "text", "validation_rules" => "required|string|max:255"],
        ];
        $this->model = LocumlogbookPracticeInfo::class;

        $this->route = "freelancer.locumlogbook.practice-info";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->model::where("user_id", Auth::user()->id)->latest()->paginate(8);
        return view('freelancer.questionnaire_crud.practice_info', ["fields" => $this->fields, 'records' => $records, 'route' => $this->route, 'page_title' => $this->page_title, 'heading' => $this->heading]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('freelancer.questionnaire_crud.create', ["fields" => $this->fields, 'route' => $this->route, 'add_heading' => $this->add_heading]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Build validation rules and custom messages
        $rules = [];
        $messages = [];
        
        foreach ($this->fields as $field) {
            if (isset($field['validation_rules'])) {
                $fieldName = $field['name'];
                $fieldTitle = $field['title'];
                
                // Parse validation rules
                $ruleString = $field['validation_rules'];
                // Remove regex validation to allow more flexible input
                $ruleString = preg_replace('/\|?regex:[^|]+/', '', $ruleString);
                $ruleString = trim($ruleString, '|');
                
                $rules[$fieldName] = explode('|', $ruleString);
                
                // Add custom error messages
                if (str_contains($field['validation_rules'], 'required')) {
                    $messages[$fieldName . '.required'] = "Please enter {$fieldTitle}";
                }
                if (str_contains($field['validation_rules'], 'max:')) {
                    preg_match('/max:(\d+)/', $field['validation_rules'], $matches);
                    $maxLength = $matches[1] ?? 255;
                    $messages[$fieldName . '.max'] = "{$fieldTitle} cannot exceed {$maxLength} characters";
                }
                if (str_contains($field['validation_rules'], 'string')) {
                    $messages[$fieldName . '.string'] = "{$fieldTitle} must be a valid text";
                }
            }
        }

        $request->validate($rules, $messages);

        $record = new $this->model;
        $record->user_id = $request->user()->id;

        $this->save_record($request, $record);

        return redirect(route("{$this->route}.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect(route($this->route . '.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = $this->model::where("user_id", Auth::user()->id)->where("id", $id)->first();
        if (!$record) {
            return abort(404);
        }

        return view('freelancer.questionnaire_crud.edit', ["fields" => $this->fields, 'record' => $record, 'route' => $this->route, 'add_heading' => $this->add_heading]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Build validation rules and custom messages
        $rules = [];
        $messages = [];
        
        foreach ($this->fields as $field) {
            if (isset($field['validation_rules'])) {
                $fieldName = $field['name'];
                $fieldTitle = $field['title'];
                
                // Parse validation rules
                $ruleString = $field['validation_rules'];
                // Remove regex validation to allow more flexible input
                $ruleString = preg_replace('/\|?regex:[^|]+/', '', $ruleString);
                $ruleString = trim($ruleString, '|');
                
                $rules[$fieldName] = explode('|', $ruleString);
                
                // Add custom error messages
                if (str_contains($field['validation_rules'], 'required')) {
                    $messages[$fieldName . '.required'] = "Please enter {$fieldTitle}";
                }
                if (str_contains($field['validation_rules'], 'max:')) {
                    preg_match('/max:(\d+)/', $field['validation_rules'], $matches);
                    $maxLength = $matches[1] ?? 255;
                    $messages[$fieldName . '.max'] = "{$fieldTitle} cannot exceed {$maxLength} characters";
                }
                if (str_contains($field['validation_rules'], 'string')) {
                    $messages[$fieldName . '.string'] = "{$fieldTitle} must be a valid text";
                }
            }
        }

        $request->validate($rules, $messages);

        $record = $this->model::where("user_id", Auth::user()->id)->where("id", $id)->first();
        if (!$record) {
            return abort(404);
        }

        $this->save_record($request, $record);

        return redirect(route("{$this->route}.index"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = $this->model::where("user_id", Auth::user()->id)->where("id", $id)->first();
        if (!$record) {
            // Record already deleted or doesn't exist - return success to prevent 404 errors
            return redirect(route("{$this->route}.index"))->with("success", "Practice deleted successfully.");
        }
        $record->delete();

        return redirect(route("{$this->route}.index"))->with("success", "Practice deleted successfully.");
    }

    private function save_record(Request $request, Model &$record)
    {
        foreach ($this->fields as $field) {
            if (isset($field['type']) && $field['type'] == 'checkbox') {
                $record->{$field['name']} = $request->input($field['name']) == 'on' ? true : false;
            } else {
                $record->{$field['name']} = $request->input($field['name']);
            }
        }
        $record->save();
    }
}