@extends('admin.admin_master')
@section('admin')
	  <div class="container-full">
		<!-- Content Header (Page header) -->
<!-- 		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="mr-auto">
					<h3 class="page-title">Data Tables</h3>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item" aria-current="page">Tables</li>
								<li class="breadcrumb-item active" aria-current="page">Data Tables</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div> -->

		<!-- Main content -->
		<section class="content">
		  <div class="row">
 
			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Coupon List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table  id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Coupon Name</th>
								<th>Coupon Discount</th>
                                <th>Validity</th>
                                <th>Status</th>
								<th width="50%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($coupons as $coupon)
							<tr>
								<td>{{$coupon->coupon_name}}</td>
                                <td>{{$coupon->discount}}%</td>
                                <td>

								{{Carbon\Carbon::parse($coupon->validity)->format('D,d F Y')}}
								
								
								
								</td>
                                <td>
                                @if($coupon->status == 1 && $coupon->validity >=Carbon\Carbon::now()->format('Y-m-d') )
								<span class="badge badge-pill badge-success"> Active </span>
								@else
								<span class="badge badge-pill badge-danger"> InActive </span>
								@endif

                                </td>
								<td width="25%">
								<a href="{{route('coupon.edit',$coupon->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>

									<a href="{{route('coupon.delete',$coupon->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
</td>	
							</tr>
							@endforeach
						</tbody>
					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div>
			<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add New Category </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
<form method="post" action="{{route('coupon.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<h5>Coupon Name <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="coupon_name" id="coupon_name" class="form-control" >
					@error('coupon_name')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>


            <div class="form-group">
				<h5>Coupon Discount <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="discount" id="discount" class="form-control" >
					@error('discount')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>

            <div class="form-group">
				<h5>Coupon Validity <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="date" name="validity" id="validity" class="form-control" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" >
						
	
					@error('validity')
					<span class="text-danger">{{ $message }}</span>
					@enderror
				</div>
				
			</div>

          
			
			<div class="text-xs-right">
				<input type="submit" class="btn btn-rounded btn-primary btn-info mb-5" value="Add New">
			</div>
		</form>
					
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
			</div> 
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
@endsection