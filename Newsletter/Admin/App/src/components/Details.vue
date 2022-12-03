<template>
  <div>
    <p id="links">
      <router-link to="/">List</router-link>
    </p>
    <p>
      ID: {{ subscriber.id }} <br/>
      Name: {{ subscriber.firstname }} {{ subscriber.lastname }} <br/>
      Email: {{ subscriber.email }} <br/>
      CustomerID: {{ subscriber.customerId }} <br/>
    </p>
  </div>
</template>

<script>
export default {
  name: 'Details',
  data() {
    return {
      subscriber: null,
    };
  },

  methods: {
    getData(id) {
      this.$http.get(
          "http://localhost:8082/api/subscribers/"+id
      )
          .then(response => {
            this.subscriber = response.data;
            console.log(response.data);
          })
          .catch(e => {
            console.log(e);
          });
    },
  },

  created() {
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