<template>
  <div class="mb-6 ">
    <!-- <div class="btn-warnaku white--text">
      <div class="btn-warnaku white--text">
        <div class="py-1 font-weight-regular">
          <button class=" ml-4" type="submit" @click="kontak">
            <v-icon color="white">mdi-phone</v-icon>
            +62-815-6315-10389
          </button>
        </div>
      </div>
      </div> -->
    <div class="container">
     <div class="d-flex align-center justify-space-between">
      <div class="d-flex">
            <v-img :src="require('~/assets/logo_nganu.png')" :max-width="$vuetify.breakpoint.smAndDown?'20':'30'"></v-img>
            <div :class="['font-weight-bold', $vuetify.breakpoint.smAndDown?'ml-2':'ml-4 text-h6']">Toko nganu</div>
          </div>
          <v-btn v-if="!$store.state.users.authenticated && $route.path !=='/login'"
          class="text-capitalize px-8 text-body-1 font-weight-medium rounded-lg white--text"
          color="#2f432d"
          to="/login"
          >Login</v-btn
        >
     </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      no_admin: "6281563151038",
    };
  },
  methods: {
    kontak() {
      let nomer = this.no_admin;
      window.open("https://wa.me/" + nomer);
    },
  },
};
</script>

<style scoped>
.html {
  background-color: #fff;
  overflow: hidden;
}
/*
.contact-text {
  display: flex;
  font-size: 16px;
  line-height: 24px;
}
.contact-text .icon_telepon {
  margin-right: 11px;
  margin-top: 3px;
}
.nav {
  padding: 39px 123px 10px 123px;
  display: flex;
}
.logo {
  width: 43px;
  height: auto;
} */
</style>
