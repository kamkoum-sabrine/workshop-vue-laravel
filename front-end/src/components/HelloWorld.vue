<template>
  <div class="container">
    <form @submit.prevent="AjouterToDo">
      <div class="form-group">
        <label class="float-left">Titre</label>
        <input
          type="text"
          class="form-control"
          v-model="title"
          placeholder="Entrer un titre"
        />
      </div>
      <div class="form-group">
        <label>Description</label>
        <input
          type="text"
          class="form-control"
          v-model="description"
          placeholder="Entrer une description"
        />
      </div>
      <div class="form-group">
        <label>Priorité</label>
        <input
          type="number"
          class="form-control"
          v-model="priority"
          placeholder="Entrer la priorité"
        />
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br />
    <br />
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Titre</th>
          <th scope="col">Description</th>
          <th scope="col">Priorité</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="todo in todos" :key="todo.id">
          <th scope="row">{{ todo.id }}</th>
          <td>{{ todo.title }}</td>
          <td>{{ todo.description }}</td>
          <td>{{ todo.priority }}</td>
          <td>
            <button class="btn btn-warning" @click="editerToDo(todo.id)">
              Editer</button
            ><button class="btn btn-danger" @click="supprimerToDo(todo.id)">
              Supprimer
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "HelloWorld",
  data() {
    return {
      title: "",
      description: "",
      priority: null,
      todos: {},
      todo: {},
    };
  },
  created() {
    axios.get(" http://localhost:8000/api/todo/read").then((response) => {
      this.todos = response.data.data;
    });
  },
  methods: {
    AjouterToDo() {
      console.log("Ajouter");
      this.todo = {
        title: this.title,
        description: this.description,
        priority: this.priority,
      };
      axios
        .post("http://localhost:8000/api/todo/create", this.todo)
        .then((response) => {
          console.log(response);
          axios.get(" http://localhost:8000/api/todo/read").then((response) => {
            this.todos = response.data.data;
          });
        });
    },
    supprimerToDo(id) {
      axios.delete(" http://localhost:8000/api/todo/delete/" + id).then(() => {
        axios.get(" http://localhost:8000/api/todo/read").then((response) => {
          this.todos = response.data.data;
        });
      });
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
