<template>
    <div class="container">
        <todo-input v-on:add="addTodo"></todo-input>
        <table class="table is-bordered">
            <todo-item v-for="(todo, index) in items" v-bind:todo="todo"
                       v-on:remove="removeTodo"
                       v-on:toogle="toggleDone"
                       :key="index">
            </todo-item>
        </table>
    </div>
</template>

<script>
    import TodoInput from "./todo-input";

    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */
    export default {
        components: {TodoInput},
        data() {
            return {
                items: [],
                errors:[],
            }
        },
        mounted() {
            axios.get('api/todos').then((res) => {
                this.items = res.data.data;
            }).catch(error => {
                console.log(error.response);
                if (error.response.status==500) {
                    alert(error.response.statusText);
                }else{
                    alert(error.response.data.message);
                }
            });
        },
        methods: {
            addTodo(todoItemText) {
                let text = todoItemText;
                if (text !== '') {
                    axios.post('/api/todos', {
                        text: text
                    }).then((res) => {
                        if(res) {
                            this.items.push({text: text, done: false});
                            this.todoItemText = '';
                        }
                    }).catch(error => {
                        console.log(error.response);
                        if (error.response.status==500) {
                            alert(error.response.statusText);
                        }else{
                            alert(error.response.data.message);
                        }

                    });
                }
            },
            removeTodo(todo) {
                axios.delete('api/todos/'+todo.id).then((res) => {
                    this.items = this.items.filter(
                        item => item !== todo
                    )
                }).catch(error => {
                    console.log(error.response);
                    if (error.response.status==500) {
                        alert(error.response.statusText);
                    }else{
                        alert(error.response.data.message);
                    }

                });
            },
            toggleDone(todo) {
                axios.put('/api/todos/'+todo.id, {
                    text: todo.text,
                    done: !todo.done
                }).then((res) => {
                    if(res) {
                        todo.done = !todo.done
                    }
                }).catch(error => {
                    console.log(error.response);
                    if (error.response.status==500) {
                        alert(error.response.statusText);
                    }else{
                        alert(error.response.data.message);
                    }

                });

            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
