<template>
  <div>
    <p id="links">
      <router-link to="/customers">List</router-link>
    </p>
    <p>
      ID: {{ customer.id }} <br/>
      Name: {{ customer.firstname }} {{ customer.lastname }} <br/>
      Email: {{ customer.email }} <br/>
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      customer:{
        id:'',
        firstname:'',
        lastname:'',
        email:'',
      },
    };
  },

  methods: {
    getData(id) {
      this.$http.get(
          "http://localhost:8090/customer/api/customers/"+id
      )
          .then(response => {
            this.customer = response.data;
          })
          .catch(e => {
            console.log(e);
          });
    },
  },

  mounted() {
    this.getData(this.$route.params.id);
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