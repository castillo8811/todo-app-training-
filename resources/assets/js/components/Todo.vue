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
    import store from "../store/index"
    import { mapState } from 'vuex';


    export default {
        components: {TodoInput},
        store:store,
        data() {
            return {}
        },
        mounted() {
            this.$store.dispatch('fetch');
        },
        computed: {
            items () {
                return this.$store.state.todos
            }
        },
        methods: {
            addTodo(todoItemText) {
                let text = todoItemText;
                if (text !== '') {
                    this.$store.dispatch('add', text);
                }
            },
            removeTodo(todo) {
                this.$store.dispatch('delete', todo);
            },
            toggleDone(todo) {
                this.$store.dispatch('toggle', todo);
            },
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
