<?php

class MonetaryDonationsController extends \BaseController {

  protected $monetaryDonation;
  public function __construct (MonetaryDonation $monetaryDonation){
    $this->monetaryDonation=$monetaryDonation;
  }



	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	if( !(Auth::user()->type==='admin')){
      return Redirect::to('/');
    }
		$monetaryDonations=MonetaryDonation::with('user','project')->get();
    	return View::make('monetaryDonations/index', ['monetaryDonations'=>$monetaryDonations]);
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('monetaryDonations.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $raw_input=Input::all();
    $first=$raw_input["first"];
    $last=$raw_input["last"];
    $project_ident=$raw_input["project_name"];

    $user=User::where('first','=', $first)->where('last', '=', $last)->first();
    $project=Project::where('id','=',$project_ident)->first();

    $input=array('uid'=>$user->id, 'check_number'=>$raw_input["check_number"], 'eid'=>$project->id, 'date'=>$raw_input["date"], 'amount'=>$raw_input["amount"]);


    if(! $this->monetaryDonation->fill($input)->isValid()){
      return Redirect::back()->withInput()->withErrors($this->monetaryDonation->errors);
    }
		$this->monetaryDonation->save();
    return Redirect::route('monetaryDonations.index');
	}
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $donation=MonetaryDonation::with('user','project')->find($id);
		return View::make('monetaryDonations.show', ['donation'=>$donation, 'editable'=>false]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$monetaryDonation=MonetaryDonation::with('user','project')->find($id);
		return View::make('monetaryDonations/show', ['monetaryDonation'=>$monetaryDonation, 'editable'=>true]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$raw_input=Input::all();
		$first=$raw_input["first"];
		$last=$raw_input["last"];
		$project_ident=$raw_input["project_name"];
		$user=User::where('first','=', $first)->where('last', '=', $last)->first();
		$project=Project::where('id','=',$project_ident)->first();
		$input=array('uid'=>$user->id, 'check_number'=>$raw_input["check_number"], 'eid'=>$project->id, 'date'=>$raw_input["date"], 'amount'=>$raw_input["amount"]);

	    if(! $this->monetaryDonation->fill($input)->isValid()){
	      return Redirect::back()->withInput()->withErrors($this->monetaryDonation->errors);
	    }

	    $monetaryDonation = $this->monetaryDonation->find($id)->fill($input);
  		$monetaryDonation->save();
	    //return Redirect::route('monetaryDonations.show($id)');
	    return Redirect::back();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		 $monetaryDonation = $this->find($id);
		 $monetaryDonation->delete();
		 return Redirect::route('monetaryDonations.index');
	}


}
