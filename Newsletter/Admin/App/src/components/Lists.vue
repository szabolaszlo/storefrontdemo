<template>
  <div>
    <div v-for="subscriber in subscribers" v-bind:key="subscriber.id">
      <span>{{ subscriber.id }} -- </span>
      <router-link :to="'/details/'+subscriber.id " ><span>{{ subscriber.email }}</span></router-link>
    </div>
  </div>
</template>

<script>

export default {
  name: 'Lists',
  data() {
    return {
      subscribers: [],
    };
  },

  methods: {
    async getData() {
      try {
        const response = await this.$http.get(
            "http://localhost:8082/api/subscribers"
        );
        this.subscribers = response.data;
      } catch (error) {
        console.log(error);
      }
    },
  },

  created() {
    this.getData();
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