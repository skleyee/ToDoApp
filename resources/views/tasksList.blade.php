<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card px-3">
                    <div class="card-body">
                        <h4 class="card-title">Awesome Todo list</h4>
                        <div class="add-items d-flex"> <input id="task_input" type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> <button id="add" class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button> </div>
                        <div class="list-wrapper">
                            <ul id="todo-list" class="d-flex flex-column-reverse todo-list">
                                @foreach ($tasks as $task)
                                    <li id="{{ $task->id }}" class="{{ $task->its_done ? 'completed' : '' }}">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox" {{ $task->its_done ? 'checked' : '' }}> {{ $task->description }} <i class="input-helper"></i></label>
                                        </div> <i class="remove mdi mdi-close-circle-outline"></i> <i data-toggle="modal" data-target="#exampleModal" class="edit fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

