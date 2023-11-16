//IIFE for that the variables can't exists in other js archives
(function () {

    //We get all tasks that our project haves
    getTasks();
    let tasks = [];
    let filtered = [];

    //Button for show window to add task
    const newTaskBtn = document.querySelector("#add-task");
    newTaskBtn.addEventListener("click", function(){
        showForm();
    });

    async function getTasks() {
        try {
            const id = getProject();
            const url = `/api/tasks?id=${id}`;
            const answer = await fetch(url);
            const result = await answer.json();

            tasks = result.tasks;
            showTasks();

        } catch (error) {
            console.log(error);
        }
    }

    //Search filters
    const filters = document.querySelectorAll("#filters input[type='radio']")
    filters.forEach(radio =>{
        radio.addEventListener("input", filterTasks);
    })

    function filterTasks(e){
        const filter = e.target.value;

        if(filter !== ''){
            filtered = tasks.filter(task => task.state === filter);
        } else{
            filtered = [];
        }

        showTasks();
    }

    function showTasks() {
        taskCleaner();
        totalPendings();
        totalCompleted();

        const tasksArray = filtered.length ? filtered : tasks;

        if (tasksArray.length === 0) {
            const tasksContainer = document.querySelector("#task-list");
            const noTaskText = document.createElement("LI");
            noTaskText.textContent = "Todavía no has añadido ninguna tarea al proyecto actual.";
            noTaskText.classList.add("no-tasks");

            tasksContainer.appendChild(noTaskText);
            return;
        }

        const states = {
            0: "Pendiente",
            1: "Terminada"
        };

        tasksArray.forEach(task => {
            const taskContainer = document.createElement("LI");
            taskContainer.dataset.taskId = task.id;
            taskContainer.classList.add("task");

            const textDiv = document.createElement("DIV");
            textDiv.classList.add("text");

            const taskName = document.createElement("P");
            taskName.textContent = task.name;

            const editBtn = document.createElement("IMG");
            editBtn.src = "build/img/edit.svg"
            editBtn.onclick = function(){
                showForm(true, {...task});
            }

            const optionsDiv = document.createElement("DIV");
            optionsDiv.classList.add("options");

            //Buttons
            const btnTaskState = document.createElement("BUTTON");
            btnTaskState.classList.add("task-state");
            btnTaskState.classList.add(`${states[task.state].toLowerCase()}`);
            btnTaskState.textContent = states[task.state];
            btnTaskState.dataset.taskState = task.state;
            btnTaskState.style.cursor = "default"

            const btnTaskRemove = document.createElement("BUTTON");
            btnTaskRemove.classList.add("task-remove");
            btnTaskRemove.dataset.taskId = task.id;
            btnTaskRemove.textContent = "Eliminar";
            btnTaskRemove.onclick = function (){
                confirmRemoveTask({ ...task });
            }

            const changeBtn = document.createElement("IMG");
            changeBtn.src = "Pendiente" === states[task.state] ? 'build/img/pending.png' : 'build/img/completed.png';
            changeBtn.onclick = function () {
                changeTaskState({ ...task }); //We send a copy of task for that it don't modify the original array
            }

            const divImg = document.createElement("DIV");
            divImg.classList.add("div-img");

            divImg.appendChild(changeBtn);

            optionsDiv.appendChild(divImg);
            optionsDiv.appendChild(btnTaskState);
            optionsDiv.appendChild(btnTaskRemove);

            textDiv.appendChild(taskName);
            textDiv.appendChild(editBtn);

            taskContainer.appendChild(textDiv);
            taskContainer.appendChild(optionsDiv);

            const taskList = document.querySelector("#task-list");
            taskList.appendChild(taskContainer);
        })
    }

    function totalPendings(){
        const totalPendings = tasks.filter(task => task.state === "0");
        const pendingsRadio = document.querySelector("#pending");

        if(totalPendings.length === 0){
            pendingsRadio.disabled = true;
        } else{
            pendingsRadio.disabled = false;
        }
    }

    function totalCompleted(){
        const totalCompleted = tasks.filter(task => task.state === "1");
        const completedRadio = document.querySelector("#completed");

        if(totalCompleted.length === 0){
            completedRadio.disabled = true;
        } else{
            completedRadio.disabled = false;
        }
    }

    function showForm(modify = false, task = "") {
        const window = document.createElement("DIV");
        window.classList.add("window");
        window.innerHTML = `
            <form class='form new-task'>
                <legend>${modify ? "Editar tarea" : "Añadir nueva tarea"}</legend>
                <div class='field'>
                    <label for="task">Tarea</label>
                    <input type='text' name='task' placeholder="${task.name ? "Editar la tarea actual" : "Añadir una tarea a este proyecto"}" id='task' value="${task.name ? task.name : ""}">
                </div>
                <div class="options">
                    <input type="submit" class="submit-new-task" value="${task.name ? "Guardar cambios" : "Añadir tarea"}">
                        <button type="button" class="close-window">Cancelar</button>
                </div>
            </form>`;

        setTimeout(() => {
            const form = document.querySelector(".form");
            form.classList.add("animate");
        }, 0);

        window.addEventListener("click", function (e) {
            e.preventDefault(); //For prevent that the input type submit send data

            //Select close button and we add the close function
            if (e.target.classList.contains("close-window") || e.target.classList.contains("window")) {
                const form = document.querySelector(".form");
                form.classList.add("close");
                setTimeout(() => {
                    window.remove();
                }, 500);
            }

            if (e.target.classList.contains("submit-new-task")) {

                const taskName = document.querySelector("#task").value.trim();

                if (taskName === "" || taskName.length >= 60) {
                    //Show error alert
                    showAlert("Nombre de la tarea inválido", "error", document.querySelector(".form legend"));
                    return; //for stop the next code
                }

                if(modify){
                    //We rewrite the name of task
                    task.name = taskName;
                    updateTask(task);
                } else{
                    addTask(taskName);
                }
                
            }
        })

        document.querySelector('.dashboard').appendChild(window);
    }

    //Show a message on the interface
    function showAlert(message, type, reference) {
        //Prevent create much alerts
        const previousAlert = document.querySelector(".alert");
        if (previousAlert) {
            previousAlert.remove();
        }

        const alert = document.createElement("DIV");
        alert.classList.add("alert", type);
        alert.textContent = message;

        //For insert the alert before the legend
        reference.parentElement.insertBefore(alert, reference.nextElementSibling);

        //Remove alert after 5 seconds
        setTimeout(() => {
            alert.remove();
        }, 5000);
    }

    //Check the server for add a new task to actual project
    async function addTask(task) {

        //Build a request
        const data = new FormData();
        data.append('name', task);
        data.append('projectId', getProject());

        try {
            const url = '/api/tasks';
            const answer = await fetch(url, {
                method: "POST",
                body: data
            });

            const result = await answer.json();

            if (result.type === "exito") {
                Swal.fire("Tarea agregada correctamente", result.message, "success")
                const window = document.querySelector(".window");
                setTimeout(() => {
                    window.remove();
                }, 500);

                //We add object task to global array
                const taskObj = {
                    id: String(result.id),
                    name: task,
                    state: '0',
                    projectId: result.projectId
                }

                tasks = [...tasks, taskObj] //We copy the global array and add the last one element
                showTasks();
            }

        } catch (error) {
            console.log("error");
        }
    }

    function changeTaskState(task) {
        const newState = task.state === "1" ? "0" : "1";
        task.state = newState;
        updateTask(task);
    }

    async function updateTask(task) {
        const { state, id, name } = task;
        const data = new FormData();
        data.append("id", id);
        data.append("name", name);
        data.append("state", state);
        data.append("projectId", getProject());

        try {
            const url = '/api/tasks/update';
            const answer = await fetch(url, {
                method: "POST",
                body: data
            });
            const result = await answer.json();
            
            if(result.type === "exito"){
                Swal.fire(result.message, result.message, "success");

                const window = document.querySelector(".window");

                if(window){
                    window.remove();
                }
                
               
                tasks = tasks.map(taskMemory => {
                    if(taskMemory.id === id){
                        taskMemory.state = state;
                        taskMemory.name = name;
                    }

                    return taskMemory;
                });

                showTasks();
            }

        } catch (error) {
            console.log(error)
        }

        //for(let value of data.values()){
        //   console.log(value);
        //}
    }

    function confirmRemoveTask(task){
        Swal.fire({
            title: '¿Estás seguro de que quieres eliminar esta tarea?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, estoy seguro',
            cancelButtonText: 'No'
          }).then((result) => {
            
            if (result.isConfirmed) {
              removeTask(task);
            }
          })
    }

    async function removeTask(task){

        const { state, id, name } = task;

        const data = new FormData();
        data.append("id", id);
        data.append("name", name);
        data.append("state", state);
        data.append("projectId", getProject());

        try {

            const url = "/api/tasks/remove";
            const answer = await fetch(url, {
                method: "POST",
                body: data
            });
            const result = await answer.json();
            if(result.result){
                //showAlert(result.message, result.type, document.querySelector(".container-new-task"));

                Swal.fire("Eliminada", result.message, "success")
            }

            tasks = tasks.filter(taskMemory => taskMemory.id !== task.id); //Clean the task that we remove it
            showTasks();

        } catch (error) {
            console.log(error);
        }
    }

    function getProject() {
        //For read the params that the URL haves (id)
        const projectParams = new URLSearchParams(window.location.search);
        const project = Object.fromEntries(projectParams.entries());
        return project.id;
    }

    function taskCleaner() {
        const taskList = document.querySelector(".task-list");
        while (taskList.firstChild) {
            taskList.removeChild(taskList.firstChild)
        }
    }
})();
