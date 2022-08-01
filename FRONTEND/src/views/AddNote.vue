<template>
  <div id="app">
    <header>
      <a href="#/Home" v-bind:class="{ notActiveButton: fadeNote }" id="notesBtn">Notes </a>
      <a href="#" v-bind:class="{ notActiveButton: fadeTag }" id="tagsBtn">Tags</a>
    </header>

    <form class="form">
      <div class="fieldBox"><label class="label">Title : </label> <input v-model="title" type="text" placeholder="Type in title" /></div>
      <div class="fieldBox"><label class="label">Description : </label> <input v-model="description" type="text" placeholder="Type in title" /></div>


      <div v-if="tags.length > 0">
        <span v-for="tag of tags" :key="tag.id">
          <input type="checkbox" v-model="noteTags" :value="tag.id"> {{tag.name}}<br>
        </span>
      </div>

      <br>
      <button class="btnForm" type="button" @click="submit">Add Tag </button>
    </form>

  </div>
</template>

<script>
import axios from 'axios';
import store from "../store";

export default {
  name: 'AppTag',
  components: {
  },
  data() {
    return {
      endpoint: store.state.urlStore.baseUrl + store.state.urlStore.createNoteUrl,
      endpoint2: store.state.urlStore.baseUrl + store.state.urlStore.getTagsUrl,
      errors: [],
      fadeTag: false,
      fadeNote: true,
      tags: [],
      objectToSend: {
        title: null,
        description: null,
        status: null,
        tags: null
      },
      title: "",
      description: "",
      noteTags: [],
      tag: "",
      showErrorIcon: true
    }
  },
  created() {
    let vmObjectInstance = this;
    this.getTagsUrlCall(vmObjectInstance);
  },
  methods: {
    submit() {
      let vmObjectInstance = this;
      this.objectToSend.title = this.title;
      this.objectToSend.description = this.description;
      this.objectToSend.tags = this.noteTags;
      this.objectToSend.status = "ACTIVE";

      let config = {
        method: 'POST',
        url: this.endpoint,
        headers: { 
          'Content-Type': 'application/json',
          'Access-Control-Request-Headers': '*'
        },
        data : this.objectToSend
      };

      this.addNoteUrlCall(vmObjectInstance, config);
    
    },
    getTagsUrlCall(vmObjectInstance){
      axios.get(vmObjectInstance.endpoint2)
      .then(response => {
        if(response.data.status){
          let returnData = response.data;
          vmObjectInstance.tags = returnData.data;
        }
      })
      .catch(e => {
        vmObjectInstance.errors.push(e)
      })
    },
    addNoteUrlCall(vmObjectInstance, config){
      axios(config)
      .then(function (response) {
        console.log(JSON.stringify(response.data));
        
        vmObjectInstance.$swal({
          title: "Success",
          text: "Note has been created!",
          icon: "success",
          button: "Aww yiss!",
        });
      })
      .catch(function (error) {
        console.log(error);
        vmObjectInstance.$swal({
          title: "Failed",
          text: "Note could not be created",
          icon: "warning",
          button: "Aww yiss!",
        });
      });
    }
  }

}
</script>

<style>

.form{
  margin-top: 20px;
}

.btnForm{
  border: 1px solid #333333;
  margin-left: 10px;
}


.label{
  display: block;
  width: 100px;
  float:left;
}

.fieldBox{
  margin-bottom: 20px;
}

</style>
