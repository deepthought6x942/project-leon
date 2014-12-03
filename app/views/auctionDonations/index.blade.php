@extends('layouts.index')
@section('header') Auction Donations @stop 
@section('tablecontent')

<thead>
 <tr>
  <th class="text-center">Donation ID</th>
  <th class="text-center">Last</th>
  <th class="text-center">First</th>
  <th class="text-center">Title</th>
  <th class="text-center">Status</th>
</tr>
</thead>
<tbody>

  @foreach ($auctionDonations as $donation)
    <tr class="text-center">
      <td>{{link_to("auctionDonations/{$donation->id}", "View/Edit") }}</td>
      <td>{{$donation->user->last}}</td>
      <td>{{$donation->user->first}}</td>
      <td>{{$donation->title}}</td>
      <td>{{$donation->status}}</td>
    </tr>

  @endforeach

</tbody>

@stop
@section('otherContent')
{{Form::open(['route'=>'auctionDonations.changeYear'])}}
{{Form::label("year", "Select Year: ")}}
{{Form::select("year",$years)}}
{{Form::submit("Select")}}
{{Form::close()}}
@stop