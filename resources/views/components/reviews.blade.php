@props(["reviews"])

<div class="reviews">
    @foreach($reviews as $review)
        <h5>{{$review->user_id}}</h5>
        <p>{{$review->text}}</p>
        <span>{{$review->numberOfStars}}/5</span>
        <a href="/delete" class="btn btn-custom" type="submit">Zmazať</a>
     @endforeach
</div>
