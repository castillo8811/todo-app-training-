<template>
    <div class="container">
        <div class="box">
            <div class="field is-grouped">
                <p class="control is-expanded">
                    <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="todoItemText">
                </p>
                <p class="control">
                    <a class="button is-info" @click="addTodo">
                        Agregar
                    </a>
                </p>
            </div>
        </div>
        <table class="table is-bordered">
            <tr v-for="(todo, index) in items" :key="index">
                <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': todo.done }"
                    @click="toggleDone(todo)">
                    {{ todo.text }}
                </td>
                <td class="is-narrow">
                    <a class="button is-danger is-small" @click="removeTodo(todo)">Eliminar</a>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    /**
     * Tips:
     * - En mounted pueden obtener el listado del backend de todos y dentro de la promesa de axios asirnarlo
     *   al arreglo que debe tener una estructura similar a los datos de ejemplo.
     * - En addTodo, removeTodo y toggleTodo deben hacer los cambios pertinentes para que las modificaciones,
     *   addiciones o elimicaiones tomen efecto en el backend asi como la base de datos.
     */
    export default {
        data() {
            return {
                todoItemText: '',
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
            addTodo() {
                let text = this.todoItemText.trim()
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
