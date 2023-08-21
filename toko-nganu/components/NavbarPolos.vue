<template>
  <div class="ppp">
    <div class="contact white--text">
      <div class="contact-text font-weight-regular">
        <button class="kontak" type="submit" @click="kontak">
          <v-icon color="white">mdi-phone</v-icon>
          +62-815-6315-1038
        </button>
      </div>
    </div>
    <div class="nav">
      <div class="logo">
        <v-img :src="require('~/assets/logo_nganu.png')" width="100px"></v-img>
      </div>
      <div class="nama_toko">
        <div>Toko Nganu</div>
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
.ppp {
  overflow: hidden;
  margin-bottom: 51px;
}
.html {
  background-color: #fff;
  overflow: hidden;
}
.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
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
