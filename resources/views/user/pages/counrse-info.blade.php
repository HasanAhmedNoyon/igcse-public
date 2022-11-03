@extends('website.layouts.app')
@section('contents')
<div class="container">
    <h3 class="text-center font-weight-normal">Student Dashboard</h3>
    <hr>
    <div class="row">
        @include('user.layouts.sidebar')
        <div class="col-md-8 col-lg-8">
            <div class="right-section">
                <div class="row">
                    @php
                        $total_exam_given = 0;
                        $total_percentage_got = 0;
                    @endphp
                    @foreach ($results as $result)
                        <div class="col-sm-12 col-md-6 col-lg-4 mb-2">
                            <div class="card-deck">
                                <div class="card">
                                    <img class="card-img-top" src="{{ $result->lecture->chapter->icon ? asset('storage/'.$result->lecture->chapter->icon) : asset('no-image.png') }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $result->lecture->chapter->title }}</h5> <br>
                                        <span class="card-text">{{ $result->lecture->title }}</span><br>
                                        @php
                                            $got_percentage = round((($result->total_correct/($result->total_correct + $result->total_wrong))*100), 2);
                                            ++$total_exam_given;
                                            $total_percentage_got += $got_percentage;
                                        @endphp
                                        <span class="card-text">Obtained Marks: {{ $got_percentage }}%</span> <br>
                                        <span class="card-text">Status: <span class="badge bg-{{ $result->status == 1? 'success' : 'danger' }}">{{ $result->status == 1? 'Passed' : 'Failed' }}</span></span> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
            </div>

        </div>
    </div>
</div>
@endsection