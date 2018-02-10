import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        todos: [],
    },
    mutations: {
        FETCH(state, todos) {
            state.todos = todos;
        },
        DELETE(state, todo) {
            var todos = state.todos
            todos.splice(todos.indexOf(todo), 1)
        },
        ADD(state, todo) {
            var todos = state.todos
            todos.push(todo)
        },
        TOGGLE(state, todo) {
            todo.done = !todo.done
        }
    },
    actions: {
        fetch({commit}) {
            return axios.get('api/todos')
                .then(response => commit('FETCH', response.data.data))
                .catch();
        },
        delete({commit}, todo) {
            axios.delete('/api/todos/' + todo.id)
                .then(() => commit('DELETE', todo))
                .catch();
        },
        add({commit}, text) {
            axios.post('api/todos', {
                'text': text,
                'done': false,
            }).then(() => commit('ADD', {
                'text': text,
                'done': false,
            }));
        },
        toggle({commit}, todo) {
            axios.put('api/todos/' + todo.id, {
                'text': todo.text,
                'done': !todo.done,
            }).then(() => commit('TOGGLE', todo));
        }
    }
});

export default store;