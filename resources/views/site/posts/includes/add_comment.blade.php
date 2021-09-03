<div class="comment_respond" id="add_comment_section">

    <h3 class="reply_title">Leave a Reply <small></small></h3>
    <form class="comment__form" action="{{ route('comments.store',['slug' => $post->slug]) }}" method="POST">
        @csrf
        <p>Your email address will not be published.Required fields are marked </p>
        <div class="input__box">
            <textarea name="comment" placeholder="Your comment here">{{ old('comment')}}</textarea>
            @error('comment') <span class="help-block text-danger">{{ $message }}</span>@enderror
        </div>
        <div class="input__wrapper clearfix">
            <div class="input__box name one--third">
                <input type="text" placeholder="name" value="{{ old('name')}}" name="name">
                @error('name') <span class="help-block text-danger">{{ $message }}</span>@enderror
        </div>
            <div class="input__box email one--third">
                <input type="email" placeholder="email" value="{{ old('email')}}" name="email">
                @error('email') <span class="help-block text-danger">{{ $message }}</span>@enderror
        </div>
            <div class="input__box website one--third">
                <input type="text" placeholder="website" value="{{ old('url')}}" name="url" >
                @error('url') <span class="help-block text-danger">{{ $message }}</span>@enderror
        </div>
        </div>
        <div class="submite__btn">
            <button type="submit">Post Comment</button>
            <button type="reset" class="cancel__btn">Cancel Comment</button>
        </div>
    </form>

</div>

