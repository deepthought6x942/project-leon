@extends('layouts.index')
@section('header')Monetary Donations
@stop
@section('table')
@if($table!=="N/A")
  {{$table->setOptions(['pageLength'=> 50, "dom"=>'TC<"clear">lfrtip', 
                          'tableTools' => array(
                                    "sRowSelect" =>"multi",
                                    "sSwfPath" => asset("/swf/copy_csv_xls.swf"),
                                    "aButtons" => [[
                                        "sExtends"=> "csv",
                                        "sButtonText"=>"Export All Columns",
                                        "mColumns"=>[ 1, 2, 3, 4, 5, 6]
                                    ],
                                    [
                                        "sExtends"=>"csv",
                                        "sButtonText"=>"Export Visible columns",
                                        "mColumns"=> "visible"
                                    ],
                                    "select_all", "select_none"]
                      )])->render()}}
@endif
@stop
@section('noneFound')
    <h1>There are no Monetary Donations</h1>
    <p> You can create one here: {{link_to_route('monetaryDonations.create')}} </p>


@endsection