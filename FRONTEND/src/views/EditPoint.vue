<template>
  <div id="app">
    <header>
      <a href="#/Home" v-bind:class="{ notActiveButton: fadeNote }" id="notesBtn">Points </a>
    </header>

    <form class="form">
      <div class="fieldBox"><label class="label">Name : </label> <input v-model="point.name" type="text" placeholder="Type in name" /></div>
      <div class="fieldBox"><label class="label">X : </label> <input v-model="point.x" type="text" placeholder="Type in x" /></div>
      <div class="fieldBox"><label class="label">Y : </label> <input v-model="point.y" type="text" placeholder="Type in y" /></div>

      <br>
      <button class="btnForm" type="button" @click="submit">Edit Point </button>
    </form>

    
    <div v-show="nearpoints.length > 0">
      <br><hr>
      <h3>Nearest Point(s)</h3>
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Name</th>
            <th>X</th>
            <th>Y</th>
          </tr>
        </thead>
        
      <tbody v-if="nearpoints.length > 0">
        <tr v-for="point of nearpoints" :key="point.id">
          <td>{{point.name}}</td>
          <td>{{point.x}}</td>
          <td>{{point.y}}</td>
        </tr>
      </tbody>
      </table>
    </div>

    <div v-show="farpoints.length > 0">
      <br><hr>
      <h3>Farthest Point(s)</h3>
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th>Name</th>
            <th>X</th>
            <th>Y</th>
          </tr>
        </thead>
        
      <tbody v-if="farpoints.length > 0">
        <tr v-for="point of farpoints" :key="point.id">
          <td>{{point.name}}</td>
          <td>{{point.x}}</td>
          <td>{{point.y}}</td>
        </tr>
      </tbody>
      </table>
    </div>
    
  </div>
</template>

<script>
import axios from 'axios';
import store from "../store";

export default {
  name: 'AppPoint',
  components: {
  },
  data() {
    return {
      endpoint: store.state.urlStore.baseUrl + store.state.urlStore.updatePointUrl,
      endpoint2: store.state.urlStore.baseUrl + store.state.urlStore.getPointUrl,
      endpoint3: store.state.urlStore.baseUrl + store.state.urlStore.getPointsUrl,
      errors: [],
      fadeTag: false,
      fadeNote: true,
      objectToSend: {
        id: null,
        name: null,
        x: null,
        y: null
      },
      points: [],
      nearpoints: [],
      farpoints: [],
      point: {
        name: null,
        x: null,
        y: null,
        calculatedPoints: null
      },
      pointAdd: null,
      showErrorIcon: true
    }
  },
  created() {
    let vmObjectInstance = this;

    axios.get(this.endpoint3)
    .then(response => {
      if(response.data.status){
        let returnData = response.data;
        this.points = returnData.data;

        this.points = this.points.filter(point => point.id !=  this.$route.params.pointId);
             
        let calculatedPoints = this.points.map((point) => Math.round(point.x + point.y  * 100) / 100);
        for (let i = 0; i < this.points.length; i++) {
          this.points[i].calculatedPoints = calculatedPoints[i];
        }

        this.nearpoints = this.points.filter(point => this.pointAdd  <= point.calculatedPoints);
        this.farpoints = this.points.filter(point => this.pointAdd >= point.calculatedPoints);

      }
    })
    .catch(e => {
      this.errors.push(e)
    })

    this.getPointUrlCall(vmObjectInstance);
  },
  methods: {
    submit() {
      let vmObjectInstance = this;
      this.objectToSend.id = this.$route.params.pointId;
      this.objectToSend.name = this.point.name;
      this.objectToSend.x = this.point.x;
      this.objectToSend.y = this.point.y;

      if(this.point.name == ""){
        alert("Name is empty");
      }

      if(this.point.x == ""){
        alert("x is empty");
      }

      if(this.point.y == ""){
        alert("Y is empty");
      }

      let config = {
        method: 'POST',
        url: this.endpoint,
        headers: { 
          'Content-Type': 'application/json',
          'Access-Control-Request-Headers': '*'
        },
        data : this.objectToSend
      };

      if(this.point.name != "" && this.point.x != "" && this.point.y != ""){
        this.editPointUrlCall(vmObjectInstance, config);
      }
    
    },
    editPointUrlCall(vmObjectInstance, config){
      axios(config)
      .then(function (response) {
        console.log(JSON.stringify(response.data));
        
        vmObjectInstance.$swal({
          title: "Success",
          text: "Point has been updated!",
          icon: "success",
          button: "Aww yiss!",
        });
      })
      .catch(function (error) {
        console.log(error);
        vmObjectInstance.$swal({
          title: "Failed",
          text: "Point could not be updated",
          icon: "warning",
          button: "Aww yiss!",
        });
      });
    },
    getPointUrlCall(vmObjectInstance){
      axios.get(vmObjectInstance.endpoint2 + "/" + this.$route.params.pointId)
      .then(response => {
        if(response.data.status){
          let returnData = response.data;
          vmObjectInstance.point = returnData.data;
        }
      })
      .catch(e => {
        vmObjectInstance.errors.push(e)
      })
    },
  },
  computed: {
    pointAddition() {
      return Math.round(parseInt(this.point.x) + parseInt(this.point.y) * 100) / 100;
    },
    nearPointAddition() {
      return this.nearpoints;
    },
    farPointAddition() {
      return this.farpoints;
    },
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
