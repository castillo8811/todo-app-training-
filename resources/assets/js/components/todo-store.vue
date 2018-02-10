<script>
    export new Vuex.Store({
            state: {
                todos: [
                    {
                        task: 'Code',
                        completed: true,
                        id: uuid.v4()
                    },
                    {
                        task: 'Sleep',
                        completed: false,
                        id: uuid.v4()
                    },
                    {
                        task: 'Eat',
                        completed: false,
                        id: uuid.v4()
                    }
                ]
            },
            getters: {
                todos: state => state.todos
            },
            mutations: {
                addTodo: (state, payload) => {
                    const task = {
                        task: payload,
                        completed: false,
                        id: uuid.v4()
                    }
                    console.log(state)
                    state.todos.unshift(task);
                },
                toggleTodo: (state, payload) => {
                    state.todos = state.todos.map(t => {
                        if(t.id === payload) {
                            return {task: t.task, completed: !t.completed, id: t.id}
                        }
                        return t;
                    })
                },
                deleteTodo: (state, payload) => {
                    const index = state.todos.findIndex(t => t.id === payload);
                    state.todos.splice(index, 1)
                    console.log(index)
                }
            }
        });
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
