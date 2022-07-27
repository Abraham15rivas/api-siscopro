<?php

namespace App\Http\Controllers\Decisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponser;
use App\Models\{
    Project
};
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    use ApiResponser;

    public function index() {
        try {
            $projects = Project::select(
                'id',
                'title',
                'general_objective',
                'scope',
                'justification',
                'observations',
                'requested_amount',
                'execution_time',
                'actors',
                'productive_engine',
                'product_project',
                'project_taxes',
                'direct_benefits',
                'investment_line'
            )
            ->get();
        } catch (\Exception $e) {
            $this->reportError($e);
            return $this->error("Ha ocurrido un error en el servidor", 500, $e);
        }

        return $this->success($projects, 'List projects', 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title'             => 'required|string',
            'general_objective' => 'required|string',
            'scope'             => 'required|string',
            'justification'     => 'required|string',
            'observations'      => 'nullable|string',
            'requested_amount'  => 'nullable',
            'execution_time'    => 'required|string',
            'actors'            => 'required|array',
            'productive_engine' => 'required|string',
            'product_project'   => 'required|string',
            'project_taxes'     => 'required|string',
            'direct_benefits'   => 'required|string',
            'investment_line'   => 'nullable|string',
            'project_type_id'   => 'required|integer',
            'project_status_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        DB::beginTransaction();

        try {
            $project = new Project();
            $project->title             = $request->title;
            $project->general_objective = $request->general_objective;
            $project->scope             = $request->scope;
            $project->justification     = $request->justification;
            $project->observations      = $request->observations;
            $project->requested_amount  = $request->requested_amount;
            $project->execution_time    = $request->execution_time;
            $project->actors            = json_encode($request->actors);
            $project->productive_engine = $request->productive_engine;
            $project->product_project   = $request->product_project;
            $project->project_taxes     = $request->project_taxes;
            $project->direct_benefits   = $request->direct_benefits;
            $project->investment_line   = $request->investment_line;
            $project->user_id           = $request->user()->id;
            $project->institution_id    = $request->user()->institution_id;
            $project->project_type_id   = $request->project_type_id;
            $project->project_status_id = $request->project_status_id;
            $project->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->reportError($e);
            return $this->error("Ha ocurrido un error en el servidor", 500, $e);
        }

        return response()->json('done');
    }

    public function show($id) {
        try {
            $project = Project::select(
                'id',
                'title',
                'general_objective',
                'scope',
                'justification',
                'observations',
                'requested_amount',
                'execution_time',
                'actors',
                'productive_engine',
                'product_project',
                'project_taxes',
                'direct_benefits',
                'investment_line'
            )
            ->find($id);
        } catch (\Exception $e) {
            $this->reportError($e);
            return $this->error("Ha ocurrido un error en el servidor", 500, $e);
        }

        return $this->success($project, 'Project', 200);
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'id'                => 'required|integer',
            'title'             => 'required|string',
            'general_objective' => 'required|string',
            'scope'             => 'required|string',
            'justification'     => 'required|string',
            'observations'      => 'nullable|string',
            'requested_amount'  => 'required|decimal',
            'execution_time'    => 'required|string',
            'actors'            => 'required|array',
            'productive_engine' => 'required|string',
            'product_project'   => 'required|string',
            'project_taxes'     => 'required|string',
            'direct_benefits'   => 'required|string',
            'investment_line'   => 'nullable|string',
            'project_type_id'   => 'required|integer',
            'project_status_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->json($validator->errors());
        }

        DB::beginTransaction();

        try {
            $project = Project::findOrFail($id);
            $project->title             = $request->title;
            $project->general_objective = $request->general_objective;
            $project->scope             = $request->scope;
            $project->justification     = $request->justification;
            $project->observations      = $request->observations;
            $project->requested_amount  = $request->requested_amount;
            $project->execution_time    = $request->execution_time;
            $project->actors            = $request->actors;
            $project->productive_engine = $request->productive_engine;
            $project->product_project   = $request->product_project;
            $project->project_taxes     = $request->project_taxes;
            $project->direct_benefits   = $request->direct_benefits;
            $project->investment_line   = $request->investment_line;
            $project->user_id           = $request->user()->id;
            $project->institution_id    = $request->user()->institution_id;
            $project->project_type_id   = $request->project_type_id;
            $project->project_status_id = $request->project_status_id;
            $project->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $this->reportError($e);
            return $this->error("Ha ocurrido un error en el servidor", 500, $e);
        }

        return response()->json('done');
    }

    public function destroy(Project $project) {
        try {
            $project->delete();
        } catch (\Exception $e) {
            $this->reportError($e);
            return $this->error("Ha ocurrido un error en el servidor", 500, $e);
        }

        return $this->success([], 'done', 200);
    }
}