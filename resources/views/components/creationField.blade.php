<h3 class="quiz-creation-header">
    {!! __($title) !!}
</h3>

<label>
    <p>{!! __($title) !!}</p>
    <input
        type={!! $type !!} name={!! $name !!}
        placeholder="{!! __($placeholder) !!}"

        @if($required) required @endif
    />
</label>


{{--<div class="item">--}}
{{--    <p>Your email</p>--}}
{{--    <input type="text" name="name"/>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <p>Date of complaint</p>--}}
{{--    <input type="date" name="name" required/>--}}
{{--    <i class="fas fa-calendar-alt"></i>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <p>Your department</p>--}}
{{--    <select>--}}
{{--        <option value="">*Please select*</option>--}}
{{--        <option value="A">Department A</option>--}}
{{--        <option value="B">Department B</option>--}}
{{--        <option value="C">Department C</option>--}}
{{--        <option value="D">Department D</option>--}}
{{--        <option value="E">Department E</option>--}}
{{--    </select>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <p>Office manager name</p>--}}
{{--    <input type="text" name="name"/>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <p>The person(s) involved in this complaint are</p>--}}
{{--    <textarea rows="5"></textarea>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <p>Note all relevant dates, places, events, etc. pertaining to the complaint</p>--}}
{{--    <textarea rows="5"></textarea>--}}
{{--</div>--}}
{{--<div class="item">--}}
{{--    <p>Signature</p>--}}
{{--    <textarea rows="5"></textarea>--}}
{{--</div>--}}
{{--<div class="btn-block">--}}
{{--    <button type="submit" href="/">Send</button>--}}
{{--</div>--}}
