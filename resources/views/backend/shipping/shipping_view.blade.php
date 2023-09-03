

@extends('admin.admin_master')
@section('admin')
	  <div class="container-full">
		
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
								<th>Division Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						@foreach ($divisions as $division)
                     <x-shipping-area :division="$division"/> 

							
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
				  <h3 class="box-title">Add New Division </h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
<form method="post" action="{{route('division.store')}}" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-12">
			<div class="form-group">
				<h5>Division Name <span class="text-danger">*</span></h5>
				<div class="controls">
					<input type="text" name="division_name" id="division_name" class="form-control" >
					@error('division_name')
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