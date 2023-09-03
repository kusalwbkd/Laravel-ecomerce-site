<tr>
<td>{{$division->shipping_division}}</td>
                               
<td>
<a href="{{route('division.edit',$division->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>

<a href="{{route('division.delete',$division->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
</td>	
</tr>