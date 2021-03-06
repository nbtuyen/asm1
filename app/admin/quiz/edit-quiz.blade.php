<?php include 'app/admin/layout/header.php' ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Sửa Quiz</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="col-6 offset-3">
                        <div class="form-group">
                            <label for="">Tên Quiz</label>
                            <input type="text" name="name" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $quiz->name}}">
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian bắt đầu</label>
                            <input type="datetime-local" name="start_time" value="{{ date('Y-m-d\TH:i', strtotime($quiz->start_time)) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian kết thúc </label>
                            <input type="datetime-local" name="end_time" value="{{ date('Y-m-d\TH:i', strtotime($quiz->end_time)) }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Thời gian làm bài</label>
                            <input type="number" step="0" name="duration_minutes" value="{{ $quiz->duration_minutes }}" class="form-control">
                        </div>
                        <div class="form-check mt-3s">
                            <input class="form-check-input" name="status" <?php if ($quiz->status == 1) echo "checked" ?> type="checkbox" value="1" id="status">
                            <label class="form-check-label" for="status">
                                Online
                            </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input" name="is_shuffle" <?php if ($quiz->is_shuffle == 1) echo "checked" ?> type="checkbox" value="1" id="is_shuffle">
                            <label class="form-check-label" for="is_shuffle">
                                Đảo câu
                            </label>
                        </div>
                        <br>
                        <div class="">
                            <a href="{{ BASE_URL . 'dashboard/quiz' }}" class="btn btn-sm btn-danger">Hủy</a>
                            &nbsp;
                            <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
            <hr class="mt-3">
            <div class="col-10 offset-1">
                <button type="button" id="openAddQuestionModal" class="btn btn-success">Thêm câu hỏi</button>
                <div class="row mt-3">
                    @foreach($questions as $index => $qu)
                        <div class="col-6">
                            <ul class="list-group" style="margin-bottom:50px;">
                                <li class="list-group-item active" aria-current="true">
                                    Câu hỏi số: {{ $index + 1 }}:{{ $qu->name }}<button type="button" id="openAddAnswerModal<?=$index + 1?>" class="btn btn-success">Thêm đáp án</button><a href="{{ BASE_URL . 'question/xoa/' . $qu->id }}" class="btn btn-danger" style="margin-left:20px">Xóa</a>
                                </li>
                                <div class="modal fade" id="addAnswerModal<?=$index + 1?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tạo đáp án</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ BASE_URL . 'answer/luu-tao-moi' }}" method="post">
                                                <h3>Đáp án </h3>
                                                <table>
                                                    <thead>
                                                        <th style="width: 80%">Nội dung</th>
                                                        <th>Đáp án đúng</th>
                                                    </thead>
                                                    <tbody id="answer_list">
                                                        <tr>
                                                            <td style="width: 80%;">
                                                                <input type="text" class="form-control" name="content">
                                                            </td>
                                                            <td>
                                                                <input class="form-check-input" onchange="correctAnswerChange(this)" name="is_correct" type="checkbox" value="1" id="status" style="    margin-left: 40px;margin-top:7px;">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <input type="hidden" value="{{ $qu->id }}" name="question_id">
                                                <button type=" button" class="btn btn-secondary" data-bs-dismiss="modal" style="margin-top:7px;">Close</button>
                                                <button type="submit" class="btn btn-primary" style="margin-top:7px;">Save changes</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                        </div>
                                    </div>
                                </div>        
                                
                                @foreach($qu->getAnswers() as $ansIndex => $ans) 
                                    <li class="list-group-item">
                                        <div style="float:left">Đáp án {{ $ansIndex + 1  }}:
                                        </div>
                                        <div style="display:flex;justify-content: space-between;"><strong>{{ $ans->content }}</strong><?php if ($ans->is_correct == 1) echo "đúng" ?> <a href="{{ BASE_URL . 'answer/xoa/' . $ans->id }}" class="btn btn-sm btn-danger">Xóa</a></div>
                                    </li>
                                @endforeach 
                            </ul>
                        </div> 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tạo câu hỏi mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ BASE_URL . 'question/luu-tao-moi?quizId=' . $quiz->id }}" method="post">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="">Nội dung câu hỏi?</label>
                                <textarea name="name" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <br>
                    </div>
                    <input type="hidden" value="" id="correct_order">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    let options = {
        backdrop: false,
        keyboard: true
    };
    var addQuestionModel = new bootstrap.Modal(document.getElementById('addQuestionModal'), options)
    $("#openAddQuestionModal").click(function() {
        addQuestionModel.show();
    })

    <?php foreach ($questions as $index => $qu) : ?>
    var addAnswerModel<?=$index + 1?> = new bootstrap.Modal(document.getElementById('addAnswerModal<?=$index + 1?>'), options)
    $("#openAddAnswerModal<?=$index + 1?>").click(function() {
        addAnswerModel<?=$index + 1?>.show();
    })
    <?php endforeach ?>


    function correctAnswerChange(el) {
        $('tbody#answer_list').find('input[type="checkbox"]').prop('checked', false);
        $(el).prop('checked', true);
        // lấy danh sách tất cả các thẻ input:checkbox trong table
        var listCheckbox = $('tbody#answer_list').find('input[type="checkbox"]');
        $(listCheckbox).each(function(index, el) {
            if ($(el).is(':checked')) {
                $('#correct_order').val(index);
            }
        })
    }
</script>
<?php include 'app/admin/layout/footer.php' ?>
<style>
    #openAddAnswerModal {
        margin-left: 100px;

    }
</style>