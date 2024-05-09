@extends('admin.layout.template')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body" style="min-height: 175px; margin-left: 0px;">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-9 col-xxl-12">
						<div class="row">
							<div class="col-xl-12">
								<div class="row">  
									<div class="col-xl-12">
										<div class="row">
					
											<div class="col-xl-3 col-sm-6">
												<div class="card">
													<div class="card-body depostit-card">
														<div class="depostit-card-media d-flex justify-content-between style-1">
															<div>
																<h6>Tasks Not Finisheds</h6>
																<h3>20</h3>
															</div>
															<div class="icon-box bg-secondary">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<g clip-path="url(#clip0_3_566)">
																	<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M8 3V3.5C8 4.32843 8.67157 5 9.5 5H14.5C15.3284 5 16 4.32843 16 3.5V3H18C19.1046 3 20 3.89543 20 5V21C20 22.1046 19.1046 23 18 23H6C4.89543 23 4 22.1046 4 21V5C4 3.89543 4.89543 3 6 3H8Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M10.875 15.75C10.6354 15.75 10.3958 15.6542 10.2042 15.4625L8.2875 13.5458C7.90417 13.1625 7.90417 12.5875 8.2875 12.2042C8.67083 11.8208 9.29375 11.8208 9.62917 12.2042L10.875 13.45L14.0375 10.2875C14.4208 9.90417 14.9958 9.90417 15.3792 10.2875C15.7625 10.6708 15.7625 11.2458 15.3792 11.6292L11.5458 15.4625C11.3542 15.6542 11.1146 15.75 10.875 15.75Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M11 2C11 1.44772 11.4477 1 12 1C12.5523 1 13 1.44772 13 2H14.5C14.7761 2 15 2.22386 15 2.5V3.5C15 3.77614 14.7761 4 14.5 4H9.5C9.22386 4 9 3.77614 9 3.5V2.5C9 2.22386 9.22386 2 9.5 2H11Z" fill="#222B40"/>
																	</g>
																	<defs>
																	<clipPath id="clip0_3_566">
																	<rect width="24" height="24" fill="white"/>
																	</clipPath>
																	</defs>
																</svg>
															</div>
														</div>
														<div class="progress-box mt-0">
															<div class="d-flex justify-content-between">
																<p class="mb-0">Complete Task</p>
																<p class="mb-0">20/28</p>
															</div>
															<div class="progress">
																<div class="progress-bar bg-secondary" style="width:50%; height:5px; border-radius:4px;" role="progressbar"></div>
															</div>
														</div>
													</div>
												</div>	
											</div>
											<div class="col-xl-3 col-sm-6">
												<div class="card">
													<div class="card-body depostit-card">
														<div class="depostit-card-media d-flex justify-content-between style-1">
															<div>
																<h6>Tasks Not Finisheds</h6>
																<h3>20</h3>
															</div>
															<div class="icon-box bg-secondary">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<g clip-path="url(#clip0_3_566)">
																	<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M8 3V3.5C8 4.32843 8.67157 5 9.5 5H14.5C15.3284 5 16 4.32843 16 3.5V3H18C19.1046 3 20 3.89543 20 5V21C20 22.1046 19.1046 23 18 23H6C4.89543 23 4 22.1046 4 21V5C4 3.89543 4.89543 3 6 3H8Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M10.875 15.75C10.6354 15.75 10.3958 15.6542 10.2042 15.4625L8.2875 13.5458C7.90417 13.1625 7.90417 12.5875 8.2875 12.2042C8.67083 11.8208 9.29375 11.8208 9.62917 12.2042L10.875 13.45L14.0375 10.2875C14.4208 9.90417 14.9958 9.90417 15.3792 10.2875C15.7625 10.6708 15.7625 11.2458 15.3792 11.6292L11.5458 15.4625C11.3542 15.6542 11.1146 15.75 10.875 15.75Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M11 2C11 1.44772 11.4477 1 12 1C12.5523 1 13 1.44772 13 2H14.5C14.7761 2 15 2.22386 15 2.5V3.5C15 3.77614 14.7761 4 14.5 4H9.5C9.22386 4 9 3.77614 9 3.5V2.5C9 2.22386 9.22386 2 9.5 2H11Z" fill="#222B40"/>
																	</g>
																	<defs>
																	<clipPath id="clip0_3_566">
																	<rect width="24" height="24" fill="white"/>
																	</clipPath>
																	</defs>
																</svg>
															</div>
														</div>
														<div class="progress-box mt-0">
															<div class="d-flex justify-content-between">
																<p class="mb-0">Complete Task</p>
																<p class="mb-0">20/28</p>
															</div>
															<div class="progress">
																<div class="progress-bar bg-secondary" style="width:50%; height:5px; border-radius:4px;" role="progressbar"></div>
															</div>
														</div>
													</div>
												</div>	
											</div>
											<div class="col-xl-3 col-sm-6">
												<div class="card">
													<div class="card-body depostit-card">
														<div class="depostit-card-media d-flex justify-content-between style-1">
															<div>
																<h6>Tasks Not Finisheds</h6>
																<h3>20</h3>
															</div>
															<div class="icon-box bg-secondary">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<g clip-path="url(#clip0_3_566)">
																	<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M8 3V3.5C8 4.32843 8.67157 5 9.5 5H14.5C15.3284 5 16 4.32843 16 3.5V3H18C19.1046 3 20 3.89543 20 5V21C20 22.1046 19.1046 23 18 23H6C4.89543 23 4 22.1046 4 21V5C4 3.89543 4.89543 3 6 3H8Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M10.875 15.75C10.6354 15.75 10.3958 15.6542 10.2042 15.4625L8.2875 13.5458C7.90417 13.1625 7.90417 12.5875 8.2875 12.2042C8.67083 11.8208 9.29375 11.8208 9.62917 12.2042L10.875 13.45L14.0375 10.2875C14.4208 9.90417 14.9958 9.90417 15.3792 10.2875C15.7625 10.6708 15.7625 11.2458 15.3792 11.6292L11.5458 15.4625C11.3542 15.6542 11.1146 15.75 10.875 15.75Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M11 2C11 1.44772 11.4477 1 12 1C12.5523 1 13 1.44772 13 2H14.5C14.7761 2 15 2.22386 15 2.5V3.5C15 3.77614 14.7761 4 14.5 4H9.5C9.22386 4 9 3.77614 9 3.5V2.5C9 2.22386 9.22386 2 9.5 2H11Z" fill="#222B40"/>
																	</g>
																	<defs>
																	<clipPath id="clip0_3_566">
																	<rect width="24" height="24" fill="white"/>
																	</clipPath>
																	</defs>
																</svg>
															</div>
														</div>
														<div class="progress-box mt-0">
															<div class="d-flex justify-content-between">
																<p class="mb-0">Complete Task</p>
																<p class="mb-0">20/28</p>
															</div>
															<div class="progress">
																<div class="progress-bar bg-secondary" style="width:50%; height:5px; border-radius:4px;" role="progressbar"></div>
															</div>
														</div>
													</div>
												</div>	
											</div>
											<div class="col-xl-3 col-sm-6">
												<div class="card">
													<div class="card-body depostit-card">
														<div class="depostit-card-media d-flex justify-content-between style-1">
															<div>
																<h6>Tasks Not Finisheds</h6>
																<h3>20</h3>
															</div>
															<div class="icon-box bg-secondary">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<g clip-path="url(#clip0_3_566)">
																	<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M8 3V3.5C8 4.32843 8.67157 5 9.5 5H14.5C15.3284 5 16 4.32843 16 3.5V3H18C19.1046 3 20 3.89543 20 5V21C20 22.1046 19.1046 23 18 23H6C4.89543 23 4 22.1046 4 21V5C4 3.89543 4.89543 3 6 3H8Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M10.875 15.75C10.6354 15.75 10.3958 15.6542 10.2042 15.4625L8.2875 13.5458C7.90417 13.1625 7.90417 12.5875 8.2875 12.2042C8.67083 11.8208 9.29375 11.8208 9.62917 12.2042L10.875 13.45L14.0375 10.2875C14.4208 9.90417 14.9958 9.90417 15.3792 10.2875C15.7625 10.6708 15.7625 11.2458 15.3792 11.6292L11.5458 15.4625C11.3542 15.6542 11.1146 15.75 10.875 15.75Z" fill="#222B40"/>
																	<path fill-rule="evenodd" clip-rule="evenodd" d="M11 2C11 1.44772 11.4477 1 12 1C12.5523 1 13 1.44772 13 2H14.5C14.7761 2 15 2.22386 15 2.5V3.5C15 3.77614 14.7761 4 14.5 4H9.5C9.22386 4 9 3.77614 9 3.5V2.5C9 2.22386 9.22386 2 9.5 2H11Z" fill="#222B40"/>
																	</g>
																	<defs>
																	<clipPath id="clip0_3_566">
																	<rect width="24" height="24" fill="white"/>
																	</clipPath>
																	</defs>
																</svg>
															</div>
														</div>
														<div class="progress-box mt-0">
															<div class="d-flex justify-content-between">
																<p class="mb-0">Complete Task</p>
																<p class="mb-0">20/28</p>
															</div>
															<div class="progress">
																<div class="progress-bar bg-secondary" style="width:50%; height:5px; border-radius:4px;" role="progressbar"></div>
															</div>
														</div>
													</div>
												</div>	
											</div>
										
										</div>	
									</div>

						</div>

					</div>
					<div class="col-lx-12">
						<div class="row">
							<div class="col-xl-row">
								<div class="row">
									<div class="col-xl-4">
										<div class="card">
											<div class="card-header border-0">
												<h4 class="heading mb-0">New Product</h4>
											</div>
											<div class="card-body p-0">
												<div class="table-responsive active-projects">
													<table id="projects-tbl4" class="table">
														<thead>
															<tr>
																<th>PRDUCTS NAME</th>
																<th>PRICE</th>
																
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<div class="products">
																		<img src="{{asset('admin/images/contacts/d14.jpg')}}" class="avatar avatar-sm" alt="">
																		<div>
																			<h6><a href="javascript:void(0)">Air Conditioner</a></h6>
																			<span>24 Apr 2021</span>	
																		</div>	
																	</div>
																</td>	
																<td>$655</td>
															</tr>
															<tr>
																<td>
																	<div class="products">
																		<img src="{{asset('admin/images/contacts/d10.jpg')}}" class="avatar avatar-sm" alt="">
																		<div>
																			<h6><a href="javascript:void(0)">Air Conditioner</a></h6>
																			<span>24 Apr 2021</span>	
																		</div>	
																	</div>
																</td>	
																<td>$655</td>
															</tr>
															<tr>
																<td>
																	<div class="products">
																		<img src="{{asset('admin/images/contacts/d11.jpg')}}" class="avatar avatar-sm" alt="">
																		<div>
																			<h6><a href="javascript:void(0)">Bag Pack</a></h6>
																			<span>24 Apr 2021</span>	
																		</div>	
																	</div>
																</td>	
																<td>$699</td>
															</tr>
															<tr>
																<td>
																	<div class="products">
																		<img src="{{asset('admin/images/contacts/d12.jpg')}}" class="avatar avatar-sm" alt="">
																		<div>
																			<h6><a href="javascript:void(0)">Black Dress</a></h6>
																			<span>24 Apr 2021</span>	
																		</div>	
																	</div>
																</td>	
																<td>$955</td>
															</tr>
															<tr>
																<td class="border-0">
																	<div class="products">
																		<img src="{{asset('admin/images/contacts/d14.jpg')}}" class="avatar avatar-sm" alt="">
																		<div>
																			<h6><a href="javascript:void(0)">Air Conditioner</a></h6>
																			<span>24 Apr 2021</span>	
																		</div>	
																	</div>
																</td>	
																<td class="border-0">$655</td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-8">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="heading mb-0">Top Selling Products</h4>
									</div>
									<div class="card-body p-0">
										<div class="table-responsive active-projects">
											<table id="projects-tbl2" class="table">
												<thead>
													<tr>
														<th>PRDUCTS NAME</th>
														<th>PRICE</th>
														<th>SOLD</th>
														<th>REVENUE</th>
														
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>
															<div class="products">
																<img src="{{asset('admin/images/contacts/d1.jpg')}}" class="avatar avatar-sm" alt="">
																<div>
																	<h6><a href="javascript:void(0)">Air Conditioner</a></h6>
																	<span>24 Apr 2021</span>	
																</div>	
															</div>
														</td>	
														<td>$655</td>
														<td>55</td>
														<td>$5,956</td>
													</tr>
													<tr>
														<td>
															<div class="products">
																<img src="{{asset('admin/images/contacts/d10.jpg')}}" class="avatar avatar-sm" alt="">
																<div>
																	<h6><a href="javascript:void(0)">Bag Pack</a></h6>
																	<span>24 Apr 2021</span>	
																</div>	
															</div>
														</td>	
														<td>$585</td>
														<td>485</td>
														<td>$9,956</td>
													</tr>
													<tr>
														<td>
															<div class="products">
																<img src="{{asset('admin/images/contacts/d11.jpg')}}" class="avatar avatar-sm" alt="">
																<div>
																	<h6><a href="javascript:void(0)">Bag Pack</a></h6>
																	<span>24 Apr 2021</span>	
																</div>	
															</div>
														</td>	
														<td>$852</td>
														<td>5525</td>
														<td>$8,525</td>
													</tr>
													<tr>
														<td>
															<div class="products">
																<img src="{{asset('admin/images/contacts/d12.jpg')}}" class="avatar avatar-sm" alt="">
																<div>
																	<h6><a href="javascript:void(0)">Black Dress</a></h6>
																	<span>24 Apr 2021</span>	
																</div>	
															</div>
														</td>	
														<td>$852</td>
														<td>5985</td>
														<td>$8,525</td>
													</tr>
													<tr>
														<td class="border-0">
															<div class="products">
																<img src="{{asset('admin/images/contacts/d14.jpg')}}" class="avatar avatar-sm" alt="">
																<div>
																	<h6><a href="javascript:void(0)">Air Conditioner</a></h6>
																	<span>24 Apr 2021</span>	
																</div>	
															</div>
														</td>	
														<td class="border-0">$182</td>
														<td class="border-0">525</td>
														<td class="border-0">$6,525</td>
													</tr>
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
			</div>
        </div>
		
        <!--**********************************
            Content body end
        ***********************************-->
@endsection