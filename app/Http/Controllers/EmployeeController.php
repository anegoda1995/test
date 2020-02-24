<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Employee;
use App\Position;
use App\Http\Resources\Employee\EmployeeTreeResource;
use App\Http\Resources\Employee\EmployeeCommonResource;
use App\Http\Resources\Employee\EmployeeSelectResource;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $query = Employee::query();

        if (!is_null($request->filter)) {
            $filter = $request->filter;
            // $columns = Schema::getColumnListing(with(new Employee)->getTable());
            $columns = with(new Employee)->fillable;
            foreach($columns as $column){
                $query->orWhere($column, 'LIKE', '%' . $filter . '%');
            }

            $query->orWhereHas('position', function ($query) use ($filter) {
                $query->where('title', $filter);
            });
        }

        if (!is_null($request->sort)) {
            [$field, $order] = explode('|', $request->sort);

            $query->orderBy($field, $order);
        }

        // todo: trouble with pagination on resource :(
        return $query->paginate(10);
    }

    public function view(Employee $employee)
    {
        return new EmployeeCommonResource($employee);
    }

    public function create(Request $request)
    {
        $employee = new Employee();
        $employee->fill($request->employee);
        $employee->save();

        return new EmployeeCommonResource($employee);
    }

    public function update(Employee $employee, Request $request)
    {
        $employee->fill($request->employee);
        $employee->save();
        return new EmployeeCommonResource($employee);
    }

    public function delete(Employee $employee)
    {
        // todo: change logic below... now we can delete only if we have another employee on same position
        $anotherEmployeeOnSamePosition = Employee::where('position_id', $employee->position_id)->where('id', '<>', $employee->id)->first();
        if (!empty($anotherEmployeeOnSamePosition)) {
            foreach ($employee->children()->get() as $child) {
                $child->prependToNode($anotherEmployeeOnSamePosition)->save();
            }
            $employee->delete();
        }
    }

    public function employeesTree($employeeId = null)
    {
        if (!is_null($employeeId)) {
            $employee = Employee::find($employeeId);
            if (!is_null($employee)) {
                // return $employee->children;
                return EmployeeTreeResource::collection($employee->children);
            }
        }
        
        $firstTwoLevels = Employee::where('position_id', Position::FOUNDER)->orWhere('position_id', Position::DIRECTOR)->get();
        if (!$firstTwoLevels->isEmpty()) {
            return EmployeeTreeResource::collection($firstTwoLevels->toTree());
        }
        
        return EmployeeTreeResource::collection(Employee::get()->toTree());
    }

    public function getPossibleParents(Employee $employee)
    {
        return EmployeeSelectResource::collection(Employee::where('parent_id', '<', (int) $employee->parent_id)->get());
    }
}
