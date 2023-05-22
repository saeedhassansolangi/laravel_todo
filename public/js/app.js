async function onTodoComplete(e) {
    const todoId = e.target.getAttribute("aria-todo-id");
    const response = await fetch("/todos/update_status/", {
        method: "POST",
        body: JSON.stringify({
            id: todoId,
            isCompleted: true,
        }),
    });
    console.log(response);
}

console.log("hello yaar");

function handleClick(e) {
    // console.log(e);
    const todoId = e.target.getAttribute("aria-todo-id");

    const isChecked = e.target.checked;
    const el = document.querySelector(".todos");

    // 'todo-complete' => !!$todo->is_task_complete,
    // 'todo-uncomplete' => !$todo->is_task_complete,

    const formData = new FormData();
    formData.append("id", todoId);
    formData.append("isCompleted", isChecked);

    fetch("/todos/update_status/", {
        method: "POST",
        headers: {
            "Content-Type":
                "multipart/form-data;boundary=" + Math.random() * 10000,
        },
        body: new URLSearchParams(formData),
    })
        .then((response) => response.json())
        .then((data) => {
            if (isChecked && !el.classList.contains("todo-complete")) {
                el.classList.add("todo-complete");
            } else {
                el.classList.remove("todo-complete");
            }
        })
        .catch((err) => {
            console.log(err);
        });
}
