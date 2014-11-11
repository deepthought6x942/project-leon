@extends('layouts.admin_index')
@section('header')
<title>Auction Donations</title>
@stop 
@section('tablecontent')

<thead>

 {{link_to("auctionDonations/create", 'Create a new Donation')}} 

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
      <td>{{link_to("auctionDonations/{$donation->id}", $donation->id) }}</td>
      <td>{{$donation->user->last}}</td>
      <td>{{$donation->user->first}}</td>
      <td>{{$donation->title}}</td>
      <td>{{$donation->status}}</td>
    </tr>

  @endforeach

</tbody>
@stop