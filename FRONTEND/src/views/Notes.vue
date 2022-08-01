<template>
  <div id="app">
    <header>
      <a href="#/Home" v-bind:class="{ notActiveButton: fadeNote }" id="notesBtn">Notes </a>
      <a href="#/AddTag" v-bind:class="{ notActiveButton: fadeTag }" id="tagsBtn">Tags</a>
    </header>
    <nav>
      <a href="#/AddNote" class="btn">Add Note</a>
    </nav>

    <ul v-if="notes.length > 0">
      <li v-for="note of notes" :key="note.id">
        <h2>{{note.title}}</h2>
        <p>{{note.description}}</p>

        <span class="tagSection" v-for="tag of note.tags" :key="tag.id">
          <a href="#" class="btnSmall">{{tag.tag_name}}</a>
        </span>
        <section class="clearfix"></section>
        <br>
        <hr>
      </li>
    </ul>
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
      endpoint: store.state.urlStore.baseUrl + store.state.urlStore.getNotesUrl,
      notes: [],
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
        this.notes = returnData.data;
      }
    })
    .catch(e => {
      this.errors.push(e)
    })
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
