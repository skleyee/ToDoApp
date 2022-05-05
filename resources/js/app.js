require('./bootstrap');

let checkbox_buttons = document.getElementsByClassName('checkbox');
for (let elem of checkbox_buttons) {
    elem.addEventListener('click', function (event) {
        let liElem = elem.parentNode.parentNode.parentNode;
        event.target.checked === true ? liElem.classList.add('completed') : liElem.classList.remove('completed');
    })
}
let remove_buttons = document.getElementsByClassName('remove');
for (let elem of remove_buttons) {
    elem.addEventListener('click', function (event) {
        let elemId = elem.parentNode.id;
        elem.parentNode.remove();
        $.ajax({
            url: '/deleteTask',
            method: 'post',
            dataType: 'json',
            data: {"_token": $('meta[name="csrf-token"]').attr('content'), id: elemId}
        });
    })
}
let add_butt = document.getElementById('add');
add_butt.addEventListener('click', function (event) {
    let task_desc = add_butt.previousSibling.previousSibling.value;
    $.ajax({
        url: '/addTask',
        method: 'post',
        dataType: 'json',
        data: {"_token": $('meta[name="csrf-token"]').attr('content'), description: task_desc},
        success: function(data){
            console.log(data);
            let task = data[0];
            $('ul').append(`<li id="${ task['id'] }" class="${ task['its_done'] ? 'completed' : '' }">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="checkbox" type="checkbox"${ task['its_done'] ? 'checked' : '' }> ${task['description'] } <i class="input-helper"></i></label>
                                </div> <i class="remove mdi mdi-close-circle-outline"></i> <i data-toggle="modal" data-target="#exampleModal" class="edit fa fa-pencil-square-o" aria-hidden="true"></i>
                            </li>`);
            $('#task_input').val('');
        }
    });
})

$('#exampleModal').on('show.bs.modal', function (event) {
    let task_id = event.relatedTarget.parentNode.id;
    let task_input = $('#modal-input')[0];
    task_input.setAttribute('data-id', task_id)
    task_input.value = $('#' + task_id + ' label')[0].innerText;
})

$('#saveEditTask').on('click', function (event) {
    let task_desc = $('textarea')[0].value;
    let task_id = $('textarea')[0].getAttribute('data-id');
    $.ajax({
        url: '/editTask',
        method: 'post',
        dataType: 'json',
        data: {"_token": $('meta[name="csrf-token"]').attr('content'), id: task_id, description: task_desc},
        success: function(data){
            location.reload();
        }
    });
})
