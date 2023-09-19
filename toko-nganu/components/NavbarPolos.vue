<template>
  <div class="mb-10 ">
    <div class="btn-warnaku white--text">
      <div class="btn-warnaku white--text">
        <div class="py-1 font-weight-regular">
          <button class=" ml-4" type="submit" @click="kontak">
            <v-icon color="white">mdi-phone</v-icon>
            +62-815-6315-10389
          </button>
        </div>
      </div>
      </div>
    <div class="container">
     <div class="d-flex ">
      <v-img :src="require('~/assets/logo_nganu.png')" max-width="30"></v-img>
              <div class="font-weight-bold text-h5 ml-4">Toko nganu</div>
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
