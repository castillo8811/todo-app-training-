import {addTodo, toggleTodo, removeTodo, getTodos} from './types'

export default {
  [addTodo.type] (context, payload) {
    context.commit(addTodo.type, {
      text: payload,
      done: false
    })
  },

  [toggleTodo.type] (context, todo) {
    context.commit(toggleTodo.type, todo)
  },

  [removeTodo.type] (context, todo) {
    context.commit(removeTodo.type, todo)
  },

  [getFromStorage.type] (context, todo) {
    context.commit(getTodos.type, ls.fetch())
  },

  [saveToStorage.type] (context, todo) {
    context.commit(saveToStorage.type)
  }
}
