<template>
  <div id="app">
    <header>
      <a href="#/Home" v-bind:class="{ notActiveButton: fadeNote }" id="notesBtn">Notes </a>
      <a href="#" v-bind:class="{ notActiveButton: fadeTag }" id="tagsBtn">Tags</a>
    </header>

    <form class="form">
      <input v-model="tag" type="text" placeholder="Type in tag name" />
      <button class="btnForm" type="button" @click="submit">Add Tag </button>
    </form>

    <hr>


    <ul v-if="tags.length > 0">
      <li v-for="tag of tags" :key="tag.id">
        <h3 style="float:left;display:block;text-transform:capitalize">{{tag.name}}</h3> <a @click="deleteTag(tag.id)" style="float:left;margin-left: 15px;margin-top: 20px;color: #ff0000;" href="#">Delete</a>          
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
  name: 'AppTag',
  components: {
  },
  data() {
    return {
      endpoint: store.state.urlStore.baseUrl + store.state.urlStore.createTagUrl,
      endpoint2: store.state.urlStore.baseUrl + store.state.urlStore.getTagsUrl,
      endpoint3: store.state.urlStore.baseUrl + store.state.urlStore.deleteTagUrl,
      errors: [],
      fadeTag: false,
      fadeNote: true,
      tags: [],
      objectToSend: {
        name: null,
        status: null
      },
      objectToSend2:{

      },
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
      this.objectToSend.name = this.tag;
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

      this.addTagUrlCall(vmObjectInstance, config);
    
    },
    deleteTag(id){
      let confirmation = confirm("You want to delete tag?");
      if(confirmation){
        let vmObjectInstance = this;
        this.deleteTagUrlCall(vmObjectInstance,id);
      }
    },
    addTagUrlCall(vmObjectInstance,config) {
      axios(config)
      .then(function (response) {
        console.log(JSON.stringify(response.data));
        
        vmObjectInstance.$swal({
          title: "Success",
          text: "Tag has been created!",
          icon: "success",
          button: "Aww yiss!",
        });
      })
      .catch(function (error) {
        console.log(error);
        vmObjectInstance.$swal({
          title: "Failed",
          text: "Tag could not be created",
          icon: "warning",
          button: "Aww yiss!",
        });
      });
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
    deleteTagUrlCall(vmObjectInstance,id){
    axios.get(`${vmObjectInstance.endpoint3}/${id}`)
      .then(response => {
        if(response.status == 200){
          vmObjectInstance.getTagsUrlCall(vmObjectInstance);
        }
      })
      .catch(e => {
        vmObjectInstance.errors.push(e)
      })
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


</style>
