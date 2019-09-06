<div class="form-group row">
    {!! Form::label('employment_date', 'Employment Date *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::date('employment_date', $value = null, ['class' => 'form-control', 'placeholder' => 'Employment Date', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('branch_id', 'Branch *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('branch_id', App\HrmBranch::selectRaw("CONCAT (code, ' - ', name) as branch_name, id")->where('active', true)->orderBy('code')->pluck('branch_name', 'id'), $value = null, ['class' => 'form-control', 'placeholder' => '- Select Branch -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('grade_id', 'Grade *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('grade_id', App\HrmGrade::selectRaw("CONCAT (name, ' (', code, ')') as grade_name, id")->where('active', true)->orderBy('level')->pluck('grade_name', 'id'), $value = null, ['class' => 'form-control', 'placeholder' => '- Select Grade -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('department_id', 'Department *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('department_id', App\HrmDepartment::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control', 'placeholder' => '- Select Department -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('unit_id', 'Unit *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('unit_id', [], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Unit -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('job_function_id', 'Job Function *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('job_function_id', [], $value = null, ['class' => 'form-control', 'placeholder' => '- Select Job Function -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('supervisor', 'Supervisor *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('supervisor', App\HrmEmployee::selectRaw("CONCAT (surname, ', ', first_name) as full_name, id")->where('status', 'Active')->orderBy('full_name')->pluck('full_name', 'id'), $value = null, ['class' => 'form-control', 'placeholder' => '- Select Supervisor -', 'required' => true]) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script type="text/javascript"> 
    $(document).ready(function() {
        $("#department_id").change(function() {
            document.getElementById('unit_id').length = 1;
            var department_id = $("#department_id").val();
            var myString = "";
            
            var ajaxRequest = null;
            
            var browser = navigator.appName;
            if (browser == "Microsoft Internet Explorer") {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
                ajaxRequest = new XMLHttpRequest();
            }
            
            ajaxRequest.onreadystatechange = function() {
                if (ajaxRequest.readyState == 4) {
                    var json_object = JSON.parse(ajaxRequest.responseText);
                    for (var key in json_object) {
                        if (json_object.hasOwnProperty(key)) {
                            $("#unit_id").append("<option value="+json_object[key].id+">"+json_object[key].name+"</option>");
                        }
                    }
                }
            }
            
            ajaxRequest.open("GET", "../../departments/"+department_id+"/get_units", true);
            ajaxRequest.send(null);
        });
        
        $("#unit_id").change(function() {
            document.getElementById('job_function_id').length = 1;
            var unit_id = $("#unit_id").val();
            var myString = "";
            
            var ajaxRequest = null;
            
            var browser = navigator.appName;
            if (browser == "Microsoft Internet Explorer") {
                ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } else {
                ajaxRequest = new XMLHttpRequest();
            }
            
            ajaxRequest.onreadystatechange = function() {
                if (ajaxRequest.readyState == 4) {
                    var json_object = JSON.parse(ajaxRequest.responseText);
                    for (var key in json_object) {
                        if (json_object.hasOwnProperty(key)) {
                            $("#job_function_id").append("<option value="+json_object[key].id+">"+json_object[key].name+"</option>");
                        }
                    }
                }
            }
            
            ajaxRequest.open("GET", "../../units/"+unit_id+"/get_job_functions", true);
            ajaxRequest.send(null);
        });
    });
</script>