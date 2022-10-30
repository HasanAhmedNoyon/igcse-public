@extends('website.layouts.app')
@section('contents')
<div class="col-sm-2"></div>
<div class="col-12" style="margin-top: 70px">
    <!--Quiz Section Start-->
    <div class="container">
        <h1 class="text-center my-2">Quiz Section</h1>
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h6 class="text-center">Chapter: {{ $lecture->chapter->title }}</h6>
                <p class="text-center">lecture: {{ $lecture->title }}</p>
                <form method="post" action="{{ route('user.quiz.store', $lecture->id) }}">
                    @csrf
                    @method('PUT')
                    <fieldset class="form-group">
                        
                        @foreach ($datas as $key => $data)
                            <div class="row p-3">
                                <div class="col-sm-10">
                                    <h1 class="col-form-label col-sm-12 pt-0">{{ $key+1 }}. {{ $data->question }}</h1>
                                    @php
                                        $options = explode (",", $data->options); 
                                    @endphp
                                    <input type="hidden" class="mcq-{{ $data->id }}" name="mcq_ids[]" id="" value="{{ $data->id }}">
                                    <input type="hidden" class="mcq-answer-{{ $data->id }}" name="user_answers[]" id="" value="0">
                                    @foreach ($options as $key1 => $option)
                                        @php
                                            $key1 = $key1 + 1;
                                        @endphp
                                        <div class="form-check">
                                            <input class="form-check-input radio-btn" type="radio" name="answer{{ $data->id }}" id="option-{{ $data->id }}-{{ $key1 }}" value="{{ $key1 }}" data-id="{{ $data->id }}">
                                            <label class="form-check-label" for="option-{{ $data->id }}-{{ $key1 }}">{{ $option }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </fieldset>

                </form>
            </div>
            <div class="col-2"></div>
        </div>
    </div>
    <!--Quiz Section End-->
</div>
@endsection

@section('footer-links')
<script>
    $( document ).ready(function() {
        $('.radio-btn').change(function() {
            // alert( "ready!" );
            let id = $(this).attr('data-id');
            let v = $(this).val();
            // alert(id+'---'+v);
            // $('.mcq-'+id+'-'+v).val(id)
            // $('.mcq-'+id).val(id);
            $('.mcq-answer-'+id).val(v);
        });
    });
</script>
@endsection