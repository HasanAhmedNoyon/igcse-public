@extends('website.layouts.app')

@section('header-links')
<!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
<link rel="stylesheet" type="text/css" href="{{ asset('all/admin/plugins/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('all/admin/plugins/table/datatable/dt-global_style.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('all/admin/plugins/table/datatable/custom_dt_custom.css') }}">
@endsection

@section('contents')
<div class="container">
    <h3 class="text-center font-weight-normal">Student Dashboard</h3>
    <hr>
    <div class="row">
        @include('user.layouts.sidebar')
        <div class="col-md-8 col-lg-8">
            <div class="right-section">
                <div class="card-deck text-center">
                    <div class="card bg-success text-light">
                        <div class="card-body">
                            <h5 class="card-title">Chapter Completed</h5>
                            <p class="card-text num_of_chapter"></p>
                        </div>
                    </div>
                    <div class="card bg-primary text-light">
                        <div class="card-body">
                            <h5 class="card-title">lecture Completed</h5>
                            <p class="card-text num_of_lecture"></p>
                        </div>
                    </div>
                    <div class="card bg-info text-light">
                        <div class="card-body">
                            <h5 class="card-title">Obtained Marks</h5>
                            <p class="card-text num_of_obtain">0</p>
                        </div>
                    </div>
                </div>

                <div class="table-responsive my-4">
                    <table id="style-3" class="table style-3  table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Chapter</th>
                                <th scope="col">Lecture</th>
                                <th scope="col">Quiz</th>
                                <th scope="col">Point</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        @php
                            $chapter_array = array();
                            $lecture_array = array();
                            $total_exam_given = 0;
                            $total_percentage_got = 0;
                        @endphp
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    @if (!in_array($result->lecture->chapter->id, $chapter_array))
                                        @php
                                            array_push($chapter_array,$result->lecture->chapter->id);
                                        @endphp
                                    @endif
                                    @if (!in_array($result->lecture->id, $lecture_array))
                                        @php
                                            array_push($lecture_array,$result->lecture->id);
                                        @endphp
                                    @endif
                                    <td scope="row">{{ ++$loop->index }}</td>
                                    <td>{{ $result->lecture->chapter->title }}</td>
                                    <td>{{ $result->lecture->title }}</td>
                                    <td>{{ $result->total_correct }}/{{ $result->total_correct + $result->total_wrong }}</td>
                                    @php
                                        $got_percentage = round((($result->total_correct/($result->total_correct + $result->total_wrong))*100), 2);
                                        ++$total_exam_given;
                                        $total_percentage_got += $got_percentage;
                                    @endphp
                                    <td>{{ $got_percentage }}%</td>
                                    <td><span class="badge bg-{{ $got_percentage >= 50 ? 'success' : 'danger' }} text-white px-2 py-1">{{ $got_percentage >= 50 ? 'Passed' : 'Failed' }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    if(count($results) > 0){
        $avg_percentage_got = round($total_percentage_got/$total_exam_given, 2);
    }
    else{
        $avg_percentage_got = 0;
    }
@endphp
@endsection

@section('footer-links')
<script>
    $( document ).ready(function() {
        $('.num_of_chapter').text("{{ count($chapter_array) }}");
        $('.num_of_lecture').text("{{ count($lecture_array) }}");
        $('.num_of_obtain').text("{{ $avg_percentage_got }}%");
    });
</script>

<script src="{{ asset('all/admin/plugins/table/datatable/datatables.js') }}"></script>
<script>

    c3 = $('#style-3').DataTable({
        "oLanguage": {
            "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
            "sSearchPlaceholder": "Search...",
        "sLengthMenu": "Results :  _MENU_",
        },
        "stripeClasses": [],
        "lengthMenu": [5, 10, 20, 50],
        "pageLength": 5
    });

    multiCheck(c3);
</script>
<!-- END PAGE LEVEL SCRIPTS -->  
@endsection