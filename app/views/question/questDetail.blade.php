<?php include 'app/views/haeder.php'; ?>
<div class="box-center">
    @foreach ($quest as $quest)
        <div>
            {{$quest->name }}<br>
            @oreach ($answer as $answer)
                <div>
                    @if ($answer->question_id == $quest->id)
                        Đáp án:{{ $answer->content }}
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>
<?php include 'app/views/footer.php'; ?>