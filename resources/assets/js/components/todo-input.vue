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
    export default {
        props: ['todo'],
        data() {
            return {
                todoItemText: ''
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
