<template>
    <tr>
        <td class="is-fullwidth" style="cursor: pointer" :class="{ 'is-done': todo.done }"
            @click="toggleDone(todo)">
            {{ todo.text }}
            {{ todo.text }}
        </td>
        <td class="is-narrow">
            <a class="button is-danger is-small" @click="remove(todo)">Eliminar</a>
        </td>
    </tr>
</template>

<script>
    export default {
        props: ['todo'],
        methods: {
            remove(todo) {
                this.$emit('remove', todo)
            },
            toggleDone(todo) {
                this.$emit('toogle', todo)
            }
        }
    }
</script>

<style>
    .is-done {
        text-decoration: line-through;
    }
</style>
