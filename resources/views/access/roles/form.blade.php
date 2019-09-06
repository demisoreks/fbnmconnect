<div class="form-group row">
    {!! Form::label('title', 'Title *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::text('title', $value = null, ['class' => 'form-control', 'placeholder' => 'Title', 'required' => true, 'maxlength' => 100]) !!}
    </div>
</div>
<div class="form-group row">
    {!! Form::label('all', 'All Employees *', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-4">
        {!! Form::select('all', [0 => 'No', 1 => 'Yes'], $value = null, ['class' => 'form-control', 'placeholder' => ' - Select Option -', 'required' => true]) !!}
    </div>
</div>
<div id="more" @if (isset($role) && $role->all) style="display: none;" @endif>
<div class="form-group row">
    {!! Form::label('', '', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-10 text-info">
        Hold "Ctrl" to select multiple options or deselect an option
    </div>
</div>
<div class="form-group row">
    {!! Form::label('departments', 'Departments', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-8">
        @if (isset($role))
        {!! Form::select('departments[]', App\HrmDepartment::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = explode(',', $role->departments), ['class' => 'form-control', 'multiple' => 'true']) !!}
        @else
        {!! Form::select('departments[]', App\HrmDepartment::where('active', true)->orderBy('name')->pluck('name', 'id'), $value = null, ['class' => 'form-control', 'multiple' => 'true']) !!}
        @endif
    </div>
</div>
<div class="form-group row">
    {!! Form::label('units', 'Units', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-8">
        <select name="units[]" id="units" class="form-control" multiple="true">
            @foreach (App\HrmDepartment::where('active', true)->orderBy('name')->get() as $department)
                @foreach(App\HrmUnit::where('department_id', $department->id)->where('active', true)->orderBy('name')->get() as $unit)
                    <option value="{{ $unit->id }}" @if (isset($role) && in_array($unit->id, explode(',', $role->units))) selected @endif>{{ $department->name.' | '.$unit->name }}</option>
                @endforeach
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    {!! Form::label('job_functions', 'Job Functions', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-8">
        <select name="job_functions[]" id="job_functions" class="form-control" multiple="true">
            @foreach (App\HrmDepartment::where('active', true)->orderBy('name')->get() as $department)
                @foreach(App\HrmUnit::where('department_id', $department->id)->where('active', true)->orderBy('name')->get() as $unit)
                    @foreach(App\HrmJobFunction::where('unit_id', $unit->id)->where('active', true)->orderBy('name')->get() as $job_function)
                        <option value="{{ $job_function->id }}" @if (isset($role) && in_array($job_function->id, explode(',', $role->job_functions))) selected @endif>{{ $department->name.' | '.$unit->name.' | '.$job_function->name }}</option>
                    @endforeach
                @endforeach
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    {!! Form::label('employees', 'Employees', ['class' => 'col-md-2 col-form-label']) !!}
    <div class="col-md-8">
        @if (isset($role))
        {!! Form::select('employees[]', App\HrmEmployee::selectRaw("CONCAT (surname, ', ', first_name) as full_name, id")->where('status', 'Active')->orderBy('surname')->pluck('full_name', 'id'), $value = explode(',', $role->employees), ['class' => 'form-control', 'multiple' => true]) !!}
        @else
        {!! Form::select('employees[]', App\HrmEmployee::selectRaw("CONCAT (surname, ', ', first_name) as full_name, id")->where('status', 'Active')->orderBy('surname')->pluck('full_name', 'id'), $value = null, ['class' => 'form-control', 'multiple' => true]) !!}
        @endif
    </div>
</div>
</div>
<div class="form-group row">
    <div class="col-md-10 offset-md-2">
        {!! Form::submit($submit_text, ['class' => 'btn btn-primary']) !!}
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#all").change(function() {
            if ($(this).val() === '0') {
                $("#more").slideDown(1000);
            } else {
                $("#more").slideUp(1000);
            }
        });
    });
</script>