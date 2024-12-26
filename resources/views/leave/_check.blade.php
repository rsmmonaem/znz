 <form>
     <div class="form-group row">
         <label class="col-sm-2 control-label" for="group">Group</label>
         <div class="col-sm-4">
             @php $group = DB::table('com_group')->get();  @endphp
            <select class="form-control" id="group">
                <option value="">Select Group</option>
                @foreach ($group as $g)
                    <option value="{{ $g->id }}" selected>{{ $g->name }}</option>
                @endforeach
            </select>
         </div>
     </div>

     <div class="form-group row">
         <label class="col-sm-2 control-label" for="branch">Branch</label>
         <div class="col-sm-4">
             <select class="form-control" id="branch">
                 <option value="">Select Branch</option>
                 @foreach ($branch as $b)
                     <option value="{{ $b->id }}">{{ $b->name }}</option>
                 @endforeach
             </select>
         </div>
     </div>

     <div class="form-group row">
         <label class="col-sm-2 control-label" for="financialYear">Financial Year</label>
         <div class="col-sm-4">
             <select class="form-control" id="financialYear">
                 <option value="">Select Year</option>
                 @for($i = 2030; $i >= date('Y')-10; $i--)
                     <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                 @endfor
             </select>
         </div>
     </div>

     <div class="form-group row">
         <label class="col-sm-2 control-label" for="employeeID">Employee ID</label>
         <div class="col-sm-4">
             <select class="form-control select2me select2-offscreen" id="employeeID">
                 <option value="">Select Employee ID</option>
                 @foreach ($employee as $e)
                     <option value="{{ $e->id }}">{{ $e->employee_id }}</option>
                 @endforeach
             </select>
         </div>
     </div>

     <div class="form-group row">
         <label class="col-sm-2 control-label" for="employeeName">Employee Name</label>
         <div class="col-sm-4"> 
             <input type="text" class="form-control" id="employeeName" placeholder="Employee Name" value="" readonly>
         </div>
     </div>

     <div class="form-group row">
         <label class="col-sm-2 control-label" for="employeeDesignation">Employee Designation</label>
         <div class="col-sm-4">
             <input type="text" class="form-control" id="employeeDesignation" placeholder="Employee Designation"
                 readonly value="">
         </div>
     </div>
 </form>
