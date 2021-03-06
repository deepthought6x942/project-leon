<?php

class ProjectsController extends \BaseController {

	protected $project;
	public function __construct (Project $project)
	{
		$this->project=$project;
	}
	protected $fieldsList=['id','name', 'start_date', 'end_date', 'type', 'description'];
	protected $columnNames=['Select', 'Name', 'Start Date', 'End Date', 'Type', 'Description'];

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Project::all()->count()>0)
		{
			$table = Datatable::table()
			->addColumn($this->columnNames)
			->setUrl(route('api.projects'))
			->noScript();
		}
		else
		{
			$table="N/A";
		}
		return View::make('projects/index', ['table'=>$table]);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$t=Project::groupby('type')->lists('type');
		
		foreach($t as $type)
		{
			$types[$type]=$type;
		}
		$types['Other']='Other';
		return View::make('projects.create', ['types'=>$types]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input=Input::all();
		if($input['type']==='Other')
		{
			$input['type']=$input['Other'];
		}
		if(!isset($input['end_date']))
		{
			$input['end_date']=$input['start_date'];
		}
		if(! $this->project->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->project->errors);
		}
		$this->project->save();
		return Redirect::route('projects.index');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$t=Project::groupby('type')->lists('type');
		$types=['Other'=>'Other'];
		foreach($t as $type)
		{
			$types[$type]=$type;
		}
		if(EventAttendance::with('project')->where('eid',$id)->get()->count()<1)
		{
			$eatable="N/A";
		}else{
			$eatable = Datatable::table()
			->addColumn(EventAttendancesController::$projectsColumnNames)
			->setUrl(route('api.eventAttendances.projectTable',$id))
			->noScript();
		}
		if(MonetaryDonation::with('project')->where('eid',$id)->get()->count()<1)
		{
			$mdtable="N/A";
		}else{
			$mdtable = Datatable::table()
			->addColumn(MonetaryDonationsController::$projectsColumnNames)
			->setUrl(route('api.monetaryDonations.projectTable',$id))
			->noScript();
		}
		$project=Project::with('eventAttendance.user')->find($id);
		return View::make('projects/show', ['project'=>$project, 'types'=>$types, 'eatable'=>$eatable, 'mdtable'=>$mdtable]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$project=Project::with('eventAttendance.user')->find($id);
		return View::make('projects/show', ['project'=>$project, 'editable'=>'TRUE']);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input=Input::all();
		if($input['type']==='Other')
		{
			$input['type']=$input['Other'];
		}
		if(! $this->project->fill($input)->isValid())
		{
			return Redirect::back()->withInput()->withErrors($this->project->errors);
		}
		$project =$this->project->find($id)->fill($input);
		$project->save();
		return Redirect::route('projects.index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$project = $this->find($id);
		$project->delete();
		return Redirect::route('projects.index');
	}
	public function getDatatable()
	{
		
		$query = Project::select($this->fieldsList)->get();

		return Datatable::collection($query)
		->showColumns($this->fieldsList)
		->addColumn('id', function($model)
		{
			return link_to('projects/'.$model->id,'View/Edit');
		})
		->make();
	}
	public function getRadioDatatable()
	{
		
		$query = Project::select($this->fieldsList)->get();

		return Datatable::collection($query)
		->showColumns($this->fieldsList)
		->addColumn('id', function($model)
		{
			return Form::radio('eid', $model->id);
		})
		->make();
	}
}
