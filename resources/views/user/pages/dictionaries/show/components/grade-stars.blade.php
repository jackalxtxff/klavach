<div class="rate-container" data-dict="{{$dictionary['id']}}"
     @if(count($dictionary['grades']) < 1)
     data-uri="{{route('grade.store')}}"
     data-method="POST"
>
    @else
        data-uri="{{route('grade.update', $dictionary['grades'][0]['id'])}}"
        data-method="PUT"
        >
    @endif
    <div class="feedback">
        @if(count($dictionary['grades']) < 1)
            <div class="rating">
                <input type="radio" name="rating" id="rating-5" data-value="5">
                <label for="rating-5"></label>
                <input type="radio" name="rating" id="rating-4" data-value="4">
                <label for="rating-4"></label>
                <input type="radio" name="rating" id="rating-3" data-value="3">
                <label for="rating-3"></label>
                <input type="radio" name="rating" id="rating-2" data-value="2">
                <label for="rating-2"></label>
                <input type="radio" name="rating" id="rating-1" data-value="1">
                <label for="rating-1"></label>
            </div>
        @else
            <div class="rating">
                <input type="radio" name="rating" id="rating-5" data-value="5"
                       @if($dictionary['grades'][0]['grade'] == 5) checked @endif>
                <label for="rating-5"></label>
                <input type="radio" name="rating" id="rating-4" data-value="4"
                       @if($dictionary['grades'][0]['grade'] == 4) checked @endif>
                <label for="rating-4"></label>
                <input type="radio" name="rating" id="rating-3" data-value="3"
                       @if($dictionary['grades'][0]['grade'] == 3) checked @endif>
                <label for="rating-3"></label>
                <input type="radio" name="rating" id="rating-2" data-value="2"
                       @if($dictionary['grades'][0]['grade'] == 2) checked @endif>
                <label for="rating-2"></label>
                <input type="radio" name="rating" id="rating-1" data-value="1"
                       @if($dictionary['grades'][0]['grade'] == 1) checked @endif>
                <label for="rating-1"></label>
            </div>
        @endif
    </div>
</div>
