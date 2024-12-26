<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>

    <style>
        
.board {
  width: 100%;
  height: 100vh;
  overflow: scroll;

}

/* ---- FORM ---- */
#todo-form {
  padding: 32px 32px 0;
}

#todo-form input {
  padding: 12px;
  margin-right: 12px;
  width: 225px;

  border-radius: 4px;
  border: none;

  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
  background: white;

  font-size: 14px;
  outline: none;
}

#todo-form button {
  padding: 12px 32px;

  border-radius: 4px;
  border: none;

  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
  background: #ffffff;
  color: black;

  font-weight: bold;
  font-size: 14px;
  cursor: pointer;
}

/* ---- BOARD ---- */
.lanes {
  display: flex;
  align-items: flex-start;
  justify-content: start;
  gap: 16px;

  padding: 24px 32px;

  overflow: scroll;
  height: 100%;
}

.heading {
  font-size: 22px;
  font-weight: bold;
  margin-bottom: 8px;
}

.swim-lane {
  display: flex;
  flex-direction: column;
  gap: 12px;

  background: #f4f4f4;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);

  padding: 12px;
  border-radius: 4px;
  width: 225px;
  min-height: 120px;

  flex-shrink: 0;
}

.task {
  background: white;
  color: black;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);

  padding: 12px;
  border-radius: 4px;

  font-size: 16px;
  cursor: move;
}

.is-dragging {
  scale: 1.05;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
  background: rgb(50, 50, 50);
  color: white;
}
    </style>

    <div class="container-xl ">
     

      
        <div class="board">
      <div id="todo-form">
      <a href="#" class="btn" data-bs-toggle="modal" data-bs-target="#modal">
                    Add new task
                </a>
      </div>

      <div class="lanes">
        <div class="swim-lane" id="todo-lane">
          <h3 class="heading">PENDING</h3>
            @foreach($pendings as $pending)
            <p class="task" draggable="true">Task:{{ $pending->title}}<br/>Description: {{ $pending->description}}<br/>Assigned to: {{ $pending->name}}</br>
            <a class="btn btn-info btn-sm" href="{{ asset('storage/' . $pending->file) }}" data-lightbox="{{ $pending->pending }}">View File</a></p>
            @endforeach

        </div>

        <div class="swim-lane">
          <h3 class="heading">ONGOING</h3>

          @foreach($ongoings as $ongoing)
            <p class="task" draggable="true">Task:{{ $pending->title}}<br/>Description: {{ $pending->description}}<br/>Assigned to: {{ $pending->name}}</br>
            <a class="btn btn-info btn-sm" href="{{ asset('storage/' . $pending->file) }}" data-lightbox="{{ $pending->pending }}">View File</a></p>
            @endforeach
        </div>

        <div class="swim-lane">
          <h3 class="heading">DONE</h3>

          @foreach($dones as $done)
            <p class="task" draggable="true">Task:{{ $pending->title}}<br/>Description: {{ $pending->description}}<br/>Assigned to: {{ $pending->name}}</br>
            <a class="btn btn-info btn-sm" href="{{ asset('storage/' . $pending->file) }}" data-lightbox="{{ $pending->pending }}">View File</a></p>
            @endforeach
        </div>
      </div>
    </div>
    </div>
</x-app-layout>

<div class="modal modal-blur fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('task.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
              
                    <div class="row">
                        <!-- First Column -->
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label for="title">TITLE:</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">DESCRIPTION:</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="form-group mb-3">
                                <label for="file">FILE:</label>
                                <input type="file" name="file" id="file" accept="image/*"
                               >
                            </div>
                            <div class="mb-3">

                                <label class="form-label">Assign to</label>
                                <select class="form-control" name="user_id" id="user_id" required>
                                    <option value="" disabled selected>Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                
                     

                            <div class="mb-3">
                            <label class="form-label">STATUS</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="pending"  selected>PENDING</option>
                                <option value="ongoing">ONGOING</option>
                                <option value="done">DONE</option>
                            </select>
                    </div>
                        </div>

                      
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary ms-auto">
                        Add new task
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



<script>
    const form = document.getElementById("todo-form");
const input = document.getElementById("todo-input");
const todoLane = document.getElementById("todo-lane");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const value = input.value;

  if (!value) return;

  const newTask = document.createElement("p");
  newTask.classList.add("task");
  newTask.setAttribute("draggable", "true");
  newTask.innerText = value;

  newTask.addEventListener("dragstart", () => {
    newTask.classList.add("is-dragging");
  });

  newTask.addEventListener("dragend", () => {
    newTask.classList.remove("is-dragging");
  });

  todoLane.appendChild(newTask);

  input.value = "";
});

const draggables = document.querySelectorAll(".task");
const droppables = document.querySelectorAll(".swim-lane");

draggables.forEach((task) => {
  task.addEventListener("dragstart", () => {
    task.classList.add("is-dragging");
  });
  task.addEventListener("dragend", () => {
    task.classList.remove("is-dragging");
  });
});

droppables.forEach((zone) => {
  zone.addEventListener("dragover", (e) => {
    e.preventDefault();

    const bottomTask = insertAboveTask(zone, e.clientY);
    const curTask = document.querySelector(".is-dragging");

    if (!bottomTask) {
      zone.appendChild(curTask);
    } else {
      zone.insertBefore(curTask, bottomTask);
    }
  });
});

const insertAboveTask = (zone, mouseY) => {
  const els = zone.querySelectorAll(".task:not(.is-dragging)");

  let closestTask = null;
  let closestOffset = Number.NEGATIVE_INFINITY;

  els.forEach((task) => {
    const { top } = task.getBoundingClientRect();

    const offset = mouseY - top;

    if (offset < 0 && offset > closestOffset) {
      closestOffset = offset;
      closestTask = task;
    }
  });

  return closestTask;
};


</script>