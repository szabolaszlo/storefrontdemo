<template>
  <div>
    <nav class="navbar-links">
      <div>
        <ul>
          <li>
            <router-link
                to="/"
                class="nav-link"
                active-class="active-nav-link"
            >Home</router-link
            >
          </li>
          <li>
            <router-link
                to="/customers"
                class="nav-link"
                active-class="active-nav-link"
            >Customers</router-link>
          </li>
          <li>
            <router-link
                to="/subscribers"
                class="nav-link"
                active-class="active-nav-link"
            >Subscribers</router-link>
          </li>
          <li>
            <a href="#" class="nav-link"  @click="Logout"> Logout </a>
          </li>
        </ul>
      </div>
    </nav>
    <router-view />
  </div>
</template>

<script>
import { logout } from "admin-auth";
export default {
  props: {

  },
  methods: {
    Logout: function() {
      logout()
    }
  }
};
</script>

