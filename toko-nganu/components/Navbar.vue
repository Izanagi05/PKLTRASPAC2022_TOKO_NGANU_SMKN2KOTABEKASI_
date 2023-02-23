<template>
  <div class="ppp">
    <div class="contact white--text">
      <div class="contact-text font-weight-regular">
        <v-icon color="white">mdi-phone</v-icon>
        <div>+62-000-000-000</div>
      </div>
    </div>
    <div class="nav">
      <div class="logo">
        <v-img :src="require('~/assets/logo_nganu.png')" width="100px"></v-img>
      </div>
      <div class="nama_toko">
        <div>Toko nganu</div>
      </div>
      <div flat class="rounded-pill search" color="#d9d9d9">
        <v-text-field
          class="nyari rounded-pill"
          v-model="cari"
          label="Cari Nganu"
          single-line
          hide-details
          outlined
          append-icon="mdi-magnify"
          placehoder="Ni ai wo wo ai ni mi xue bing cheng tianmi mi ni ai wo wo ai ni"
        ></v-text-field>
      </div>
      <div class="profile_icon_keranjang">
        <nuxt-link to="/keranjang" >
          <v-btn elevation="2" fab color="d9d9d9" icon
            ><v-icon size="29px">mdi-cart</v-icon></v-btn
          >
        </nuxt-link>
        <nuxt-link to="/user-view" >
          <v-btn elevation="2" fab icon color="d9d9d9"
            ><v-icon size="29px">mdi-account</v-icon></v-btn
          >
        </nuxt-link>
        <div class="namanya">{{ nama }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {

  data() {
    return {
      cari: null,
      nama: null,
    };

  },
  created(){
     const  usernama=  this.$cookies.get('cookieku')
     this.nama=usernama.data.nama
    },
  methods: {},
};
</script>

<style>
.ppp {
  margin-bottom: 51px;
  font-family: "Poppins", sans-serif;
}
.contact {
  background: #2f432d;
  padding: 9px 123px 10px 123px;
}
.search {
  margin-left: 500px;
}
.round-btn {
  border-radius: 50%;
  width: 49px;
  height: 49px;
  background-color: #d9d9d9;
}
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
}
.nama_toko {
  margin-top: 4px;
  margin-left: 33px;
  font-size: 24px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.namanya {
  display: inline-block;
  width: 100px;
  text-overflow: ellipsis;
  white-space: nowrap;
  overflow: hidden;
  margin-top: 14px;
  margin-left: 12px;
  font-size: 20px;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.profile_icon_keranjang {
  display: flex;
  gap: 11px;
  margin-left: 32px;
}
.keranjang {
  margin-left: 5px;
}
</style>
