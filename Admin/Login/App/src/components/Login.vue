<template>
  <div class="auth-page">
    <div class="container page">
      <div class="row">
        <div class="col-md-6 offset-md-3 col-xs-12">
          <h1 class="text-xs-center">Sign in</h1>
          <form @submit.prevent="onSubmit(user, password)">
            <fieldset class="form-group">
              <input
                  class="form-control form-control-lg"
                  type="text"
                  v-model="user"
                  placeholder="User"
              />
            </fieldset>
            <fieldset class="form-group">
              <input
                  class="form-control form-control-lg"
                  type="password"
                  v-model="password"
                  placeholder="Password"
              />
            </fieldset>
            <button class="btn btn-lg btn-primary pull-xs-right">Sign in</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { auth$, login } from "admin-auth";
export default {
  name: 'loginView',
  data() {
    return {
      user: null,
      password: null,
    };
  },
  methods: {
    onSubmit(user, password) {
      login(user, password);
    },
  },
};
</script>