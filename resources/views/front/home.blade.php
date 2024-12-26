@extends('front.layouts.app')

@section('main')

    <section class="section-0 lazy d-flex bg-image-style dark align-items-center " class="shadow"
        data-bg="{{asset('assets/images/banner5.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-8">
                    <h3 id="title-header">Explore 1,000+ Job Opportunities and Advance Your Career</h3>
                    <p id="title2-header">Find the right job that fits your skills and goals.</p>
                    <div class="banner-btn mt-2"><a href="{{ route('jobs') }}" class="btn btn-primary mb-4 mb-sm-0 px-4 py-2">Search Careers</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1 py-5 ">
        <div class="container">
            <div class="card p-5" id="card-search">
                <form action="{{ route('jobs') }}" method="GET">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <input type="text" class="form-control border-end-0" name="keyword" id="keyword" placeholder="Keywords">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control rounded-0 border-end-0" name="location" id="location" placeholder="Location">
                        </div>
                        <div class="col-md-3">
                            <select name="category" id="category" class="form-control rounded-0">
                                <option value="">Select a Category</option>
                                @if ($newCategories->isNotEmpty())
                                    @foreach ($newCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-3 ps-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary shadow-sm" id="button-search-header">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="section-2 bg-2 py-5">
        <div class="container">
            <h2>Popular Categories</h2>
            <div class="row pt-5">

                @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                <div class="col-lg-4 col-xl-3 col-md-6">
                    <div class="single_catagory shadow-sm">
                        <a href="{{ route('jobs').'?category='.$category->id }}">
                            <h4 class="pb-2">{{ $category->name }}</h4>
                        </a>
                        <p class="mb-0"> <span>{{ $category->jobs->count() }}</span> Available position</p>
                    </div>
                </div>
                @endforeach
                    
                @endif 
            </div>
        </div>
    </section>

    <section class="section-3  py-5">
        <div class="container">
            <h2>Featured Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">

                            @if ($featuredJobs->isNotEmpty())
                                @foreach ($featuredJobs as $featuredJob)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4" id="box-view-job">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $featuredJob->title }}</h3>

                                            <p id="text-description-width">{{ Str::words(strip_tags ($featuredJob->description), 10) }}</p>
                                            
                                            <div class="bg-light p-3 border" id="fill-box-job">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $featuredJob->location }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $featuredJob->jobType->name }}</span>
                                                </p>
                                                @if (!is_null($featuredJob->salary))
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{ $featuredJob->salary }}</span>
                                                </p>
                                                @endif
                                                
                                            </div>
    
                                            <div class="d-grid mt-3">
                                                <a href="{{ route('jobDetail',$featuredJob->id) }}" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif

                            

                        

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3 bg-2 py-5">
        <div class="container">
            <h2>Latest Jobs</h2>
            <div class="row pt-5">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($latestJobs->isNotEmpty())
                                @foreach ($latestJobs as $latestJob)
                                <div class="col-md-4">
                                    <div class="card border-0 p-3 shadow mb-4" id="box-view-job">
                                        <div class="card-body">
                                            <h3 class="border-0 fs-5 pb-2 mb-0">{{ $latestJob->title }}</h3>

                                            <p id="text-description-width">{{ Str::words(strip_tags ($latestJob->description), 10) }}</p>
                                            
                                            <div class="bg-light p-3 border" id="fill-box-job">
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                    <span class="ps-1">{{ $latestJob->location }}</span>
                                                </p>
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                    <span class="ps-1">{{ $latestJob->jobType->name }}</span>
                                                </p>
                                                @if (!is_null($latestJob->salary))
                                                <p class="mb-0">
                                                    <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                    <span class="ps-1">{{ $latestJob->salary }}</span>
                                                </p>
                                                @endif
                                                
                                            </div>
    
                                            <div class="d-grid mt-3">
                                                <a href="{{ route('jobDetail',$latestJob->id) }}" class="btn btn-primary btn-lg">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection