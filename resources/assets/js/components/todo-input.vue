<template>
    <div class="box">
        <div class="field is-grouped">
            <p class="control is-expanded">
                <input class="input" type="text" placeholder="Nuevo recordatorio" v-model="todoItemText">
            </p>
            <p class="control">
                <a class="button is-info" @click="add">
                    Agregar
                </a>
            </p>
        </div>
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
        props: ['todo'],
        data() {
            return {
                todoItemText:''
            }
        },
        methods: {
            add() {
                this.$emit('add', this.todoItemText)
            },
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
