<template>
  <div id="app">
    <header>
      <a href="#/Home" v-bind:class="{ notActiveButton: fadeNote }" id="notesBtn">Points </a>
      <a href="#/AddTag" v-bind:class="{ notActiveButton: fadeTag }" id="tagsBtn">Tags</a>
    </header>
    <nav>
      <a href="#/AddNote" class="btn">Add Point</a>
    </nav>

    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th>Name</th>
          <th>X</th>
          <th>Y</th>
          <th>Action</th>
        </tr>
      </thead>
    <tbody v-if="points.length > 0">
      <tr v-for="point of points" :key="point.id">
        <td>{{point.name}}</td>
        <td>{{point.x}}</td>
        <td>{{point.y}}</td>
        <td>
          <button>Edit <i class="bi bi-pen-fill"></i></button> | 
          <button @click="deletePoint(point.id)">Delete <i class="bi bi-x-circle"></i></button>
        </td>
      </tr>
    </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';
import store from "../store";

export default {
  name: 'App',
  components: {
  },
  data() {
    return {
      endpoint: store.state.urlStore.baseUrl + store.state.urlStore.getPointsUrl,
      endpoint2: store.state.urlStore.baseUrl + store.state.urlStore.deletePointsUrl,
      points: [],
      errors: [],
      fadeTag: true,
      fadeNote: false
    }
  },
  created() {
    axios.get(this.endpoint)
    .then(response => {
      if(response.data.status){
        let returnData = response.data;
        this.points = returnData.data;
      }
    })
    .catch(e => {
      this.errors.push(e)
    })
  },
  methods: {    
    deletePoint(id){      
      if(confirm("Are you sure you want to delete?")){
        axios.delete(this.endpoint2 + "/" + id)
        .then(response => {
          if(response.status == 200){
            window.location.reload();
          }
        })
        .catch(e => {
          this.errors.push(e)
        })

      }

    }
  }

}
</script>

<style>

.clearfix{
  clear: both;
}

.tagSection{
  margin-bottom: 20px;
  margin-right: 10px;
}

.notActiveButton{
  opacity: 0.5;
}

h2{
  text-transform: capitalize;
}

ul{
  list-style: none;
  margin-top: 3%;
  margin-left: -2%;
}

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /* text-align: center; */
  color: #2c3e50;
  margin-top: 60px;
}

header a{
  margin-right: 30px;
  font-weight: bolder;
  color: #333333;
  font-size: 2em;
  text-decoration: none;
}

nav{
  margin: 20px 0px;
}

.btn{
  border: 1px solid #333333;
  border-radius: 5px;
  color: #333333;
  padding: 12px;
  /* margin-left: -7.5%; */
  text-decoration: none;
}

.btnSmall{
  border: 1px solid #333333;
  border-radius: 5px;
  color: #333333;
  background-color: #c0c0c0;
  padding: 12px;
  /* margin-left: -7.5%; */
  text-decoration: none;
  font-weight: bold;
}
</style>
