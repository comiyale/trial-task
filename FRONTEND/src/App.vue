<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
export default {
  name: 'App'
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
