<template>
  <div>
    <div v-for="customer in customers" v-bind:key="customer.id">
      <span>{{ customer.id }} -- </span>
      <router-link :to="'/customers/details/'+customer.id " ><span>{{ customer.email }}</span></router-link>
    </div>
  </div>
</template>

<script>

export default {
  data() {
    return {
      customers: [],
    };
  },

  methods: {
    async getData() {
      try {
        const response = await this.$http.get(
            "http://localhost:8081/api/customers"
        );
        this.customers = response.data;
      } catch (error) {
        console.log(error);
      }
    },
  },

  beforeMount() {
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