<template>
  <div id="vue-app">
    <div id="vue-component" class="container">
      <div class="main">
        <h1><img src="https://vuejs.org/images/logo.png" width="50" height="50"> Vue Newsletter Subscribers</h1>
        <hr>
        <router-view></router-view>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'admin-panel',
  components: {},
};
</script>