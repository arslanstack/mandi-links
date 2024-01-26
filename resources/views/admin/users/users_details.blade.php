@extends('admin.admin_app')
@push('styles')
@endpush
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-8 col-sm-8 col-xs-8">
		<h2> Users Details </h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('admin') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">
				<strong> Users Details </strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-4 text-right">
		<a class="btn btn-primary t_m_25" href="{{ url('admin/users') }}">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Users
		</a>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="tabs-container">
				<ul class="nav nav-tabs" role="tablist">
					<li class="show_vehicle_tab"><a class="nav-link active show" data-toggle="tab" href="#tab-1">User Profile</a></li>
					<li class="show_bids_tab"><a class="nav-link" data-toggle="tab" href="#tab-2">User Products</a></li>
					<li class="show_req_tab"><a class="nav-link" data-toggle="tab" href="#tab-3">Product Requests</a></li>
				</ul>
				<div class="tab-content">
					<div id="tab-1" class="tab-pane active show" role="tabpanel">
						<div class="row">
							<div class="col-md-12">
								<div class="ibox">
									<div class="row ibox-content" style="border: none !important;">
										<div class="col-md-4">
											<div class="ibox-title" style="border: none !important;">
												<h5>Profile Image</h5>
											</div>
											<div>
												<div class="ibox-content p-4 border-left-right text-center">
													<img alt="image" class="img-fluid" src="{{ asset('assets/upload_images') }}/{{$user->image_name}}" style="width: 250px; height: 250px; object-fit:contain;">
												</div>
											</div>
										</div>
										<div class="col-md-8">
											<div class="ibox">
												<div class="ibox-title" style="border: none !important;">
													<h5>User Details</h5>
												</div>
												<div class="ibox-content">
													<div>
														<div class="feed-activity-list">
															<div class="row">
																<div class="col-lg-12">
																	<div class="row">
																		<strong class="col-sm-2 col-form-label">User Name</strong>
																		<div class="col-sm-4 col-form-label text-danger">
																			{{ $user->name }}
																		</div>
																		<strong class="col-sm-2 col-form-label">Email</strong>
																		<div class="col-sm-4 col-form-label">
																			{{ $user->email }}
																		</div>
																	</div>
																	<div class="row">
																		<strong class="col-sm-2 col-form-label">Phone No</strong>
																		<div class="col-sm-4 col-form-label">
																			{{ $user->phone_no }}
																		</div>
																		<strong class="col-sm-2 col-form-label">City</strong>
																		<div class="col-sm-4 col-form-label">
																			{{$user->city ? $user->city->city_name : 'N/A'}}
																		</div>
																	</div>
																	<div class="row">
																		<strong class="col-sm-2 col-form-label">Address</strong>
																		<div class="col-sm-4 col-form-label">
																			{{ $user->address ? $user->address : 'N/A' }}
																		</div>
																		<strong class="col-sm-2 col-form-label">Zip Code</strong>
																		<div class="col-sm-4 col-form-label">
																			{{ $user->zip ? $user->zip : 'N/A' }}
																		</div>
																	</div>
																	<div class="row">
																		<strong class="col-sm-2 col-form-label">Joining Date</strong>
																		<div class="col-sm-4 col-form-label">
																			{{ date_formated($user->created_at) }}
																		</div>
																		<strong class="col-sm-2 col-form-label">Status</strong>
																		<div class="col-sm-4 col-form-label">
																			@if($user->is_blocked == 1)
																			<label class="label label-danger"> Blocked </label>
																			@else
																			@if ($user->status==1)
																			<label class="label label-primary"> Active </label>
																			@else
																			<label class="label label-warning"> Inactive </label>
																			@endif
																		</div>

																		@endif
																	</div>
																	<div class="row">
																		<strong class="col-sm-2 col-form-label">Total Products</strong>
																		<div class="col-sm-4 col-form-label text-left">
																			{{count_user_posts($user->id) > 0 ? count_user_posts($user->id) : 'N/A'}}
																		</div>
																		<strong class="col-sm-2 col-form-label">Product Requests</strong>
																		<div class="col-sm-4 col-form-label text-left">
																			{{count_user_requests($user->id) > 0 ? count_user_requests($user->id) : 'N/A'}}
																		</div>
																	</div>
																	<div class="row">
																		<strong class="col-sm-2 col-form-label">Total Favourites</strong>
																		<div class="col-sm-4 col-form-label text-left">
																			{{count_user_favourites($user->id) > 0 ? count_user_favourites($user->id) : 'N/A'}}
																		</div>
																		<strong class="col-sm-2 col-form-label">Total Chats</strong>
																		<div class="col-sm-4 col-form-label text-left">
																			{{count_user_chat_threads($user->id) > 0 ? count_user_chat_threads($user->id) : 'N/A'}}
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="tab-2" class="tab-pane" role="tabpanel">
						<div class="ibox">
							<div class="ibox-title">
								<h5>User Products</h5>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="manage_tbl" class="table table-striped table-bordered dt-responsive" style="width:100%">
										<thead>
											<tr>
												<th>Sr #</th>
												<th>Title</th>
												<th>Favourites</th>
												<th>Creation Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@php($i = 1)
											@foreach($posts as $item)
											<tr class="gradeX">
												<td>{{ $i++ }}</td>
												<td>{{ \Illuminate\Support\Str::limit($item->title, 60, '...') }}</td>
												<td>{{count_post_favs($item->id) > 0 ? count_post_favs($item->id) : 'N/A'}}</td>
												<td>{{ date_formated($item->created_at)}}</td>
												<td>
													@if($item->status == 0)
													<label class="label label-danger"> Disabled </label>
													@else
													<label class="label label-primary"> Active </label>
													@endif
												</td>
												<td>
													<a class="btn btn-primary btn-sm" href="{{ url('admin/product-posts/detail') }}/{{ $item->id }}">Details</a>
													<!-- <button class="btn btn-danger btn-sm btn_delete" data-id="{{$item->id}}" data-text="This action will delete this category." type="button" data-placement="top" title="Delete">Delete</button> -->
													@if ($item->status==1)
													<button class="btn btn-danger btn-sm btn_update_status" data-id="{{$item->id}}" data-status="0" data-text="This action will disable this post and hide it from users' timeline." type="button" data-placement="top" title="Inactivate">Disable</button>
													@else
													<button class="btn btn-success btn-sm btn_update_status" data-id="{{$item->id}}" data-status="1" data-text="This action will enable this post and start showing it in users' timeline." type="button" data-placement="top" title="Activate">Enable</button>
													@endif
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div id="tab-3" class="tab-pane" role="tabpanel">
						<div class="ibox">
							<div class="ibox-title">
								<h5>Product Requests</h5>
							</div>
							<div class="ibox-content">
								<div class="table-responsive">
									<table id="manage_tbl_two" class="table table-striped table-bordered dt-responsive" style="width:100%">
										<thead>
											<tr>
												<th>Sr #</th>
												<th>Title</th>
												<th>Favourites</th>
												<th>Creation Date</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@php($i = 1)
											@foreach($requests as $item)
											<tr class="gradeX">
												<td>{{ $i++ }}</td>
												<td>{{ \Illuminate\Support\Str::limit($item->title, 60, '...') }}</td>
												<td>{{count_request_favs($item->id) > 0 ? count_request_favs($item->id) : 'N/A'}}</td>
												<td>{{ date_formated($item->created_at)}}</td>
												<td>
													@if($item->status == 0)
													<label class="label label-danger"> Disabled </label>
													@else
													<label class="label label-primary"> Active </label>
													@endif
												</td>
												<td>
													<a class="btn btn-primary btn-sm" href="{{ url('admin/product-requests/detail') }}/{{ $item->id }}">Details</a>
													<!-- <button class="btn btn-danger btn-sm btn_delete" data-id="{{$item->id}}" data-text="This action will delete this category." type="button" data-placement="top" title="Delete">Delete</button> -->
													@if ($item->status==1)
													<button class="btn btn-danger btn-sm btn_update_status_requests" data-id="{{$item->id}}" data-status="0" data-text="This action will disable this post and hide it from users' timeline." type="button" data-placement="top" title="Inactivate">Disable</button>
													@else
													<button class="btn btn-success btn-sm btn_update_status_requests" data-id="{{$item->id}}" data-status="1" data-text="This action will enable this post and start showing it in users' timeline." type="button" data-placement="top" title="Activate">Enable</button>
													@endif
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var tabLinks = document.querySelectorAll('.nav-tabs a.nav-link');
		tabLinks.forEach(function(tabLink) {
			tabLink.addEventListener('click', function(event) {
				event.preventDefault();
				var targetTabId = tabLink.getAttribute('href');
				var tabParamsMap = {
					'#tab-1': 'profile',
					'#tab-2': 'products',
					'#tab-3': 'requests'
				};
				var tabParam = tabParamsMap[targetTabId];
				var currentUrl = new URL(window.location.href);
				currentUrl.searchParams.set('tab', tabParam);
				history.replaceState(null, null, currentUrl);
				$(targetTabId).tab('show');
			});
		});
		var urlParams = new URLSearchParams(window.location.search);
		var tabParam = urlParams.get('tab');
		if (tabParam) {
			var tabIdsMap = {
				'profile': '#tab-1',
				'products': '#tab-2',
				'requests': '#tab-3'
			};
			var tabId = tabIdsMap[tabParam];
			$('a[href="' + tabId + '"]').tab('show');
		}
	});

	$(document).on('click', '.show_bids_tab', function() {
		if (!($("table#manage_tbl").hasClass("dataTable"))) {
			$('#manage_tbl').dataTable({
				"paging": true,
				"searching": true,
				"bInfo": true,
				"responsive": true,
				"pageLength": 50,
				"columnDefs": [{
						"responsivePriority": 1,
						"targets": 0
					},
					{
						"responsivePriority": 2,
						"targets": -1
					},
				]
			});
		}
	});
	$(document).on('click', '.show_req_tab', function() {
		if (!($("table#manage_tbl_two").hasClass("dataTable"))) {
			$('#manage_tbl_two').dataTable({
				"paging": true,
				"searching": true,
				"bInfo": true,
				"responsive": true,
				"pageLength": 50,
				"columnDefs": [{
						"responsivePriority": 1,
						"targets": 0
					},
					{
						"responsivePriority": 2,
						"targets": -1
					},
				]
			});
		}
	});


	$(document).on("click", ".btn_update_status", function() {
		var id = $(this).attr('data-id');
		var status = $(this).attr('data-status');
		var show_text = $(this).attr('data-text');
		swal({
				title: "Are you sure?",
				text: show_text,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Please!",
				cancelButtonText: "No, Cancel Please!",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$(".confirm").prop("disabled", true);
					$.ajax({
						url: "{{ url('admin/product-posts/update_statuses') }}",
						type: 'post',
						data: {
							"_token": "{{ csrf_token() }}",
							'id': id,
							'status': status
						},
						dataType: 'json',
						success: function(status) {
							$(".confirm").prop("disabled", false);
							if (status.msg == 'success') {
								swal({
										title: "Success!",
										text: status.response,
										type: "success"
									},
									function(data) {
										location.reload();
									});
							} else if (status.msg == 'error') {
								swal("Error", status.response, "error");
							}
						}
					});
				} else {
					swal("Cancelled", "", "error");
				}
			});
	});
	$(document).on("click", ".btn_update_status_requests", function() {
		var id = $(this).attr('data-id');
		var status = $(this).attr('data-status');
		var show_text = $(this).attr('data-text');
		swal({
				title: "Are you sure?",
				text: show_text,
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes, Please!",
				cancelButtonText: "No, Cancel Please!",
				closeOnConfirm: false,
				closeOnCancel: true
			},
			function(isConfirm) {
				if (isConfirm) {
					$(".confirm").prop("disabled", true);
					$.ajax({
						url: "{{ url('admin/product-requests/update_statuses') }}",
						type: 'post',
						data: {
							"_token": "{{ csrf_token() }}",
							'id': id,
							'status': status
						},
						dataType: 'json',
						success: function(status) {
							$(".confirm").prop("disabled", false);
							if (status.msg == 'success') {
								swal({
										title: "Success!",
										text: status.response,
										type: "success"
									},
									function(data) {
										location.reload();
									});
							} else if (status.msg == 'error') {
								swal("Error", status.response, "error");
							}
						}
					});
				} else {
					swal("Cancelled", "", "error");
				}
			});
	});
</script>
@endpush